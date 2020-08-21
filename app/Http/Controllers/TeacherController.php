<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\teacher;
use App\Matiere;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Teachers=teacher::all();
        $Matieres=Matiere::all();
        return view("teacher/index",compact("Teachers","Matieres"));

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
        $teacher=new teacher($request->all());
        //return $request;
        $teacher->save();
        $Teachers=teacher::all();
        $Matieres=Matiere::all();
        return view("teacher/index",compact("Teachers","Matieres"));


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
        $SelectedTeacher=teacher::find($id);
        $Teachers=teacher::all();
        $Matieres=Matiere::all();
        return view("teacher/index",compact("Teachers","SelectedTeacher","Matieres"));
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
        $SelectedTeacher=teacher::find($id);
        $SelectedTeacher->FirstName=$request->FirstName;
        $SelectedTeacher->SecondName=$request->SecondName;
        $SelectedTeacher->matiere_id=$request->Matiere;
        $SelectedTeacher->DateOfBirth=$request->DateOfBirth;
        $SelectedTeacher->Male=$request->Male;
        $SelectedTeacher->save();
        $Teachers=teacher::all();
        $Matieres=Matiere::all();
        return view("teacher/index",compact("Teachers","Matieres"));

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
        $SelectedTeacher=teacher::find($id);
        $SelectedTeacher->delete();
        $Teachers=teacher::all();
        $Matieres=Matiere::all();
        return view("teacher/index",compact("Teachers","Matieres"));
    }
}
