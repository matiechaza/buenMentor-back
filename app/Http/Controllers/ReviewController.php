<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use Illuminate\Http\Request;

final class ReviewController extends Controller
{
    public function store(Request $request, Mentor $mentor)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:255',
        ]);

        $mentor->review(
            $request->input('review'),
            $request->input('rating'),
            auth()->user()
        );

        return redirect()->route('mentors.show', $mentor)->with('success', 'Review submitted successfully.');
    }
}
