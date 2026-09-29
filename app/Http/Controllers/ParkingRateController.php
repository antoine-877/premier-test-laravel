<?php

namespace App\Http\Controllers;


class ParkingRateController extends Controller
{
    public function __invoke(int $hours): string
    {
        $total = min($hours * 1.5, 12);

        $totalParking = number_format($total, 2, ',', '');

        return "$hours heure(s) de parking : $totalParking €";
    }
}

