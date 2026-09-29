<?php

namespace App\Http\Controllers;

class CompanyController extends Controller
{
    public function index()
    {
        $infos = [
            'Nom' => 'Octet',
            'Année de création' => 2012,
            'Mission' => 'Réparer plutôt que remplacer',
        ];

        return view('company', ['infos' => $infos]);
    }
}
