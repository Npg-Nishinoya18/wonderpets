<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grooming;
use App\Models\Groomingimages;
use View;
use Redirect;
use Session;
use Validator;
use DB;
use App\DataTables\GroomingsDataTable;
use DataTables;
use Yajra\DataTables\Html\Builder;
use App\Imports\GroomingImport;
use Excel;
use App\Rules\ExcelRule;

class GroomingController extends Controller
{
    public function index()
    {
        $groomings = Grooming::withTrashed()->orderBy('groomings.id','DESC')->paginate(10);
        return View::make('grooming.index', compact('groomings'));
    }

    public function create()
    {
        $groomings = Grooming::all();
        return View::make('grooming.create', compact('groomings'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $request->validate([
            'description'=>'required',
            'title'=>'required',
            'grooming_cost'=>'required',
        ]);
        // dd($input);
        $data = Grooming::create($input);
        
        if($request->hasFile('image')){
            $allowedfileExtension=['pdf','jpg','png','docx'];
            $files = $request->file('image');
            
            foreach($files as $file){
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $check=in_array($extension,$allowedfileExtension);
                
                Groomingimages::create([
                    'groomings_id' => $data->id,
                    'groomings_img' => $filename
                ]);
                
                if($check){
                    foreach ($request->image as $images) {
                        $file = $file->move(public_path().'/images/groomings', $filename);
                        $images = '/images/groomings'.$filename;
                    }
                    echo "Upload Successfully";
                }
                else{
                    echo '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload png , jpg , doc</div>';
                }
            }
        }
        return Redirect::to('/grooming')->with('success','New Grooming Service Added!');
    }
    
    public function show($id)
    {
        $grooming = Grooming::findOrFail($id);
        $imge = DB::table('groomingimages')
                ->select('groomingimages.groomings_img')
                ->where('groomingimages.groomings_id', $id)
                ->pluck('groomings_img');
        return View::make('grooming.show', compact('grooming', 'imge'));
    }

    public function edit($id)
    {
        $grooming = Grooming::find($id);
        return View::make('grooming.edit',compact('grooming'));
    }

    public function update(Request $request, $id)
    {
        $grooming = Grooming::find($id);
        DB::table('groomingimages')
        ->where('groomings_id',$id)
        ->delete();
        $grooming->update($request->all());
        $grooming->save();
        
        if($request->hasFile('image')){
            $allowedfileExtension=['pdf','jpg','png','docx'];
            $files = $request->file('image');
            
            foreach($files as $file){
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $check=in_array($extension,$allowedfileExtension);
                
                //dd($check);
                
                Groomingimages::create([
                    'groomings_id' => $grooming->id,
                    'groomings_img' => $filename
                ]);
                
                if($check){
                    foreach ($request->image as $images) {
                        $file = $file->move(public_path().'/images/groomings', $filename);
                        $images = '/images/groomings'.$filename;
                    }
                    echo "Upload Successfully";
                }
                else{
                    echo '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload png , jpg , doc</div>';
                }
            }
        }  
        return Redirect::to('grooming')->with('success','Grooming Service data updated!');
    }

    public function destroy($id)
    {
        $grooming = Grooming::find($id);
         // dd($id);
        DB::table('groomingimages')
        ->where('groomings_id',$id)
        ->delete();
        $grooming->delete();
        return Redirect::to('grooming')->with('success','Grooming Service Data Deleted!');
    }

    public function restore($id) 
    {
        Grooming::withTrashed()->where('id',$id)->restore();
        return  Redirect::route('grooming.index')->with('success','Grooming Service data Restored Successfully!');
    }

    public function getGroomings(GroomingsDataTable $dataTable, Builder $builder)
    {
         $grooming = Grooming::query();
        if (request()->ajax()) {
            return DataTables::of($grooming)
            ->order(function ($query) {
            $query->orderBy('id', 'DESC');
            })->addColumn('action', function($row) {
        return "<a href=". route('grooming.show', $row->id). " class=\"btn btn-primary\">Show</a><a href=".route('grooming.edit', $row->id). "
class=\"btn btn-warning\">Edit</a> <form action=". route('grooming.destroy', $row->id). " method= \"POST\" >". csrf_field() .'<input name="_method" type="hidden" value="DELETE"><button class="btn btn-danger" type="submit">Delete</button></form>';
            })
                ->rawColumns(['action'])
                ->toJson();
        }
        
        $html = $builder->columns([
            ['data' => 'id', 'name' => 'id', 'title' => 'Grooming ID'],
            ['data' => 'title', 'name' => 'title', 'title' => 'Service Name'],
            ['data' => 'description', 'name' => 'description', 'title' => 'Desription'],
            ['data' => 'grooming_cost', 'name' => 'grooming_cost', 'title' => 'Amount'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'],
            ['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Updated At'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action'],
        ]);

    return view('grooming.groomings', compact('html'));
    }

    public function import(Request $request){
        $request->validate([
            'grooming_upload' => ['required', new ExcelRule($request->file('grooming_upload'))],
        ]);
        Excel::import(new GroomingImport, request()->file('grooming_upload'));
        return redirect()->back()->with('success', 'Excel file Imported Successfully');
    }
}
