<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StudentParent;


class StudentParentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $StudentParents = StudentParent::paginate(5);
        return view("studentparent/index", compact("StudentParents"));
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
        $StudentParent = new StudentParent($request->all());
        $StudentParent->save();
        $StudentParents = StudentParent::paginate(5);
        return view("studentparent/index", compact("StudentParents"));
        
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

        $SelectedParent=StudentParent::find($id);
        $StudentParents = StudentParent::paginate(5);
        return view("studentparent/index", compact("StudentParents","SelectedParent"));


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
        $Parent=StudentParent::find($id);
        $Parent->FirstName=$request->FirstName;
        $Parent->SecondName=$request->SecondName;
        $Parent->save();
        $StudentParents = StudentParent::paginate(5);
        return view("studentparent/index", compact("StudentParents"));

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
        $Parent=StudentParent::find($id);
        $Parent->delete();
        $StudentParents = StudentParent::paginate(5);
        return view("studentparent/index", compact("StudentParents"));
    }
}
