<?php

namespace App\Http\Requests;

use App\Http\Requests\Contracts\ApiRequestInterface;
use Illuminate\Validation\Rule;

class LoginRequest extends ApiRequest implements ApiRequestInterface
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => [ 'required', 'email', 'max:255', Rule::exists('users', 'email') ],
            'password' => [ 'required', 'string', 'between:8,255' ],
        ];
    }

    public function attributes(): array
    {
        return [
            'email' => 'メールアドレス',
            'password' => 'パスワード',
        ];
    }
}
