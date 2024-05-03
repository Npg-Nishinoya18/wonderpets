<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;
    // protected $fillable = ['title', 'lname', 'fname', 'addressline', 'town', 'zipcode', 'phone', 'customer_img'];

    // public function pets(){
    //     return $this->belongsToMany('App\Models\Pets');
    // }

    protected $guarded = ['id'];
    
    public static $rules = [  'title' =>'required|alpha|max:3',
    'lname'=>'required',
    'fname'=>'required',
    'adadressline'=>'required',
    'phone'=>'digits_between:3,8',
    'town'=>'required',
    'zipcode'=>'required'
];
    public static $messages = [
        'required' => 'This :attribute field is required',
        'min' => 'did not meet the minimum for :attribute',
        'alpha' => 'only letters',
        'fname.required' => 'First Name is required'
    ];
}