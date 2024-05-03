<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Grooming extends Model implements Searchable
{
    use HasFactory;
    use softDeletes;
    protected $guarded = ['id'];
    public static $rules = ['title' =>'required',
        'description'=>'required',
        'grooming_cost'=>'digits_between:3,9'];

    public static $messages = [
        'required' => 'This field is required!'];

        public function groomingtrans() {
            return $this->belongsToMany('App\Models\Groomingtransaction');
        }

        public function getSearchResult(): SearchResult
        {
           $url = route('getgroomtrans', $this->grooming_id);
        
            return new \Spatie\Searchable\SearchResult(
               $this,
               $this->title,
               $url
               );
        }
}