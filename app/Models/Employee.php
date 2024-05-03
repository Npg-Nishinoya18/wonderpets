<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Auth;

class Employee extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'employees';
    protected $guarded = ['id'];
    public static $rules = ['role' =>'required',
        'lname'=>'required',
        'fname'=>'required',
        'email'=>'required',
        'password'=>'required| min:4'];

    public static $messages = [
        'required' => 'This field is required!',
        'min' => 'This field does not meet minimum characters!'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
