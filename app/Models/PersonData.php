<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonData extends Model
{
    //
    protected $table= "person_data" ;
    protected $fillable = ['name','date','longitude','latitude'];
    protected $hidden = ['created_at','updated_at'];
    public $timestamps=true;
}
