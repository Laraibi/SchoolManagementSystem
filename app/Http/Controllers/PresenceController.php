<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classe;


class PresenceController extends Controller
{
    //

    public function index()
    {
        //
        $Classes=Classe::all();
      
        return view("seance.presence",compact("Classes"));
    }
    public function SuiviPresence()
    {
        //
        $Classes=Classe::all();
      
        return view("seance.suivipresence",compact("Classes"));
    }

}
