<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);
// include  "../bootstrap.php";

// use Core\Route;

// // Définir les routes ici
// Route::get('/client', 'ClientController@index');
// Route::post('/client', 'ClientController@store');
// Route::post('/ajoutDette', 'ClientController@listAdd');


// // Gérer les requêtes
// Route::handleRequest();


include "../bootstrap.php";

 use Core\Route;

// Définir les routes ici
Route::get('/client', ['controller' => 'ClientController', 'method' => 'index']);
Route::post('/client', ['controller' => 'ClientController', 'method' => 'store']);
Route::post('/ajoutDette', ['controller' => 'ClientController', 'method' => 'listAdd']);
Route::get('/dette/list/#id', ['controller' => 'ClientController', 'method' => 'listdette']);
// Gérer les requêtes
Route::handleRequest();



// $route->handleRequest();

