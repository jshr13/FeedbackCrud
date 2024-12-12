<?php

use App\Http\Controllers\FeedbackController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [FeedbackController::class,'index']);
Route::get('/feedback/{id}', [FeedbackController::class,'feedbacks']);