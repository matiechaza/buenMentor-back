<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Availability;
use Illuminate\Http\Request;

final class AvailabilityController extends Controller
{
    public function index()
    {
        return view('availability.index', ['availabilities' => auth()->user()->mentor->availabilities]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'day' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        auth()->user()->mentor->availabilities()->create([
            'day' => $request->input('day'),
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time'),
        ]);

        return redirect()->back()->with('success', 'Availability updated successfully.');
    }

    public function update(Availability $availability, Request $request)
    {
        $request->validate([
            'day' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        $availability->update([
            'day' => $request->input('day'),
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time'),
        ]);

        return redirect()->back()->with('success', 'Availability updated successfully.');
    }

    /*public function destroy(Availability $availability)
    {
        $this->authorize('delete', $availability);
        $availability->delete();
        return redirect()->back()->with('success', 'Availability removed successfully.');
    }*/
}
