<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use App\Models\Serviceinfo;

class Consultation extends Model implements Searchable
{
    use HasFactory;
    protected $table = 'checkups';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['diseases_injuries','comment', 'serviceinfos_id', 'cost','pet_id'];

    public function serviceinfo() {
        return $this->belongsTo(Serviceinfo::class, 'serviceinfos_id');
    }
    
    public function pets(){
        return $this->belongsTo('App\Models\Pet');
    }

    public function getSearchResult(): SearchResult
     {
        $url = route('consultation.show', $this->serviceinfos_id);
     
         return new \Spatie\Searchable\SearchResult(
            $this,
            $this->cost, $this->diseases_injuries,
            $url
            );
     }
}