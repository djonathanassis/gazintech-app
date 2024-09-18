<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

trait HttpResponses
{
    final public function response(
        string $message = '',
        string|int $status = Response::HTTP_OK,
        array|Model|JsonResource $data = [],

    ): JsonResponse {
        return response()->json([
            'message' => $message,
            'data' => $data
        ], $status);
    }

    final public function responseSuccess(
        string $message = "Successful",
        string|int $status = Response::HTTP_OK,
        array|Model|JsonResource $data = []
    ): JsonResponse {
        return response()->json([
            'message' => $message,
            'data'    => $data,
        ], $status);
    }


    final public function responseError(
        string $message = '',
        string|int $status = Response::HTTP_BAD_REQUEST,
    ): JsonResponse {
        return response()->json([
            'message' => $message,
        ], $status);
    }
}
