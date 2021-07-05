<?php

namespace App\Http\Traits;

use Illuminate\Http\JsonResponse;

trait ResponseTrait
{
    /**
     * @param array $params
     * @param int $statusCode
     * @return JsonResponse
     */
    protected function successResponse(array $params, int $statusCode = 200): JsonResponse
    {
        return new JsonResponse([
            "success" => true,
            "data" => $params
        ], $statusCode);
    }

    /**
     * @param array $params
     * @param int $statusCode
     * @return JsonResponse
     */
    protected function errorResponse(array $params, int $statusCode = 400): JsonResponse
    {
        return new JsonResponse([
            'success' => false,
            'error' => $params,
        ], $statusCode);
    }
}
