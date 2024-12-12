<?php

use App\Http\Controllers\FeedBackController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/feedPost', [FeedBackController::class,'feedPost']); //feedback view

Route::post('/feedback/save', [FeedBackController::class, 'saveFeedback']); // Add or edit feedback
Route::get('/feedback/{id}', [FeedBackController::class, 'getFeedbackById']);  // Get feedback by ID
Route::get('/feedbacks', [FeedBackController::class, 'getAllFeedback']);   // Get all feedback
Route::delete('/deleteFeedback/{id}', [FeedBackController::class, 'deleteFeedbackById']);   // delete by ID
