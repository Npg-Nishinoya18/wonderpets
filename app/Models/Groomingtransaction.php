<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Groomingtransaction extends Model implements Searchable
{
    use HasFactory;
    // public $primaryKey = 'id';
    public $table = 'serviceinfos_groomings';
    public $timestamps = false;

    protected $fillable = ['serviceinfos_id','groomings_id','pet_id', 'status'];

    public function serviceinfo() {
        return $this->belongsTo('App\Models\Serviceinfo');
    }

    public function pets(){
        return $this->belongsTo('App\Models\Pet');
    }

    public function groomings(){
        return $this->belongsTo('App\Models\Grooming');
    }

    public function getSearchResult(): SearchResult
    {
       $url = route('getgroomtrans', $this->id);
    
        return new \Spatie\Searchable\SearchResult(
           $this,
           $this->status,
           $url
           );
    }
}