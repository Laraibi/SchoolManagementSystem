<?php

use App\StudentParent;
use App\Classe;
use App\Seance;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Carbon\Carbon;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    if (Auth::check()) {
        // return view('home');
        return redirect("home");
    } else {
        return view('auth/login');
    }
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource("Students", "StudentController")->middleware('auth');
Route::resource("StudentParents", "StudentParentController")->middleware('auth');
Route::resource("Teachers", "TeacherController")->middleware('auth');
Route::resource("Classes", "ClasseController")->middleware('auth');
Route::resource("Matieres", "MatiereController")->middleware('auth');
Route::resource("Cours", "CourController")->middleware('auth');
Route::resource("Examens", "ExamenController")->middleware('auth');
Route::resource("Seances", "SeanceController")->middleware('auth');



Route::post('/Classe/addStudents', "ClasseController@addStudents")->middleware('auth');
Route::get('/Classe/{class_id}/removeStudent/{student_id}', "ClasseController@removeStudent")->name('removeStudentFromClasse')->middleware('auth');


Route::get('/Presence',"PresenceController@index")->name('Presence')->middleware('auth');


Route::get("/getPlanningClasse", "ajaxcontroller@getPlanningClasse")->name("getPlanningClasse")->middleware('auth');
Route::get("/getMatiereCoursesOrExams", "ajaxcontroller@getMatiereCoursesOrExams")->name("getMatiereCoursesOrExams")->middleware('auth');
Route::get("/addSeance", "ajaxcontroller@addSeance")->name("addSeance")->middleware('auth');
Route::get("/editSeance", "ajaxcontroller@editSeance")->name("editSeance")->middleware('auth');
Route::get("/deleteSeance", "ajaxcontroller@deleteSeance")->name("deleteSeance")->middleware('auth');
Route::get("/getSeance", "ajaxcontroller@getSeance")->name("getSeance")->middleware('auth');
Route::get("/GetClasseStudents", "ajaxcontroller@GetClasseStudents")->name("GetClasseStudents")->middleware('auth');


route::get("/test", function () {
    $Classe = Classe::find(2);
    $DateBeginWeek ='2020-08-31';
    $WeekNumber = Carbon::parse($DateBeginWeek);


    // $date = Carbon::now(); // or $date = new Carbon();
    // $date->setISODate(2020, 36); // 2016-10-17 23:59:59.000000
    // $Seance=Seance::all()->where("DateSeance",">=",$date->startOfWeek())->where("DateSeance","<=",$date->endOfWeek());
    // $Seance=Seance::all();
    // dd($Seance->get(0)->Type);
    // echo "Start OF Week : " . $date->endOfWeek();
   dd( $Classe->PlanningSemaine(36,2020)->get(1)->TypeObject->Name );
   
});
