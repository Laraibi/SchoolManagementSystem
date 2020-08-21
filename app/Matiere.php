<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    //
    
    protected $fillable = [
        'Name'
    ];
    public function Teachers(){
        return $this->hasMany("App\Teacher");
    }
    public function Cours(){
        return $this->hasMany("App\Cour");
    }
}
