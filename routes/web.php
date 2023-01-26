<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('/');
});
use App\Http\Controllers\TaskController;

Route::resource("/tasks", TaskController::class);
Route::put('/update_etat/{task}', [TaskController::class, 'etat'])-> name('update_etat');


/* 
post : ajouter
get : affichage ( 2 type get all ou get by id )
put : modification
delete : suppression

*/