<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IssuesController;
Route::get('/', function () {
    return view('welcome');
});

Route::resource('issues',IssuesController::class);
