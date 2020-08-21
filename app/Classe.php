<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    //
    protected $fillable =['Name'];

    public function Students(){
        return $this->hasMany("App\Student");
    }
}
