<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classe;
use App\Student;
class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Classes =Classe::paginate(5);
        return view ("Classe/index",compact("Classes"));

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
        $Classe = new Classe($request->all());
        $Classe->save();
        $Classes =Classe::all();
        return view ("Classe/index",compact("Classes"));
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
        $ClasseToShow=Classe::find($id);
        $Classes =Classe::paginate(5);
        $FreeStudents=Student::where('Classe_id',null)->get();
        return view("Classe/index",compact("ClasseToShow","Classes","FreeStudents"));

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
        $SelectedClasse=Classe::find($id);
        $Classes =Classe::paginate(5);
        return view ("Classe/index",compact("Classes","SelectedClasse"));
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
        $SelectedClasse=Classe::find($id);
        $SelectedClasse->Name=$request->Name;
        $SelectedClasse->save();
        $Classes =Classe::paginate(5);
        return view ("Classe/index",compact("Classes"));
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
        $SelectedClasse=Classe::find($id);     
        $SelectedClasse->delete();
        $Classes =Classe::paginate(5);
        return view ("Classe/index",compact("Classes"));
    }

    public function addStudents (Request $request){

        $StudentsToAdd=$request->except('_token','ClasseToShow');
        foreach($StudentsToAdd as $StudentID){

                $StudentToAdd=Student::find($StudentID);
                $StudentToAdd->Classe_id=$request->ClasseToShow;
                $StudentToAdd->save();

        }

        $ClasseToShow=Classe::find($request->ClasseToShow);
        $Classes =Classe::paginate(5);
        $FreeStudents=Student::where('Classe_id',null)->get();
        return view("Classe/index",compact("ClasseToShow","Classes","FreeStudents"));

    }

    public function removeStudent($class_id,$student_id){
        $StudentToRemove=Student::find($student_id);
        $StudentToRemove->Classe_id=null;
        $StudentToRemove->save();
        $ClasseToShow=Classe::find($class_id);
        $Classes =Classe::paginate(5);
        $FreeStudents=Student::where('Classe_id',null)->get();
        return view("Classe/index",compact("ClasseToShow","Classes","FreeStudents"));

    }
}
