<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function login(Request $request) {
        $userName = $request->userName;
        $password = $request->password;
        
        if($userName == 'admin' && $password = 'fuki123123') {
            session(['adminInfo' => [
                'userName' => 'admin'
            ]]);

            return redirect()->route('AdminSPA');
        } else {
            return redirect()->back();
        }
    }

    public function logout(Request $request) {
        session()->forget('adminInfo');
        return redirect()->route('AdminSPA');
    }
}
