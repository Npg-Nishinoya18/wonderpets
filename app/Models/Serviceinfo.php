<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use App\Models\User;

class Serviceinfo extends Model implements Searchable
{
    use HasFactory;
    protected $table = 'serviceinfos';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['date_serviced','user_id'];

    public function consults() {
        return $this->belongsTo('App\Models\Consultation');
    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function groomingtrans(){
        return $this->hasMany('App\Models\Groomingtransaction');
    }

    public function employee(){
        return $this->belongsTo('App\Models\Employee');
    }

    public function getSearchResult(): SearchResult
    {
       $url = url('/consultation'.$this->id);
    //    $url = url('show-listener/'.$this->id);
        return new \Spatie\Searchable\SearchResult(
           $this,
           $this->date_serviced,
           $url
           );
    }
}