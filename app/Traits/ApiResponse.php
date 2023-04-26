<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    public function success($code = 200, $data = [], $extra = []): JsonResponse
    {
        return response()->json([
            'success' => 1,
            'data'    => $data,
            "error"   => null,
            "errors"  => [],
            "extra"   => $extra
        ], $code);
    }

    public function failed($error = 'error', $code = 500, $errors = []): JsonResponse
    {
        return response()->json([
            'success' => 0,
            'data'    => [],
            'error'   => $error,
            "errors"  => $errors,
        ], $code);
    }


}