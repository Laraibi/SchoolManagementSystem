<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Classe;
use App\Matiere;
use App\Seance;
use App\Presence;


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
                    "id" => $Seance->id,
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

    function GetClasseStudents(Request $request)
    {
        if ($request->ajax()) {
            $Classe = Classe::find($request->get('Classe_ID'));
            //Retrouver le Planning de la Classe Selectionnee sur la semaine choisie
            $Students = $Classe->Students;
            $Seance = $Classe->Seances->where('DateSeance', '=', $request->get('SelectedDate'))->where('Creneau', '=', $request->get('SelectedCreneau'))->first();
            // $Seance = $Classe->Seances;

            $data = [];
            $infos = array(
                "SeanceID" =>$Seance?$Seance->id:-1,
                "SeanceType" =>$Seance?$Seance->Type:'',
                "SeanceMatiere" =>$Seance?$Seance->Matiere->Name:'',
                "SeanceTeacher"=>$Seance?$Seance->Teacher->SecondName:''
            );

            // $infos = array(
            //     "SelectedDate" => $request->get('SelectedDate')
            // );

            array_push($data,  $infos);

            foreach ($Students as $Student) {
                $infos = array(
                    "id" => $Student->id,
                    "Name" => $Student->FirstName,
                );
                array_push($data,  $infos);
            }
            return response()->json($data);
        }
    }

    function GetClasseStudentsAndPresencesInSeance(Request $request)
    {
        if ($request->ajax()) {
            $Classe = Classe::find($request->get('Classe_ID'));
            //Retrouver le Planning de la Classe Selectionnee sur la semaine choisie
            $Students = $Classe->Students;
            $Seance = $Classe->Seances->where('DateSeance', '=', $request->get('SelectedDate'))->where('Creneau', '=', $request->get('SelectedCreneau'))->first();
            // $Seance = $Classe->Seances;

            $data = [];
            $Presences=$Seance?$Seance->Presences:false;
            $infos = array(
                "SeanceID" =>$Seance?$Seance->id:-1,
                "SeanceType" =>$Seance?$Seance->Type:'',
                "SeanceMatiere" =>$Seance?$Seance->Matiere->Name:'',
                "SeanceTeacher"=>$Seance?$Seance->Teacher->SecondName:'',
                "TauxPresence"=>$Presences?number_format(count($Presences->where('EtatPresence','=',1))/count($Presences),4):0
            );

            // $infos = array(
            //     "SelectedDate" => $request->get('SelectedDate')
            // );

            array_push($data,  $infos);

            foreach ($Students as $Student) {
                $infos = array(
                    "id" => $Student->id,
                    "Name" => $Student->FirstName,
                    "Presence"=>$Presences?$Presences->where('Student_id','=',$Student->id)->first()->EtatPresence:0,
                    "Retard"=>$Presences?$Presences->where('Student_id','=',$Student->id)->first()->EtatRetard:0,
                    "MinutesRetard"=>$Presences?$Presences->where('Student_id','=',$Student->id)->first()->MinutesRetard:0
                );
                array_push($data,  $infos);
            }
            return response()->json($data);
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
            $seance = new Seance($request->all());
            $seance->save();
            return response()->json(["Type" => "Success", "Msg" => 'Seance Added']);
        }
    }

    function editSeance(Request $request)
    {

        if ($request->ajax()) {
            $seance = Seance::find($request->SeanceID);
            $seance->Matiere_id = $request->Matiere_id;
            $seance->Teacher_id = $request->Teacher_id;
            $seance->Salle_id = $request->Salle_id;
            $seance->Type_id = $request->Type_id;
            $seance->Type = $request->Type;
            $seance->save();
            return response()->json(["Type" => "Success", "Msg" => 'Seance Edited']);
        }
    }


    function deleteSeance(Request $request)
    {

        if ($request->ajax()) {
            $seance = Seance::find($request->SeanceID);
            $seance->delete();
            return response()->json(["Type" => "Success", "Msg" => 'Seance Deleted']);
        }
    }


    function getSeance(Request $request)
    {
        if ($request->ajax()) {
            $Seance = Seance::find($request->SeanceID);

            $infos = array(
                "id" => $Seance->id,
                "DateSeance" => $Seance->DateSeance,
                "Matiere" => $Seance->Matiere->id,
                "Teacher" => $Seance->Teacher->id,
                "Creneau" => $Seance->Creneau,
                "Type" => $Seance->Type,
                "TypeObjectid" => $Seance->TypeObject->id
            );

            $type =  $Seance->Type;
            $dataTeaches = [];

            $Teachers = Matiere::find($Seance->Matiere->id)->Teachers;

            foreach ($Teachers as $Teacher) {
                $infosteach = array(
                    'TeacherName'  => $Teacher->FirstName,
                    'TeacherId'  => $Teacher->id
                );
                array_push($dataTeaches, $infosteach);
            }

            $dataCoursesOrExams = [];

            if ($type == 'Exam') {
                $Exams = Matiere::find($Seance->Matiere->id)->Examens;
                foreach ($Exams as $Exam) {
                    // $data .= "<option value=\"$Exam->id\">$Exam->Name</option>";
                    $infoscours = array(
                        'CourseName'  => $Exam->Name,
                        'CourseId'  => $Exam->id
                    );
                    array_push($dataCoursesOrExams, $infoscours);
                }
            } else {
                $Cours = Matiere::find($Seance->Matiere->id)->Cours;
                foreach ($Cours as $Cour) {
                    // $data .= "<option value=\"$Cour->id\">$Cour->Name</option>";
                    $infoscours = array(
                        'CourseName'  => $Cour->Name,
                        'CourseId'  => $Cour->id
                    );
                    array_push($dataCoursesOrExams, $infoscours);
                }
            }
            return response()->json(["Type" => "Success", "SeanceData" => $infos, "Teachers" => $dataTeaches, "CoursesOrExam" => $dataCoursesOrExams]);
        }
    }


    function SetSeancePresence(Request $request){
        if($request->ajax()){
            $seanceid=$request->SeanceID;
            $students=$request->StudentsData;
            $infos=array();

            foreach($students as $student){
                $Presence=new Presence();
                $Presence->Seance_id=$seanceid;
                $Presence->Student_id=$student['id'];
                $Presence->EtatPresence=$student['EtatPresence']=="true"?1:0;
                $Presence->EtatRetard=$student['EtatRetard']=="true"?1:0;
                $Presence->MinutesRetard=$student['TempsRetard']?$student['TempsRetard']:0;
                $Presence->save();
                array_push($infos,$student['id']);
            }
            return response()->json(["StudentsId"=>$infos]);
        }
    }

    
}
