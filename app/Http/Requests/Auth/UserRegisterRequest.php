<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
    */
    public function rules(): array
    {
        return [
            'name'      => ['required','string','min:2'],
            'email'     => ['required','email','max:255','unique:users'],
            'email2'    => ['required','email','max:255','same:email'],
            'password'  => ['required','string','min:6'],
            'password2' => ['required','string','same:password']
        ];
    }
}
