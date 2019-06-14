<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'Index@index');
Route::get('/info', 'Index@info');
