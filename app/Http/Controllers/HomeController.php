<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\teacher;
use App\StudentParent;
use App\Classe;
use App\Matiere;

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
        $counts = [
            "Students" => count(Student::all()),
            "Teachers" => count(teacher::all()),
            "Parents" => count(StudentParent::all()),
            "Classes" => Count(Classe::all()),
            "Girls" => Count(Student::where('Male', '=', 0)->get()),
            "Boys" => Count(Student::where('Male', '=', 1)->get())
        ];

        $Matieres = Matiere::with('Teachers')->get()->sortByDesc(function ($matiere) {
            return $matiere->teachers->count();
        });
        return view('home', compact("counts", "Matieres"));
    }
}
