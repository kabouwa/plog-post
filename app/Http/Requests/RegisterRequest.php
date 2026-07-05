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
            'name'     => 'required|min:4|max:35',
            'email'    => 'required|min:10|max:100|email|unique:users',
            'username' => 'required|min:4|max:35|unique:users',
            // 'password' => ['required','min:8','max:100','confirmed', Password::min(8)->letters()->numbers()->symbols()],
            'password' => ['required','min:4','max:100','confirmed'],
            'password_confirmation' => 'required',
        ];
    }
}
