<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groomingimages extends Model
{
    use HasFactory;
    protected $table = 'groomingimages';
    protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $fillable = ['groomings_img','groomings_id'];
}
