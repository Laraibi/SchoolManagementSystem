<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\StudentParent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;
use Carbon\Carbon;




class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Students = Student::paginate(5);
        $StudentParents = StudentParent::all();
        return view("student/index", compact("Students", "StudentParents"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // $StudentParents = StudentParent::all();

        // return view("student/create", compact('StudentParents'));
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

        $Student = new Student();
        $Student->FirstName = $request->FirstName;
        $Student->SecondName = $request->SecondName;
        $Student->DateOfBirth = $request->DateOfBirth;
        $Student->Male = $request->Male;
        $Student->Parent_id = $request->Parent_id;

        if ($request->hasFile('Photo')) {
            //
            $Photo = $request->file('Photo');
            $databaseName = Config::get('database.connections.'.Config::get('database.default'));

            // dd($databaseName);
            $Nextid = DB::table('INFORMATION_SCHEMA.TABLES')
                ->select('AUTO_INCREMENT as id')
                ->where('TABLE_SCHEMA',$databaseName['database'])
                ->where('TABLE_NAME', 'students')
                ->get();
            $Nextid = $Nextid->all();


            // $id = DB::select("SHOW TABLE STATUS LIKE 'students'");
            // $Nextid = $id[0]->Auto_increment;
            // dd($Photo);
            // $date = Carbon::now();
            $Photo->storeAs('/public/StudentImages', "Student_" .    $Student->FirstName .  $Nextid[0]->id . "." . $Photo->extension());
            $Student->Photo =  "Student_" .    $Student->FirstName . $Nextid[0]->id . "." . $Photo->extension();
        }
        $Student->save();
        $Students = Student::paginate(5);
        $StudentParents = StudentParent::all();
        return view("student/index", compact("Students", "StudentParents"));
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
        $StudentParents = StudentParent::all();
        $SelectedStudent = Student::find($id);
        $Students = Student::paginate(5);

        return view("student/index", compact("Students", "StudentParents", 'SelectedStudent'));
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

        $Student = Student::find($id);
        $Student->FirstName = $request->FirstName;
        $Student->SecondName = $request->SecondName;
        $Student->DateOfBirth = $request->DateOfBirth;
        $Student->Male = $request->Male;
        $Student->Parent_id = $request->Parent_id;

        if ($request->hasFile('Photo')) {
            //

            Storage::delete('Public/StudentImages/' . $Student->Photo);
            $Photo = $request->file('Photo');
            $Photo->storeAs('Public/StudentImages', "Student_" . $Student->id . "." . $Photo->extension());
            $Student->Photo =  "Student_" . $Student->id . "." . $Photo->extension();
        }
        $Student->save();
        $Students = Student::paginate(5);
        $StudentParents = StudentParent::all();
        return view("student/index", compact("Students", "StudentParents"));
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

        $Student = Student::find($id);
        $Student->delete();
        $Students = Student::paginate(5);
        $StudentParents = StudentParent::all();
        return view("student/index", compact("Students", "StudentParents"));
    }
}
