<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    //
    protected $fillable=['Name','Matiere_id',"Path_Ennonce"];
    Public function Matiere(){
        return $this->belongsTo("App\Matiere","Matiere_id");
    }
}
