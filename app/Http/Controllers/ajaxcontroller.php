<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Classe;
use App\Matiere;

class ajaxcontroller extends Controller
{
    //
    function getPlanningClasse(Request $request)
    {
        if ($request->ajax()) {
            $Classe = Classe::find($request->get('Classe_ID'));
            $DateBeginWeek = $request->get('DateBeginWeek');
            $WeekNumber = Carbon::parse($DateBeginWeek)->weekOfYear;

            //Retrouver le Planning de la Classe Selectionnee sur la semaine choisie

            // echo $Classe->PlanningSemaine($WeekNumber, 2020)->all()[0]->Type;

            // repondre la page avec les elementes retrouves.
            // $data = array(
            //     'Classe_Name'  => $Classe->name,
            //     'DateBeginWeek'  => $WeekNumber->weekOfYear
            // );

            $Seances = $Classe->PlanningSemaine($WeekNumber, 2020);
            $data = [];

            foreach ($Seances as $Seance) {
                $infos = array(
                    "DateSeance" => $Seance->DateSeance,
                    "Matiere" => $Seance->Matiere->Name,
                    "Teacher" => $Seance->Teacher->SecondName,
                    "Creneau"=>$Seance->Creneau,
                    // "TypeObjectName"=>$Seance->TypeObject->Name
                );
                array_push($data,$infos);
            }
            echo json_encode($data);
        }
    }


    function getMatiereCoursesOrExams(Request $request)
    {
        if ($request->ajax()) {

            $type = $request->get('Type');
            $MatiereID = $request->get('MatiereID');

            $data = '';
            if ($type == 'Exam') {
                $Exams = Matiere::find($MatiereID)->Examens;
                foreach ($Exams as $Exam) {
                    $data .= "<option value=\"$Exam->id\">$Exam->Name</option>";
                }
            } else {
                $Cours = Matiere::find($MatiereID)->Cours;
                foreach ($Cours as $Cour) {
                    $data .= "<option value=\"$Cour->id\">$Cour->Name</option>";
                }
            }
            echo $data;
        }
    }
}
