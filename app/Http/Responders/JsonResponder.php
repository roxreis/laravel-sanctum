<?php

namespace App\Http\Responders;

use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Contracts\Routing\ResponseFactory;

class JsonResponder
{
    private $response_factory;

    public function __construct(ResponseFactory $response_factory)
    {
        $this->response_factory = $response_factory;
    }

    public function response($data = [], int $error_code = 200, ?array $error_messages = null): JsonResponse
    {
        return $this->response_factory->json([
            'payload' => $data,
            'errorMessages' => $error_messages,
        ], $error_code);
    }
}
