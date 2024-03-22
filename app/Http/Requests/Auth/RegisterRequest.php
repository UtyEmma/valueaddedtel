<?php

namespace App\Http\Requests\Auth;

use App\Rules\Country;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules($country = null): array {
        $country = $this->country ?? $country;
        return [
            "firstname" => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', new Country()],
            'email' => ['required', 'email', 'unique:users,email'],
            'phone' => ['required', 'phone:country'],
            'password' => ['required', Password::default()],
            'referrer' => ['required', 'exists:users,username'],
            'username' => ['required', 'unique:users,username']
        ];
    }
}
