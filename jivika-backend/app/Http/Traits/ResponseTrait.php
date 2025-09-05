<?php

namespace App\Http\Traits;

trait ResponseTrait
{
    /**
     * Generate success response.
     *
     * @param  array $data
     * @param  string $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function successResponse($message = "", $data = [])
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ]);
    }

    /**
     * Generate error response.
     *
     * @param  string $message
     * @param  int $status
     * @return \Illuminate\Http\JsonResponse
     */
    protected function errorResponse($message = "", $status = 400)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
        ], $status);
    }
}
