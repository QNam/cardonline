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
            $request->session()->flash('LOGIN_STATUS', 'Tài khoản hoặc mật khẩu không chính xác !');
            return redirect()->back();
        }

        if(!Hash::check($request->password, $cardContent->password)) {
            $request->session()->flash('LOGIN_STATUS', 'Tài khoản hoặc mật khẩu không chính xác !');
            return redirect()->back();
        }
        $access_token = Hash::make($cardContent->id.'namdzdzbodoiqua');
        session(['access_token' => $access_token]);
        
        Auth::login($cardContent, true);
        
        $cardAsArr = $cardContent->toArray();
        unset($cardAsArr['password']);
        unset($cardAsArr['confirm_code']);

        return redirect()->route('EditUser', ['id' => $cardAsArr['id']]);
    }

    public function logout(Request $request) {
        if(Auth::check()) {
            Auth::logout();
        }

        return redirect()->back();
    }

    public function registerIndex(Request $request) {
        
        if($request->id && !$request->code && $request->id >= 500000 && $request->id <= 509999) {
            $card = Card::where('id', $request->id)->first();
            if($card) {
                return redirect()->route('Register', ['code' => $card->confirm_code, 'id' => $request->id]);
            }
        }
        

        return view('enduser/app');
        // 500611 - 
    }

    public function register(RegisterRequest $request) {
        $card = new Card();
        $emailExists = Card::checkEmailExists($request->email);
        $cardIdExists = Card::checkCardExists($request->id, $request->confirm_code);

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
            'active_date' => time()
        ];

        try {
            $card->where('id', $request->id)->update($data);
            return $this->sendSuccess();
        } catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }
}
