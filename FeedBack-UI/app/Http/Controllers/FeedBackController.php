<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FeedBackController extends Controller
{
    //
    public function addPost()
    {
        return view("feed.addeditFD");
    }

    public function feedPost()
    {
        return view("feed.feedbackPost");
    }

    public function getAllFeedback()
    {
        try {
            // Call the external API to fetch all feedback
            $response = Http::get("http://127.0.0.1:8002/api/feedback/");

            if ($response->successful()) {
                return response()->json(json_decode($response, true)); 
           }

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch feedback',
                'error' => $response->json(),
            ], $response->status());

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to connect to the external API',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getFeedbackById($id)
    {
        try {
            // Call the external API to fetch feedback by ID
            $response = Http::get("http://127.0.0.1:8002/api/feedback/{$id}");

            $data =$response->json();

            if ($response->successful()) {
                return response()->json($data);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Feedback not found',
                'error' => $data,
            ],);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to connect to the external API',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function saveFeedback(Request $request)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'action' => 'required|in:0,1',    // 0 for add, 1 for edit
            'id' => 'nullable|integer',      // Required for edit
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'body' => 'required|string|max:500',
        ]);

        try {
            // Send the request to the external API
            $response = Http::post("http://127.0.0.1:8002/api/feedback/save", $validated);

            // Check if the response is successful
            if ($response->successful()) {
                return response()->json([
                    'status' => 'success',
                    'message' => $response->json()['message'] ?? 'Operation successful',
                ], 200);
            }

            // Handle error response from the API
            return response()->json([
                'status' => 'error',
                'message' => $response->json()['message'] ?? 'Failed to save feedback',
                'error' => $response->json()['error'] ?? 'Unknown error',
            ], $response->status());
        } catch (\Exception $e) {
            // Handle connection errors or unexpected issues
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to connect to the external API',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function deleteFeedbackById($id)
    {
        $response = Http::delete("http://127.0.0.1:8002/api/deleteFeedback/{$id}");

        if ($response->successful()) {
            return response()->json([
                'message' => 'Feedback deleted.',
            ], 200);
        }else {
            return response()->json([
                'message' => 'No feedback found.'
            ], $response->status());
        }
    }
}
