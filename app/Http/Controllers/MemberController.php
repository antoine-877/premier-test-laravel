<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberController extends Controller
{

    private array $members = [
        ['first_name' => 'Alice', 'age' => 29],
        ['first_name' => 'Bob', 'age' => 34],
        ['first_name' => 'Chloé', 'age' => 17],
        ['first_name' => 'Damien', 'age' => 42],
    ];

    public function index()
    {
        return view('members', ['members' => $this->members]);
    }

    public function empty()
    {
        return view('members', ['members' => []]);
    }
}
