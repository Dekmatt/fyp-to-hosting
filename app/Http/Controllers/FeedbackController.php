<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function submit(Request $request)
    {
        // Validate the feedback
        $request->validate([
            'feedback' => 'required|string|max:100000000000',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Save the feedback to the database
        Feedback::create([
            'user_id' => auth()->id(),
            'feedback' => $request->feedback,
            'rating' => $request->rating,
        ]);

        // Redirect to the dashboard with a success message
        return redirect()->route('dashboard')->with('success', 'Thank you for your feedback!');
    }
}