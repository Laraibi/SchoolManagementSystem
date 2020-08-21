<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cour extends Model
{
    //
    protected $fillable=['Name','Matiere_id',"Total_Hours"];
    Public function Matiere(){
        return $this->belongsTo("App\Matiere","Matiere_id");
    }
    Public function CourseFiles(){
        return $this->hasMany("App\CourseFile");
    }
}
