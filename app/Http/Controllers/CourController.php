<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cour;
use App\Matiere;

class CourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Cours=Cour::paginate(5);
        $Matieres=Matiere::all();
        return view("Cour.index",compact("Cours","Matieres"));
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
        $cour=new Cour($request->all());
        $cour->save();
        $Cours=Cour::paginate(5);
        $Matieres=Matiere::all();
        return view("Cour.index",compact("Cours","Matieres"));
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
        $SelectedCour=Cour::find($id);
        $Cours=Cour::paginate(5);
        $Matieres=Matiere::all();
        return view("Cour.index",compact("Cours","Matieres","SelectedCour"));
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
        $SelectedCour=Cour::find($id);
        $SelectedCour->Name=$request->Name;
        $SelectedCour->Matiere_id=$request->Matiere_id;
        $SelectedCour->Total_Hours=$request->Total_Hours;
        $SelectedCour->save();
        $Cours=Cour::paginate(5);
        $Matieres=Matiere::all();
        return view("Cour.index",compact("Cours","Matieres"));
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

        $SelectedCour=Cour::find($id);
        $SelectedCour->delete();
        $Cours=Cour::paginate(5);
        $Matieres=Matiere::all();
        return view("Cour.index",compact("Cours","Matieres"));
    }
}
