<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //

    public function StudentParent(){
        return $this->belongsTo("App\StudentParent","Parent_id");
    }
    public function Classe(){
        return $this->belongsTo("App\Classe");
    }
}
