<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seance extends Model
{
    //

    public function Classe(){
        return $this->belongsTo("App\Classe"."Classe_id");
    }


    public function Matiere(){
        return $this->belongsTo("App\Matiere","Matiere_id");
    }

    public function Teacher(){
        return $this->belongsTo("App\Teacher","Teacher_id");
    }

    public function TypeObject(){
        if($this->Type=="Cour"){
            return $this->belongsTo("App\Cour","Type_id","id");
        }else{
            return $this->belongsTo("App\Examen","Type_id","id",);
        }
    }
}
