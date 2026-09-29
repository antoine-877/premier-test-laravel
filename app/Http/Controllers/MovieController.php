<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index():string{
        return "Trois films a l'affiche cette semaine";
    }

    public function show(int $id):string{
        return "Fiche du Film $id";
    }

    public function showtimes(int $id):string{
        return "Séances du film $id: 14h, 17h et 20h30";
    }
}
