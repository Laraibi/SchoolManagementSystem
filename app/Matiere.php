<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    //
    protected $table="Matieres";
    protected $fillable = [
        'Name'
    ];
    public function Teachers(){
        return $this->hasMany("App\\teacher");
    }
    public function Cours(){
        return $this->hasMany("App\Cour");
    }
    public function Examens(){
        return $this->hasMany("App\Examen");
    }
}
