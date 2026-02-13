<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre'   => 'required|min:3|max:120',
            'email'    => 'required|email',
            'telefono' => 'nullable|max:30',
            'mensaje'  => 'required|min:10|max:2000',
        ];
    }
}