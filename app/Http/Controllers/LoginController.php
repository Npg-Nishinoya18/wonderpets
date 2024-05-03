<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use View;

class LoginController extends Controller
{
   public function postSignin(Request $request){
        $this->validate($request, [
            'email' => 'email| required',
            'password' => 'required| min:4'
        ]);

    if(auth()->attempt(array('email' => $request->email, 'password' => $request->password)))
        {
            if (auth()->user()->role === 'Admin' || auth()->user()->role === 'Veterinarian' || auth()->user()->role === 'Groomer') {
                return redirect()->route('employee.profile');
            // } else if (auth()->user()->role === 'encoder'){
            //  return redirect()->route('item.index');
            } 
            else {
                 $pets = DB::table('pets')
                ->join('pet_user', 'pet_user.pet_id', 'pets.id')
                ->join('users', 'users.id', 'pet_user.user_id')
                ->select('pets.*')
                ->where('users.id', Auth::id())
                ->get();
                // return redirect()->route('customer.profile');
                return View::make('customer.profile',compact('pets'));
            }
        }
        else{
            return redirect()->route('user.signin')
                ->with('error','Email Address And Password Are Wrong.');
        }
     }
     public function logout(){
        Auth::logout();
        return redirect()->guest('/');
    }
}