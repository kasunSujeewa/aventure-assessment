<?php

namespace App\Traits;

trait ApiResponse
{

    public function sendSuccess($message, $data = [], $code = 200)
    {
        return response()->json(['error' => false, 'data' => $data, 'message' => $message], $code);
    }

    public function sendError($message, $data = [], $code = 404)
    {
        return response()->json(['error' => true, 'data' => $data, 'message' => $message], $code);
    }
}
