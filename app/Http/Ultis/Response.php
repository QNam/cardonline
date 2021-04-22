<?php 

namespace App\Http\Ultis;

class Response {
    static public function sendResponse($statusCode, $data, $message = "") {
        $rep = [
            'statusCode' => $statusCode,
            'data' => $data,
            'message' => $message
        ];

        return response()->json($rep, $statusCode);
    }

    static public function sendBadRequest($data = [], $message = "Bad Request") {
        return Response::sendResponse(400, $data, $message);
    }

    static public function sendNotFoundRequest($data = [], $message = "Not Found") {
        return Response::sendResponse(404, $data, $message);
    }

    static public function sendServerError($data = [], $message = "Server Error") {
        return Response::sendResponse(500, $data, $message);
    }

    static public function sendPermissionDenied($data = [], $message = "Permission denied") {
        return Response::sendResponse(403, $data, $message);
    }

    static public function sendUnauthorized($data = [], $message = "Permission denied") {
        return Response::sendResponse(401, $data, $message);
    }

    static public function sendSuccess($data = [], $message = "Success") {
        return Response::sendResponse(200, $data, $message);
    }
}