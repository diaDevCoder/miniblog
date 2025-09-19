<?php
namespace App;

use Illuminate\Http\JsonResponse;

/**
 * [Response Trait]
 */
trait Response
{

    /**
     * Show success message response
     * @param mixed $error
     * @param mixed $message
     * @param mixed $data
     * @param mixed $status
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function success($message, $data = null, $code = 200)
    {
        return response()->json([
            'error' => false,
            "message" => $message,
            "data" => $data,
        ], $code);
    }

    /**
     * Show error message response
     * @param mixed $error
     * @param mixed $message
     * @param mixed $data
     * @param mixed $status
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function fail($message, $data = null, $code = 400)
    {
        return response()->json([
            'error' => true,
            "message" => $message,
            "data" => $data,
        ], $code);
    }

    public function notFound($message, $data = null)
    {
        return response()->json([
            'error' => true,
            "message" => $message,
            "data" => $data,
        ], 404);
    }
}