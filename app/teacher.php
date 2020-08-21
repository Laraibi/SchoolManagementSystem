<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class teacher extends Model
{
    //

    protected $fillable=["FirstName","SecondName","Male","DateOfBirth","Matiere_id"];
    public function Matiere(){
        return $this->belongsTo("App\Matiere","Matiere_id");
    }
}
