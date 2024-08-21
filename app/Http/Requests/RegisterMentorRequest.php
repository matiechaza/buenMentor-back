<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class RegisterMentorRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'rate' => 'required|numeric|min:0',
            'profile_photo' => 'nullable|image|max:2048', // Máx 2 MB
        ];
    }
}
