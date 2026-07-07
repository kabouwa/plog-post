<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $user = $this->route('user');
        return [
            'name'     => 'required|between:3,35',
            'email'    => 'required|min:10|max:100|email|unique:users,email,' . $user->id,
            'username' => 'required|between:4,35|unique:users,username,' . $user->id,
            // 'password' => ['required','min:8','max:100','confirmed', Password::min(8)->letters()->numbers()->symbols()],
            'password' => 'nullable|min:8|max:100|confirmed',
            'bio' => 'nullable|max:150',
            'profile' => 'nullable|mimes:png,jpg,jpeg,svg|max:10240'
        ];
    }
}
