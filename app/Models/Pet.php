<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Pet extends Model implements Searchable
{
    use HasFactory;
    use softDeletes;
    protected $guarded = ['id'];
    public static $rules = ['name' =>'required',
        'type' =>'required',
        'user_id'=>'required'];

    public static $messages = [
        'required' => 'This field is required!'];

    public function user() {
        return $this->belongsToMany('App\Models\User');
    }

    public function consultations() {
        return $this->belongsToMany('App\Models\Consultation');
    }

    public function groomingtrans() {
        return $this->belongsToMany('App\Models\Groomingtransaction');
    }

    public function getSearchResult(): SearchResult
     {
        $url = route('consultation.index', $this->pet_id);
     
         return new \Spatie\Searchable\SearchResult(
            $this,
            $this->name,
            $url
            );
     }

     
}