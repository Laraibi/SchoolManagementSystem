<?php

namespace App\Http\Controllers;

use App\Matiere;
use Illuminate\Http\Request;

class MatiereController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Matieres=Matiere::all();
        return view('matiere/index',compact("Matieres"));
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
        $Matiere=new Matiere($request->all());
        $Matiere->save();
        $Matieres=Matiere::all();
        return view('matiere/index',compact("Matieres"));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Matiere  $matiere
     * @return \Illuminate\Http\Response
     */
    public function show(Matiere $matiere)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Matiere  $matiere
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $SelectedMatiere=Matiere::find($id);
        $Matieres=Matiere::all();
        return view('matiere/index',compact("Matieres","SelectedMatiere"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Matiere  $matiere
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $matiere=Matiere::find($id);
        $matiere->Name=$request->Name;
        $matiere->save();
        $Matieres=Matiere::all();
        return view('matiere/index',compact("Matieres"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Matiere  $matiere
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $matiere=Matiere::find($id);
        $matiere->delete();
        $Matieres=Matiere::all();
        return view('matiere/index',compact("Matieres"));
    }
}
