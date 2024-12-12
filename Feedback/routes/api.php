<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedbackController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('feedback/{id}',[FeedbackController::class, 'show']); // display feedback
Route::post('addFeedback',[FeedbackController::class, 'store']); // insert feedback





Route::delete('deleteFeedback/{id}',[FeedbackController::class, 'destroy']); // delete feedback

Route::post('/feedback/save', [FeedbackController::class, 'saveFeedback']);
Route::get('/feedback', [FeedbackController::class, 'getAllFeedback']);

// Get feedback by ID
Route::get('/feedback/{id}', [FeedbackController::class, 'getFeedbackById']);