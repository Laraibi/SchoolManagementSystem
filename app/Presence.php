<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    //

    public function Student (){
        return $this->belongsTo("App\Student","Student_id");
    }
}
