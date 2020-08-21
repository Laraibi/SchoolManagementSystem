<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\teacher;
use App\StudentParent;
use App\Classe;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $counts=["Students"=>count(Student::all()),
                "Teachers"=>count(teacher::all()),
                "Parents"=>count(StudentParent::all()),
            "Classes"=>Count(Classe::all())];
        return view('home',compact("counts"));
    }
}
