<?php

namespace App\Http\Requests\Contracts;

interface ApiRequestInterface
{
    public function rules(): array;

    public function attributes(): array;
}
