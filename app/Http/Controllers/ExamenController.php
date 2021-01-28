<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Examen;
use App\Matiere;

class ExamenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Examens=Examen::all();
        $Matieres=Matiere::all();
        return view("Examen.Index",compact("Examens","Matieres"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if($request->hasFile('Path_Ennonce')){
            $ExamFile=$request->file('Path_Ennonce');
            $ExamFile->storeAs('Public/ExamensFiles',"FileExam_".$request->Name.".".$ExamFile->extension());
            $request->Path_Ennonce="FileExam_".$request->Name.".".$ExamFile->extension();
        }
        $Examen=new Examen($request->all());
        $Examen->Path_Ennonce="FileExam_".$request->Name.".".$ExamFile->extension();
        $Examen->save();
        $Examens=Examen::all();
        $Matieres=Matiere::all();
        return view("Examen.Index",compact("Examens","Matieres"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $SelectedExamen=Examen::find($id);
        $Examens=Examen::all();
        $Matieres=Matiere::all();
        return view("Examen.Index",compact("Examens","Matieres","SelectedExamen"));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $SelectedExamen=Examen::find($id);
        $SelectedExamen->Name=$request->Name;
        $SelectedExamen->Matiere_id=$request->Matiere_id;
        if($request->hasFile('Path_Ennonce')){
            Storage::delete('Public/ExamensFiles/'.$SelectedExamen->Path_Ennonce);
            $ExamFile=$request->file('Path_Ennonce');
            $ExamFile->storeAs('Public/ExamensFiles',"FileExam_".$request->Name.".".$ExamFile->extension());
            $SelectedExamen->Path_Ennonce="FileExam_".$request->Name.".".$ExamFile->extension();
        }
        $SelectedExamen->save();
        $Examens=Examen::all();
        $Matieres=Matiere::all();
        return view("Examen.index",compact("Examens","Matieres"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $SelectedExamen=Examen::find($id);
        Storage::delete('Public/ExamensFiles/'.$SelectedExamen->Path_Ennonce);
        $SelectedExamen->delete();
        $Examens=Examen::all();
        $Matieres=Matiere::all();
        return view("Examen.Index",compact("Examens","Matieres"));
    }
}
