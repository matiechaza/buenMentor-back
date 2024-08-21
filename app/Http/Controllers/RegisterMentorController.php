<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Requests\RegisterMentorRequest;
use App\Models\Country;
use App\Models\Language;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

final class RegisterMentorController extends Controller
{
    // Mostrar formulario de registro para mentores
    public function showRegistrationForm()
    {
        return view('auth.mentor.register');
    }

    // Manejar el registro de mentores
    public function register(RegisterMentorRequest $request, CreateNewUser $userCreator)
    {
        $user = $userCreator->create($request->all());

        // Crear el mentor
        $user->mentor()->create([
            'rate' => $request->float('rate'),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('register.mentor.step2');
    }

    public function showStep2()
    {
        return view('auth.mentor.step2', [
            'countries' => Country::all(['id', 'name']),
            'languages' => Language::all(['id', 'name']),
        ]);
    }

    public function postStep2(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'country_id' => 'required|string|max:255',
            'languages' => 'required|max:255',
        ]);

        User::where('id', auth()->id())->update([
            'title' => $request->input('title'),
            'company' => $request->input('company'),
            'country_id' => $request->input('country_id'),
            'languages' => $request->input('languages'),
        ]);

        return redirect()->route('register.mentor.step3');
    }

    public function showStep3()
    {
        return view('auth.mentor.step3', [
            'user' => auth()->user(),
        ]);
    }

    public function postStep3(Request $request)
    {
        $request->validate([
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'bio' => 'max:2000',
        ]);

        $user = Auth::user();
        $user->bio = $request->input('bio');
        if ($request->hasFile('profile_photo')) {
            $user->updateProfilePhoto($request->file('profile_photo'));
        }

        $user->save();

        return redirect()->route('register.mentor.step4');
    }

    public function showStep4()
    {
        return view('auth.mentor.step4');
    }

    public function postStep4(Request $request)
    {
        $request->validate([
            'day' => 'required|array',
            'day.*' => 'required|string',
            'start_time' => 'required|array',
            'start_time.*' => 'required|date_format:H:i',
            'end_time' => 'required|array',
            'end_time.*' => 'required|date_format:H:i|after:start_time.*',
        ]);

        $data = [];
        foreach ($request->input('day') as $index => $day) {
            $data[] = [
                'day' => $day,
                'start_time' => $request->input('start_time')[$index],
                'end_time' => $request->input('end_time')[$index],
            ];
        }

        auth()->user()->mentor->availabilities()->createMany($data);

        return redirect()->route('dashboard');
    }
}
