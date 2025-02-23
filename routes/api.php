<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\librarycontroller;


Route::get('/library', [librarycontroller::class, 'index']);

Route::get('/library/{id}',[librarycontroller::class, 'show']);

Route::post('/library',[librarycontroller::class, 'store']);

Route::put('/library/{id}',[librarycontroller::class, 'update']);

Route::patch('/library/{id}',[librarycontroller::class, 'updatePartial']);

Route::delete('/library/{id}',[librarycontroller::class, 'destroy']);