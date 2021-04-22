<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Ultis\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sendBadRequest($data = [], $message = "Bad Request") {
        return Response::sendBadRequest($data, $message);
    }

    public function sendServerError($data = [], $message = "Server Error") {
        return Response::sendServerError($data, $message);
    }

    public function sendPermissionDenied($data = [], $message = "Permission denied") {
        return Response::sendPermissionDenied($data, $message);
    }

    public function sendSuccess($data = [], $message = "Success") {
        return Response::sendSuccess($data, $message);
    }

    public function sendUnauthorized($data = [], $message = "Unauthorized") {
        return Response::sendUnauthorized($data, $message);
    }

    public function sendNotFoundRequest($data = [], $message = "Not Found") {
        return Response::sendNotFoundRequest($data, $message);
    }
} 
