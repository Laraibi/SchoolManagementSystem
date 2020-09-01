<?php

namespace App;

use Carbon\Carbon;


use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    //
    protected $fillable = ['Name'];

    public function Students()
    {
        return $this->hasMany("App\Student");
    }

    public function Seances()
    {
        return $this->hasMany("App\Seance","Classe_id");
    }

    public function PlanningSemaine($NumSemaine, $Year)
    {
        // return $this->Seances()->where("DateSeance")
        $date = Carbon::now(); // or $date = new Carbon();
        $date->setISODate($Year, $NumSemaine); // 2016-10-17 23:59:59.000000
        return $this->Seances->where("DateSeance",">=",$date->startOfWeek())->where("DateSeance","<=",$date->endOfWeek());
    }
}
