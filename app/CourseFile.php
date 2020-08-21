<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseFile extends Model
{
    //

    protected $fillable=['Name',"Cour_id","Path"];
    public function Cour(){
        return $this->belongsTo("App\Cour");
    }
}
