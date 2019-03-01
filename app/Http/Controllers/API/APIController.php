<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller as Controller;

class APIController extends Controller
{
    /**
     * Generate JSON response
     *
     * @param $success
     * @param $message
     * @param $data
     * @param $code
     * @return \Illuminate\Http\JsonResponse
     */
    private function sendResponse($success, $message, $data, $code)
    {
        return response()->json([
            'success' => $success,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * Send success JSON response
     *
     * @param $message
     * @param $data
     * @param $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendSuccessResponse($message, $data = [], $code = 200)
    {
        return $this->sendResponse(true, $message, $data, $code);
    }

    /**
     * Send error JSON response
     *
     * @param $message
     * @param $data
     * @param $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendErrorResponse($message, $data = null, $code = 400)
    {
        return $this->sendResponse(false, $message, $data, $code);
    }
}