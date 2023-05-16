<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/json', '\App\Http\Controllers\JsonController@getAPI');
Route::post('/json', '\App\Http\Controllers\JsonController@createAPI');
Route::put('/json', '\App\Http\Controllers\JsonController@createAPI');

// Route::get('/github/hola', '\App\Http\Controllers\GitHubController@hola');

//Weather Api
Route::get('/weather', '\App\Http\Controllers\WeatherController@getWeather');

//Chuck Norris Api
Route::get('/chucknorris', '\App\Http\Controllers\ChuckNorrisController@getJoke');
Route::post('/chucknorris', '\App\Http\Controllers\ChuckNorrisController@createJoke');
Route::put('/chucknorris', '\App\Http\Controllers\ChuckNorrisController@updateJoke');

//Chuck Norris Api
Route::get('/trello', '\App\Http\Controllers\TrelloController@getCards');
Route::post('/trello', '\App\Http\Controllers\TrelloController@createCard');
Route::put('/trello', '\App\Http\Controllers\TrelloController@updateCard');







