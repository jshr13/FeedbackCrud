<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Feeback view
        return view('feedback.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Check if the feedback exists before attempting to delete it
        $feedback = DB::select('SELECT * FROM feedback WHERE id = ?', [$id]);

        if (empty($feedback)) {
            return response()->json([
                'status' => 'error',
                'message' => 'No feedback found.',
            ], 404);
        }

        // Call the stored procedure to delete feedback
        $deleted = DB::statement('CALL deleteFeedback(?)', [$id]);

        if (!$deleted) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unable to delete feedback.',
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Feedback deleted successfully.',
        ], 200);
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
            // Call the stored procedure
            DB::statement('CALL saveFeedback(?, ?, ?, ?, ?)', [
                $validated['action'],           // 0 (add) or 1 (edit)
                $validated['id'] ?? null,       // Feedback ID, null for add
                $validated['name'],             // Feedback name
                $validated['email'],            // Feedback email
                $validated['body'],             // Feedback body
            ]);

            // Return success response
            return response()->json([
                'status' => 'success',
                'message' => $validated['action'] == 0
                    ? 'Feedback added successfully'
                    : 'Feedback updated successfully',
            ], 200);

        } catch (\Exception $e) {
            // Handle errors and return a failure response
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to save feedback',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getAllFeedback()
    {
        try {
            // Fetch all feedback from the database
            $feedback = DB::select('SELECT * FROM feedback ORDER BY created_at DESC');

            return response()->json([
                'status' => 'success',
                'data' => $feedback,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch feedback',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getFeedbackById($id)
    {
        try {
            // Fetch feedback by ID
            $feedback = DB::select('SELECT * FROM feedback WHERE id = ?', [$id]);

            if (empty($feedback)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Feedback not found',
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $feedback[0],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch feedback',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
