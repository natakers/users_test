<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'name' => 'max:255',
            'email' => 'email',
        ];
    }
    public function messages()
    {
        return [
            'name.min' => 'Максимальная длина - 255 символа',
            'email.email' => 'Введите корректный email',
        ];
    }
    protected function passedValidation()
    {
        $this->merge(['email'=> mb_strtolower($this->input('email'))]);
    }
}
