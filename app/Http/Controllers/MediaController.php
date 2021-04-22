<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MediaController extends Controller
{
    //
    public function uploadImage(Request $request) {
        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('images'), $imageName);

        $rep = [
            'img' => $imageName
        ];

        return $this->sendSuccess($rep);
    }
}
