<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Mentor;
use Illuminate\Http\Request;

final class MentorDetailController extends Controller
{
    public function show(Mentor $mentor)
    {
        $reviews = $mentor->reviews()->latest()->get();
        $availabilities = $mentor->availabilities;
        return view('mentors.show', compact('mentor', 'availabilities', 'reviews'));
    }

    public function storeReview(Request $request, Mentor $mentor)
    {
        $validated = $request->validate([
            'review' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $mentor->review($validated['review'], auth()->user(), (float) $validated['rating']);

        return redirect()->route('mentors.show', $mentor)->with('success', 'Review submitted successfully.');
    }
}
