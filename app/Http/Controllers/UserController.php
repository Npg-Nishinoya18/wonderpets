<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
// use App\Mail\ContactMail;
use Validator;
use Redirect;
use Mail;
use App\Events\SendMail;
use Event;

class UserController extends Controller
{
    public function getSignup(){
        return view('user.signup');
    }

    public function postSignup(Request $request){
        $input = $request->all();
        $input['password'] = bcrypt($request->password);
        $request->validate([
        'image' => 'image'
    ]);

    if($file = $request->hasFile('image')) {
        $file = $request->file('image') ;
        $fileName = date('M, d, Y').'_'.$file->getClientOriginalName ();
        $fileName = $file->getClientOriginalName();
        $destinationPath = public_path(). '/images/user';
        $input['user_img'] = $fileName;
        $file->move($destinationPath, $fileName);
    }
    $user = User::create($input);
    Auth::login($user);

    Event::dispatch(new SendMail($user));
    return redirect()->route('customer.profile')->with('success','Register & Email sent successfully!');
    }

    public function getCustomerProfile(){
        return view('customer.profile');
    }

    public function getEmployeeProfile(){
        return view('employee.profile');
    }

    public function getSignin(){
        return view('user.signin');
    }

    public function postSignin(Request $request){
        $this->validate($request, [
            'email' => 'email| required',
            'password' => 'required| min:4'
        ]);
        if(Auth::attempt(['email' => $request->input('email'),'password' => $request->password])){
            return redirect()->route('emloyee.profile');
        } else{
            return redirect()->back();
        };
    }
    
    public function getLogout(){
        Auth::logout();
        return redirect()->guest('/');
    }
}
