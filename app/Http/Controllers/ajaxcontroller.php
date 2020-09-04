<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Classe;
use App\Matiere;
use App\Seance;


class ajaxcontroller extends Controller
{
    //
    function getPlanningClasse(Request $request)
    {
        if ($request->ajax()) {
            $Classe = Classe::find($request->get('Classe_ID'));
            $DateBeginWeek = $request->get('DateBeginWeek');
            $WeekNumber = Carbon::parse($DateBeginWeek)->weekOfYear;
            $Year = Carbon::parse($DateBeginWeek)->year;

            //Retrouver le Planning de la Classe Selectionnee sur la semaine choisie


            $Seances = $Classe->PlanningSemaine($WeekNumber, $Year);
            $data = [];

            $infos = array(
                'Classe_Name'  => $Classe->name,
                'WeekNumber'  => $WeekNumber,
                'DateBeginWeek' => Carbon::parse($DateBeginWeek)->startOfWeek()->format('Y-m-d')
            );
            array_push($data, $infos);
            foreach ($Seances as $Seance) {
                $infos = array(
                    "DateSeance" => $Seance->DateSeance,
                    "Matiere" => $Seance->Matiere->Name,
                    "Teacher" => $Seance->Teacher->SecondName,
                    "Creneau" => $Seance->Creneau,
                    "Type" => $Seance->Type,
                    "TypeObjectName" => $Seance->TypeObject->Name
                );
                array_push($data, $infos);
            }
            echo json_encode($data);
        }
    }


    function getMatiereCoursesOrExams(Request $request)
    {
        if ($request->ajax()) {


            //    $data= json_decode($request->getContent(),);
            // $data = $request->json()->all();
            $type = $request->Type;
            $MatiereID = $request->MatiereID;

            $dataTeaches = [];

            $Teachers = Matiere::find($MatiereID)->Teachers;

            foreach ($Teachers as $Teacher) {
                $infos = array(
                    'TeacherName'  => $Teacher->FirstName,
                    'TeacherId'  => $Teacher->id
                );
                array_push($dataTeaches, $infos);
            }

            $dataCoursesOrExams = [];

            if ($type == 'Exam') {
                $Exams = Matiere::find($MatiereID)->Examens;
                foreach ($Exams as $Exam) {
                    // $data .= "<option value=\"$Exam->id\">$Exam->Name</option>";
                    $infos = array(
                        'CourseName'  => $Exam->Name,
                        'CourseId'  => $Exam->id
                    );
                    array_push($dataCoursesOrExams, $infos);
                }
            } else {
                $Cours = Matiere::find($MatiereID)->Cours;
                foreach ($Cours as $Cour) {
                    // $data .= "<option value=\"$Cour->id\">$Cour->Name</option>";
                    $infos = array(
                        'CourseName'  => $Cour->Name,
                        'CourseId'  => $Cour->id
                    );
                    array_push($dataCoursesOrExams, $infos);
                }
            }
            // echo json_encode($data);
            return response()->json(["Teachers" => $dataTeaches, "CoursesOrExam" => $dataCoursesOrExams]);
            // echo json_encode("Allo");
        } else {
            echo json_encode("Nada");
        }
    }



    function addSeance(Request $request)
    {

        if ($request->ajax()) {
            $seance=new Seance($request->all());
            $seance->save();
            return response()->json(["Type"=>"Success","Msg" => 'Seance Added']);
        }
    }
}
