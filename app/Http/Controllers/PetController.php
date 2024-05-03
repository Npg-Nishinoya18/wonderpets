<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Consultation;
use App\Models\Pet;
use View;
use Redirect;
use Session;
use Validator;
use DB;
use Auth;
use App\DataTables\PetsDataTable;
use DataTables;
use Yajra\DataTables\Html\Builder;
// use App\Imports\AlbumImport;
// use App\Imports\AlbumArtistListenerImport;
use Excel;
use App\Rules\ExcelRule;
use App\Imports\PetImport;

class PetController extends Controller
{
    public function index(Request $request)
    {
        

//         if (empty($request->get('search'))) {
//             $albums = Album::with('artist','listeners')->get();
//         }
// else {
//             // $albums = Album::with(['artist' =>function($q) use($request){
//             //   $q->where("artist_name","LIKE", "%".$request->get('search')."%");
//             // }])->get();
// // $albums = Album::whereHas('artist', function($q) use($request){
//             //   $q->where("artist_name","LIKE", "%".$request->get('search')."%");
//             // })->get();
//             $albums = Album::whereHas('artist', function($q) use($request) {
//                     $q->where("artist_name","LIKE", "%".$request->get('search')."%");
//  })->orWhereHas('listeners', function($q) use($request){
//               $q->where("listener_name","LIKE", "%".$request->get('search')."%");
//             })
//             ->get();
// // $albums = Album::whereHas('artist', function($q) use($request) {
//             //         $q->where("artist_name","LIKE", "%".$request->get('search')."%");
//             // })->orWhereHas('listeners', function($q) use($request){
//             //   $q->where("listener_name","LIKE", "%".$request->get('search')."%");
//             // })->orWhere('album_name',"LIKE", "%".$request->get('search')."%")
//             // ->get();
// }
//   return View::make('album.index',compact('albums'));
    }
    
    public function create(){
        // $users = DB::table('users')
        // ->where('role', '=', 'Customer')
        // ->get();
        $users = Auth::id();
        return View::make('pet.create', compact('users'));
    }

    public function show($id)
    {
        $pet = Pet::findOrFail($id);
        $users = Auth::id();
        $user = User::findOrFail($users);
        return View::make('pet.show',compact('pet','user'));
    }

    public function store(Request $request){
        $input = $request->all();
        $request->validate([
        'image' => 'image',
    ]);
    // $validator = Validator::make($request->all(), Pet::$rules);
    // if ($validator->fails()) {
    //    return redirect()->back()->withInput ()->withErrors($validator);
    // }
    if($file = $request->hasFile('image')) {
        $file = $request->file('image') ;
        $fileName = date('M d, Y').'_'.$file->getClientOriginalName ();
        $fileName = $file->getClientOriginalName();
        $destinationPath = public_path(). '/images/pet';
        $input['pet_img'] = $fileName;
        $file->move($destinationPath, $fileName);
    }
        // Pet::create($input);
        // return Redirect::to('/pet')->with('success','New Pet Added!');

        $user = Auth::id();
        $pet = Pet::create($input);
        // $pet->name = $request->name;
        // $pet->save();
        $pet->user()->attach($user);
        return Redirect::to('/pets')->with('success','New Pet added!');
    }

    public function stores(Request $request){
        $input = $request->all();
        $request->validate([
        'image' => 'image',
    ]);
    // $validator = Validator::make($request->all(), Pet::$rules);
    // if ($validator->fails()) {
    //    return redirect()->back()->withInput ()->withErrors($validator);
    // }
    if($file = $request->hasFile('image')) {
        $file = $request->file('image') ;
        $fileName = date('M d, Y').'_'.$file->getClientOriginalName ();
        $fileName = $file->getClientOriginalName();
        $destinationPath = public_path(). '/images/pet';
        $input['pet_img'] = $fileName;
        $file->move($destinationPath, $fileName);
    }
        // Pet::create($input);
        // return Redirect::to('/pet')->with('success','New Pet Added!');

        $user = Auth::id();
        $pet = Pet::create($input);
        // $pet->name = $request->name;
        // $pet->save();
        $pet->user()->attach($user);
        return Redirect::to('/customers/profile')->with('success','New Pet added!');
    }

    public function edit($id) {
        $pet = Pet::with('user')->where('id',$id)->first();
        $users = User::pluck('name','id');
        return View::make('pet.edit',compact('pet','users'));
    }

    public function editss($id) {
        $pet = Pet::with('user')->where('id',$id)->first();
        $users = User::pluck('name','id');
        return View::make('pet.edits',compact('pet','users'));
    }

    public function update(Request $request, $id) {
        $input = $request->all();
        $request->validate([
        'image' => 'image',
    ]);

    // $validator = Validator::make($request->all(), Customer::$rules, Customer::$messages);
    //     if ($validator->fails()) {
    //         return redirect()->back()->withInput()->withErrors($validator);
    // }

    if($file = $request->hasFile('image')) {
        $file = $request->file('image') ;
        $fileName = date('M d, Y').'_'.$file->getClientOriginalName ();
        $fileName = $file->getClientOriginalName();
        $destinationPath = public_path(). '/images/pet';
        $input['pet_img'] = $fileName;
        $file->move($destinationPath, $fileName);
    }
        $user = Auth::id();
        $pet = Pet::find($id);
        $pet->pet_img=$fileName;
        $pet->update($request->all());
        // $pet->user()->attach($user);
        return Redirect::route('getPets')->with('success','Pet Updated!');
    }

    public function updates(Request $request, $id) {
        $input = $request->all();
        $request->validate([
        'image' => 'image',
    ]);

    // $validator = Validator::make($request->all(), Customer::$rules, Customer::$messages);
    //     if ($validator->fails()) {
    //         return redirect()->back()->withInput()->withErrors($validator);
    // }

    if($file = $request->hasFile('image')) {
        $file = $request->file('image') ;
        $fileName = date('M d, Y').'_'.$file->getClientOriginalName ();
        $fileName = $file->getClientOriginalName();
        $destinationPath = public_path(). '/images/pet';
        $input['pet_img'] = $fileName;
        $file->move($destinationPath, $fileName);
    }
        $user = Auth::id();
        $pet = Pet::find($id);
        $pet->pet_img=$fileName;
        $pet->update($request->all());
        // $pet->user()->attach($user);
        // dd($pet);
        return Redirect::route('customer.profile')->with('success','Pet Updated!');
    }

    public function destroy($id)
    {
        $pet = Pet::find($id);
        $pet->user()->detach();
        $pet->delete();
        return Redirect::route('getPets')->with('success','Pet Deleted!');
    }

    public function getPets(PetsDataTable $dataTable, Builder $builder)
    {   
        $pets =  Pet::with(['user'])->orderBy('id','DESC')->get();
       
        if (request()->ajax()) {
            return DataTables::of($pets)
            ->order(function ($query) {
            // $query->orderBy('id', 'DESC');
            })
            ->addColumn('action', function($row) {
        return "<a href=". route('pet.show', $row->id). " class=\"btn btn-primary\">Show</a><br><a href=".route('pet.edit', $row->id). "
            class=\"btn btn-warning\" >Edit</a> 
            <form action=". route('pet.destroy', $row->id). " method= \"POST\" >". csrf_field() .'<input name="_method" type="hidden" value="DELETE"><button class="btn btn-danger" type="submit">Delete</button></form>';
            })
                ->rawColumns(['action'])
                ->toJson();
        }
        
        $html = $builder->columns([
            ['data' => 'id', 'name' => 'id', 'title' => 'Pet ID'],
            ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
            ['data' => 'type', 'name' => 'type', 'title' => 'Type'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'],
            ['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Updated At'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action'],
        ]);

    return view('pet.pets', compact('html'));
    // $employee = Employee::withTrashed()->orderBy('id','DESC')->paginate(10);
    //     return $dataTable->render('employee.employees');
    }
    
    public function import(Request $request){
        $request->validate([
            'pet_upload' => ['required', new ExcelRule($request->file('pet_upload'))],
        ]);
        Excel::import(new PetImport, request()->file('pet_upload'));
        return redirect()->back()->with('success', 'Excel file Imported Successfully');
    }
}