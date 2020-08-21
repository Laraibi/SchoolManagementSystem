<?php

use App\StudentParent;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


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

    if(Auth::check()){
        // return view('home');
        return redirect("home");
    }else{
        return view('auth/login');
    }
    
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource("Students","StudentController")->middleware('auth');
Route::resource("StudentParents","StudentParentController")->middleware('auth');
Route::resource("Teachers","TeacherController")->middleware('auth');
Route::resource("Classes","ClasseController")->middleware('auth');
Route::resource("Matieres","MatiereController")->middleware('auth');
Route::resource("Cours","CourController")->middleware('auth');

Route::post('/Classe/addStudents',"ClasseController@addStudents")->middleware('auth');
Route::get('/Classe/{class_id}/removeStudent/{student_id}',"ClasseController@removeStudent")->name('removeStudentFromClasse')->middleware('auth');

// Route::get('/testStroage',function(){
//     $url=storage_path('StudentImages/Student_5.jpeg');
//     return $url;
// });

route::get("/test",function(){
    return view('dashtest');
});