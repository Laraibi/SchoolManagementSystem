<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class StudentParent extends Model
{
    //
    protected $table="Parents";

    protected $fillable = [
        'FirstName', 'SecondName'
    ];

    public function kids(){
            return $this->hasMany("App\Student","Parent_id");
    }
}
