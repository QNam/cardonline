<?php 

namespace App\Http\Ultis;

use Illuminate\Support\Facades\Storage;

class MediaService {
    public function uploadImage($requestImage) {
        $imageName = rand() . "av-" . time().'.'.$requestImage->extension();  
        $requestImage->move(public_path('images'), $imageName);

        return $imageName;
    }

    public function uploadImageBase64($requestImage) {
        $image_64 = $requestImage;
        
        $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];  
        $replace = substr($image_64, 0, strpos($image_64, ',')+1); 
        // find substring fro replace here eg: data:image/png;base64,
        
        $image = str_replace($replace, '', $image_64); 
        $image = str_replace(' ', '+', $image); 
        $imageName = rand() . "-" . time() . '.' . $extension;
        
        Storage::disk('imageUser')->put($imageName, base64_decode($image));

        return $imageName;
    }
}