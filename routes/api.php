<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\librarycontroller;


Route::get('/library', [librarycontroller::class, 'index']);

Route::get('/library/{id}',function (){
    return 'obteniendo estudiante';
});

Route::post('/library',[librarycontroller::class, 'store']);

Route::put('/library/{id}',function (){
    return 'actualizando';
});

Route::delete('/library/{id}',function (){
    return 'actualizando';
});