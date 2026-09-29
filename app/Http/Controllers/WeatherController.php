<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class WeatherController extends Controller
{
    private array $readings = ['wavre' => 15, 'namur' => 14, 'liege' => 13];

    public function index(): string
    {

        $result = '';

        foreach ($this->readings as $city => $temperature) {
            $result .= "La température à $city est de $temperature °C<br>";
        }

        return $result;
    }

    public function show(string $city): string
    {
        $temperature = $this->readings[$city];
        return "Latempérature à $city est de $temperature °C ";
    }

    public function showToday(): RedirectResponse
    {
        return redirect('/meteo?ville=namur');
    }
}
