<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }   

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'user_name' => 'required|string|max:255',
            'cpf' => 'required|string|digits:11',
        ];
    }

    public function messages(): array
    {
        return [
            'cpf.digits:11' => 'CPF must have 11 digits.',
        ];
    }
}
