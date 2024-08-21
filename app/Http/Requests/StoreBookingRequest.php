<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class StoreBookingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'mentor_id' => 'required|exists:mentors,id',
            'session_date' => 'required|date|after:now',
        ];
    }
}
