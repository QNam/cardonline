<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Card;

class AuthController extends Controller
{
    //
    public function login(LoginRequest $request) {
        $cardContent = Card::where('email', $request->email)->first();

        if(!$cardContent) {
            return $this->sendUnauthorized();
        }

        if(!Hash::check($request->password, $cardContent->password)) {
            return $this->sendUnauthorized();
        }

        Auth::login($cardContent, true);
        $cardAsArr = $cardContent->toArray();
        unset($cardAsArr['password']);
        return $this->sendSuccess(['data' => $cardAsArr]);
    }

    public function register(RegisterRequest $request) {
        $card = new Card();
        $emailExists = Card::checkEmailExists($request->email);
        $cardIdExists = Card::checkCardExists($request->id);

        if($emailExists) {
            $rep = [
                "error" => [
                    "email" => [
                        "The email has already been taken."
                    ]
                ]
            ];
            return $this->sendBadRequest($rep);
        }

        if(!$cardIdExists) {
            $rep = [
                "error" => [
                    "id" => [
                        "The id is not allow."
                    ]
                ]
            ];
            return $this->sendBadRequest($rep);
        }

        $data = [
            'userName' => $request->userName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        try {
            $card->where('id', $request->id)->update($data);
            return $this->sendSuccess();
        } catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }
}
