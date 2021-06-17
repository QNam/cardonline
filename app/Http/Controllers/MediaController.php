<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
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

    public function uploadImageBase64(Request $request) {
        $image_64 = $request->image;
        
        $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];  
        $replace = substr($image_64, 0, strpos($image_64, ',')+1); 
        // find substring fro replace here eg: data:image/png;base64,
        
        $image = str_replace($replace, '', $image_64); 
        $image = str_replace(' ', '+', $image); 
        $imageName = rand() . "-" . time() . '.' . $extension;
        
        Storage::disk('imageUser')->put($imageName, base64_decode($image));

        $rep = [
            'img' => $imageName
        ];

        return $this->sendSuccess($rep);
    }
}
