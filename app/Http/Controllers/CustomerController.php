<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pet;
use View;
use Redirect;
use Session;
use DB;
use Auth;
use App\DataTables\CustomerDataTable;
use DataTables;
use Yajra\DataTables\Html\Builder;
use Validator;
use App\Imports\UserImport;
use Excel;
use App\Rules\ExcelRule;

class CustomerController extends Controller
{
    // public function getCustomers(CustomerDataTable $dataTable)
    // {   
    //     $customers = Customer::get();
    //     // if ($dataTable->ajax()){
    //     //     return DataTables::of(Customer::withTrashed())
    //     //     // ->withTrashed()
    //     //     ->make(true);
    //     // }
    //     return $dataTable->render('customer.customers');
    // }

    public function getCustomers(CustomerDataTable $dataTable, Builder $builder)
    {
        $customer = User::withTrashed()->where('role', '=', 'Customer')->orderBy('id','DESC');
        if (request()->ajax()) {
            return DataTables::of($customer)
            ->order(function ($query) {
            $query->orderBy('id', 'ASC');
            })->addColumn('action', function($row) {
        return "<a href=". route('customer.show', $row->id). " class=\"btn btn-primary\">Show</a><a href=".route('customer.edit', $row->id). "
            class=\"btn btn-warning\">Edit</a> 
            <a href=".route('customer.restore', $row->id). "
            class=\"btn btn-success\">Restore</a>
            <form action=". route('customers.destroy', $row->id). " method= \"POST\" >". csrf_field() .'<input name="_method" type="hidden" value="DELETE"><button class="btn btn-danger" type="submit">Delete</button></form>';
            })
                ->rawColumns(['action'])
                ->toJson();
        }
        
        $html = $builder->columns([
            ['data' => 'id', 'name' => 'id', 'title' => 'Customer ID'],
            ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
            ['data' => 'addressline', 'name' => 'addressline', 'title' => 'Addressline'],
            ['data' => 'town', 'name' => 'town', 'title' => 'Town'],
            ['data' => 'phone', 'name' => 'phone', 'title' => 'Phone'],
            ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'],
            ['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Updated At'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action'],
        ]);

    return view('customer.customers', compact('html'));
    // $employee = Employee::withTrashed()->orderBy('id','DESC')->paginate(10);
    //     return $dataTable->render('employee.employees');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        // dd($input);
        $request->validate([
        'image' => 'image',
    ]);
    // $validator = Validator::make($request->all(), Customer::$rules);
    // if ($validator->fails()) {
    //    return redirect()->back()->withInput ()->withErrors($validator);
    // }
    if($file = $request->hasFile('image')) {
        $file = $request->file('image') ;
        $fileName = date('M d, Y').'_'.$file->getClientOriginalName();
        $fileName = $file->getClientOriginalName();
        $destinationPath = public_path(). '/images/user';
        $input['user_img'] = $fileName;
        $file->move($destinationPath, $fileName);
    }
        Customer::create($input);
        return Redirect::to('customer.customers')->with('success','New Customer Added!');
    }

    public function edit($id)
    {
        $customer = User::find($id);
        // dd(compact('customer'));
        return View::make('customer.edit',compact('customer'));
    }

    public function update(Request $request, $id)
    {
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
        $destinationPath = public_path(). '/images/customer';
        $input['user_img'] = $fileName;
        $file->move($destinationPath, $fileName);
    }

    $customer = User::find($id);
    $customer->update($request->all());
    $customer->user_img = $fileName;
    $customer->save();
    return Redirect::to('customer.profile')->with('success','Customer data updated!');
    }

    public function destroy($id)
    {
        $customer = User::where('id',$id)->delete();
        // $customer->delete();
        return Redirect::route('getCustomers')->with('success',' Customer Deleted Successfully!');
    }

    public function restore($id) 
    {
        User::withTrashed()->where('id',$id)->restore();
        return  Redirect::route('getCustomers')->with('success','Customer Restored Successfully!');
    }

    // public function restore($id) 
    // {
    //     Customer::withTrashed()->where('id',$id)->restore();
    //     return  Redirect::route('customer.customers')->with('success','Customer Restored Successfully!');
    // }

    public function show($id)
    {
        return View::make('customer.show', ['customer'=> User::findOrFail($id)]);
    }

    public function getProfile(){
        $users = Auth::id();
        //$pets = Pet::findOrFail($users);
        $pets = DB::table('pets')
            ->join('pet_user','pets.id','pet_user.pet_id')
            ->join('users','users.id','pet_user.user_id')
            ->select('pets.*')
            ->where('users.id','=', $users)
            ->orderBy('id','DESC')
            ->get();
        //select * from pets inner join pet_user on pets.id=pet_user.pet_id inner join users on users.id=pet_user.user_id
        $user = User::findOrFail($users);
        return View::make('customer.profile',compact('pets','user'));
        //return view('customer.profile');
    }

    public function import(Request $request){
        $request->validate([
            'customer_upload' => ['required', new ExcelRule($request->file('customer_upload'))],
        ]);
        Excel::import(new UserImport, request()->file('customer_upload'));
        return redirect()->back()->with('success', 'Excel file Imported Successfully');
    }
}