<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get("/hello", function() : string{
    return "Hello World, Ceci est ma première route lavavel.";
});

Route::get("/profil/{firstName}", function(string $firstName) : string {
    return "Bienvenue sur votre profil, $firstName !";
});

Route::get("/calcul/{a}/{b}", function($a, $b) {

    if (!preg_match('/^[0-9]+$/', $a) || !preg_match('/^[0-9]+$/', $b)) {
        abort(404);
    }

    $total = $a + $b;

    return "La somme de : $a et $b est $total";
});

Route::get("/bienvenue/{lang?}", function($lang = "fr") {
    if ($lang === "en"){
        return "Welcome";  
    }elseif($lang === "es"){
        return "¡Bienvenido!";    
    }elseif($lang === "fr"){
        return "Bienvenue";
    }else{
        return "Langue non surpportée.";
    }
});

Route::post("/formulaire", function(){
    return "Formulaire envoyé avec succès!";
});

Route::redirect('/ici', '/hello', 302);


Route::get('/commandes/panier', function () {
    return 'Votre panier';
});

Route::get('/commandes/{number}', function (string $number) {

    return "Commande n° $number";

})->where('number', '[0-9]+');

Route::view('/mentions-legales', 'legal');