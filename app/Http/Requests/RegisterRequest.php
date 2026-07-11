<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'     => 'required|string|min:3|max:35',
            'email'    => 'required|string|min:10|max:100|email|unique:users',
            'username' => 'required|string|min:3|max:35|unique:users',
            // 'password' => ['required','min:8','max:100','confirmed', Password::min(8)->letters()->numbers()->symbols()],
            'password' => ['required','string','min:8','max:100','confirmed'],
            'profile' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:10240',
            'bio' => 'nullable|string|max:150',
        ];
    }
}
