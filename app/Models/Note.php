<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Note extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['photo','title','content','type','admin_id','hash'];

    // public function getCreatedAtAttribute($date){
    //    return $date->diffForHumans();
    // } 

    public function getPhotoAttribute($photo){
        if($photo){
            return asset('storage/'.$photo);
        }
       return $photo;
    } 
}
