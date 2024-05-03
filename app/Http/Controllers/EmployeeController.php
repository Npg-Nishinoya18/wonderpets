<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use View;
use Redirect;
use Validator;
use Auth;
use App\Http\Requests\login;
use DB;
use App\DataTables\EmployeeDataTable;
use DataTables;
use Yajra\DataTables\Html\Builder;
use App\Imports\UserImport;
use Excel;
use App\Rules\ExcelRule;

class EmployeeController extends Controller
{
    public function index()
    {
        // $customers = Customer::withTrashed()->orderBy('id','DESC')->paginate(10);
        // //dd($customers);
        $employees = User::withTrashed()->orderBy('id','DESC')->paginate(10);
        return View::make('employee.index', compact('employees'));
    }   

    public function create()
    {
        return View::make('employee.create');
    }

    protected function store(Request $request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($request->password);
        $request->validate([
        'image' => 'image'
    ]);
    // $validator = Validator::make($request->all(), Employee::$rules);
    // if ($validator->fails()) {
    //     return redirect()->back()->withInput ()->withErrors($validator);
    // }
    if($file = $request->hasFile('image')) {
        $file = $request->file('image') ;
        $fileName = date('M, d, Y').'_'.$file->getClientOriginalName ();
        $fileName = $file->getClientOriginalName();
        $destinationPath = public_path(). '/images/user';
        $input['user_img'] = $fileName;
        $file->move($destinationPath, $fileName);
    }
    User::create($input);
    return Redirect::to('/employees')->with('success','New Employee Added!');
    }

    public function edit($id)
    {
        $employee = User::find($id);
        return View::make('employee.edit',compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $input['role'] = $request->role;

        $employee = User::find($id);
        $employee->update($input);
        $employee->save();
        return Redirect::to('/employees')->with('success','Employee Data Updated!');
    }

    // public function destroy($id)
    // {
    //     $employee = Employee::findOrFail($id)->delete();
    //     // $customer->delete();
    //     return Redirect::to('/employees')->with('success',' Employee Deleted');
    // }

    // public function restore($id) 
    // {
    //     Employee::withTrashed()->where('id',$id)->restore();
    //     return  Redirect::route('getEmployees')->with('success','Employee Restored Successfully!');
    // }

    public function destroy($id)
    {
        $employee = User::where('id', $id)->delete();
        // $customer->delete();
        return Redirect::route('getEmployees')->with('success',' Employee Deleted');
    }

    public function restore($id) 
    {
        User::withTrashed()->where('id',$id)->restore();
        return  Redirect::route('getEmployees')->with('success','Employee Restored Successfully!');
    }

    public function show($id)
    {
        return View::make('employee.show', ['employee'=> User::findOrFail($id)]);
    }
    public function getEmployees(EmployeeDataTable $dataTable, Builder $builder)
    {
        $employee = User::withTrashed()
                    ->where('role','=','Admin')
                    ->orWhere('role', '=', 'Veterinarian')
                    ->orWhere('role', '=', 'Groomer');
        if (request()->ajax()) {
            return DataTables::of($employee)
            // ->where(function ($query) {
            // $query->where('role', '=', "Admin, Veterinarian, Groomer");

            // where('role','=','Veterinarian')->OrWhere('location','=','Admin')->OrWhere('location','=','Groomer');
            // })
            ->order(function ($query) {
            $query->orderBy('id', 'ASC');
            })
            ->addColumn('action', function($row) {
        return "<a href=". route('employee.show', $row->id). " class=\"btn btn-primary\">Show</a><a href=".route('employee.edit', $row->id). "
            class=\"btn btn-warning\" >Edit</a> 
            <a href=".route('employee.restore', $row->id). "
            class=\"btn btn-success\">Restore</a>
            <form action=". route('employee.destroy', $row->id). " method= \"POST\" >". csrf_field() .'<input name="_method" type="hidden" value="DELETE"><button class="btn btn-danger" type="submit">Delete</button></form>';
            })
                ->rawColumns(['action'])
                ->toJson();
        }
        
        $html = $builder->columns([
            ['data' => 'id', 'name' => 'id', 'title' => 'Employee ID'],
            ['data' => 'title', 'name' => 'title', 'title' => 'Title'],
            ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
            ['data' => 'addressline', 'name' => 'addressline', 'title' => 'Addressline'],
            ['data' => 'town', 'name' => 'town', 'title' => 'Town'],
            ['data' => 'phone', 'name' => 'phone', 'title' => 'Phone'],
            ['data' => 'role', 'name' => 'role', 'title' => 'Role'],
            ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
            // ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'],
            ['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Updated At'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action'],
        ]);

    return view('employee.employees', compact('html'));
    // $employee = Employee::withTrashed()->orderBy('id','DESC')->paginate(10);
    //     return $dataTable->render('employee.employees');
    }

//Login 
    public function getSignup(){
        return view('employee.signup');
    }

    public function postSignup(Request $request){
        $input = $request->all();
        $input['password'] = bcrypt($request->password);
        $request->validate([
        'image' => 'image'
    ]);
    $validator = Validator::make($request->all(), User::$rules, User::$messages);
    if ($validator->fails()) {
        return redirect()->back()->withInput ()->withErrors($validator);
    }
    if($file = $request->hasFile('image')) {
        $file = $request->file('image') ;
        $fileName = date('M, d, Y').'_'.$file->getClientOriginalName ();
        $fileName = $file->getClientOriginalName();
        $destinationPath = public_path(). '/images/employee';
        $input['img_path'] = $fileName;
        $file->move($destinationPath, $fileName);
    }
    $employee = Employee::create($input);
    Auth::login($employee);
        return redirect()->route('employee.profile');
    }

    public function getProfile(){
        return view('employee.profile');
    }

    public function getSignin(){
        return view('employee.signin');
    }

    public function postSignin(Request $request){
        $this->validate($request, [
            'email' => 'email| required',
            'password' => 'required| min:4'
        ]);
        if(Auth::attempt(['email' => $request->input('email'),'password' => $request->password])){
            return redirect()->route('home');
        } else{
            return redirect()->back();
        };
    }

    public function getLogout(){
        Auth::logout();
        return redirect('/employees');
    }


    public function import(Request $request){
        $request->validate([
            'employee_upload' => ['required', new ExcelRule($request->file('employee_upload'))],
        ]);
        Excel::import(new UserImport, request()->file('employee_upload'));
        return redirect()->back()->with('success', 'Excel file Imported Successfully');
    }
}