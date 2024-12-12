<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedbackController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::delete('deleteFeedback/{id}',[FeedbackController::class, 'destroy']); //Delete feedback
Route::post('/feedback/save', [FeedbackController::class, 'saveFeedback']);//Add and Edit Feedback
Route::get('/feedback', [FeedbackController::class, 'getAllFeedback']); //Display all feedback
Route::get('/feedback/{id}', [FeedbackController::class, 'getFeedbackById']);// Get feedback by ID