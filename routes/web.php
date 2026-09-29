<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\ParkingRateController;
use Illuminate\Support\Facades\Route;

// ============================================================
// ============================================================
// ============================================================
// Chapter Routing
// ============================================================
// ============================================================
// ============================================================

// ============================================================
// EXO-01 — Première route
// ============================================================
// La route "/" correspond à la page d'accueil.
// Elle affiche la vue "welcome".
Route::get('/', function () {
    return view('welcome');
});


// ============================================================
// EXO-01 — Route /hello
// ============================================================
// GET /hello affiche un message.
// ->name('hello') donne le nom "hello" à cette route.
// Ce nom permettra ensuite de générer son URL avec route('hello').
Route::get("/hello", function() : string {
    return "Hello World, Ceci est ma première route lavavel.";
})->name('hello');


// ============================================================
// EXO-02 — Route avec paramètre
// ============================================================
// {firstName} est un paramètre obligatoire dans l'URL.
// Exemple : /profil/Alice
// $firstName reçoit la valeur "Alice".
//
// ->name('profile') donne le nom "profile" à la route.
Route::get("/profil/{firstName}", function(string $firstName) : string {
    return "Bienvenue sur votre profil, $firstName !";
})->name('profile');


// ============================================================
// EXO-03 — Deux paramètres + contrôle numérique
// ============================================================
// {a} et {b} sont deux paramètres obligatoires.
//
// preg_match() vérifie que les paramètres contiennent uniquement
// des chiffres.
//
// Si l'un des deux paramètres n'est pas numérique,
// Laravel renvoie une erreur 404.
//
// Exemple : /calcul/10/5
// Résultat : La somme de : 10 et 5 est 15
Route::get("/calcul/{a}/{b}", function($a, $b) {

    if (!preg_match('/^[0-9]+$/', $a) || !preg_match('/^[0-9]+$/', $b)) {
        abort(404);
    }

    $total = $a + $b;

    return "La somme de : $a et $b est $total";
});


// ============================================================
// EXO-04 — Paramètre optionnel
// ============================================================
// {lang?} signifie que le paramètre "lang" est facultatif.
//
// /bienvenue       → français par défaut
// /bienvenue/fr    → français
// /bienvenue/en    → anglais
// /bienvenue/es    → espagnol
//
// Si une autre langue est donnée,
// le message "Langue non surpportée." est affiché.
Route::get("/bienvenue/{lang?}", function($lang = "fr") {

    if ($lang === "en") {
        return "Welcome";

    } elseif($lang === "es") {
        return "¡Bienvenido!";

    } elseif($lang === "fr") {
        return "Bienvenue";

    } else {
        return "Langue non surpportée.";
    }
});


// ============================================================
// EXO-05 — Route POST
// ============================================================
// Cette route accepte uniquement les requêtes HTTP POST.
//
// Exemple : un formulaire peut envoyer ses données vers
// /formulaire.
//
// Une requête GET vers cette adresse donnera une erreur 405.
Route::post("/formulaire", function(){
    return "Formulaire envoyé avec succès!";
});


// ============================================================
// EXO-06 / EXO-09 — Redirection avec une route nommée
// ============================================================
// /ici redirige vers la route qui porte le nom "hello".
//
// L'avantage est que l'on utilise le NOM de la route,
// et non directement son chemin.
//
// Donc si /hello devient /bonjour,
// cette redirection suivra automatiquement le changement.
Route::get('/ici', function () {
    return redirect()->route('hello');
});


// ============================================================
// EXO-07 — Routes avec priorité
// ============================================================
// Cette route affiche le panier.
// Elle est déclarée avant /commandes/{number}.
Route::get('/commandes/panier', function () {
    return 'Votre panier';
});

// {number} représente le numéro de commande.
//
// where('number', '[0-9]+')
// impose que "number" contienne uniquement des chiffres.
//
// /commandes/123   → fonctionne
// /commandes/abc   → 404
Route::get('/commandes/{number}', function (string $number) {

    return "Commande n° $number";

})->where('number', '[0-9]+');


// ============================================================
// EXO-08 — Route vers une vue
// ============================================================
// Cette route affiche directement la vue "legal".
//
// Il n'est pas nécessaire d'utiliser une fonction anonyme.
// Laravel charge directement resources/views/legal.blade.php.
Route::view('/mentions-legales', 'legal');


// ============================================================
// EXO-10 — Route statique
// ============================================================
// /expositions affiche toutes les expositions.
Route::get('/expositions', function () {
    return 'Toutes les expositions';
});


// ============================================================
// EXO-10 — Route dynamique avec contrainte numérique
// ============================================================
// {id} représente l'identifiant d'une exposition.
//
// whereNumber('id') signifie que l'identifiant doit être numérique.
//
// /expositions/7          → fonctionne
// /expositions/prochaines → cette route ne correspond PAS
//                           car "prochaines" n'est pas un nombre.
Route::get('/expositions/{id}', function (string $id) {
    return "Exposition $id";
})->whereNumber('id');

// Cette route affiche les prochaines expositions.
//
// Elle peut être placée après /expositions/{id}
// grâce à la contrainte whereNumber().
Route::get('/expositions/prochaines', function () {
    return 'Prochaines expositions';
});

// Cette route accepte uniquement POST.
//
// GET /reservations → 405
// POST /reservations → "Réservation enregistrée"
Route::post('/reservations', function () {
    return 'Réservation enregistrée';
});

// {lang?} est facultatif.
//
// /visites      → Visite guidée en fr
// /visites/nl   → Visite guidée en nl
//
// Si aucune langue n'est fournie,
// la valeur par défaut est "fr".
Route::get('/visites/{lang?}', function (string $lang = 'fr') {
    return "Visite guidée en $lang";
});

// {price} doit contenir uniquement des lettres.
// whereAlpha('price')
//
// {count} doit contenir uniquement des chiffres.
// whereNumber('count')
//
// /billets/reduit/3
// → 3 billet(s) au tarif reduit
//
// /billets/3/reduit
// → 404 car les paramètres ne respectent pas les contraintes.
Route::get('/billets/{price}/{count}', function (string $price, int $count) {
    return "$count billet(s) au tarif $price";
})->whereAlpha('price')->whereNumber('count');

// ============================================================
// ============================================================
// ============================================================
// Chapter Controlers
// ============================================================
// ============================================================
// ============================================================


// ============================================================
// Cinema
// ============================================================

Route::get('/films', [MovieController::class, "index"])
    ->name("movie.index");

Route::get('films/{id}', [MovieController::class, "show"])
    ->name('movie.show')
    ->whereNumber('id');

Route::get('films/{id}/seances', [MovieController::class, "showtimes"])
    ->name('movie.showtimes')
    ->whereNumber('id');

// ============================================================
// Parking
// ============================================================

Route::get('/parking/{hours}', [ParkingRateController::class])
    ->whereNumber('hours');