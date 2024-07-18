<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include  "../bootstrap.php";

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
Route::post('/ajoutDette/#id', ['controller' => 'ClientController', 'method' => 'ajoutPanier']);
Route::get('/dette/list/#id', ['controller' => 'ClientController', 'method' => 'listdette']);
Route::post('/dette/list/#id', ['controller' => 'DetteController', 'method' => 'filtrePaginate']);

Route::get('/ajoutDette/#id', ['controller' => 'ClientController', 'method' => 'listAdd']);
Route::get('/paiement/list/#id', ['controller' => 'DetteController', 'method' => 'listPayments']);
Route::get('/paiement/pay/#id', ['controller' => 'DetteController', 'method' => 'formpayer']);
Route::post('/paiement/pay/#id', ['controller' => 'DetteController', 'method' => 'payer']);
Route::get('/details/article/#id', ['controller' => 'DetteController', 'method' => 'listArticle']);
Route::post('/dette/register', ['controller' => 'DetteController', 'method' => 'registerDebt']);
// Gérer les requêtes
Route::handleRequest($config);



// $route->handleRequest();

