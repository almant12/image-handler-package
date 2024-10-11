<?php 

namespace Almant\ImageHandler;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class ImageHandler{

    public function uploadImage(Request $request,$filename,$path): string{

        if($request->hasFile($filename)){
            $image = $request->{$filename};
            $ext = $image->getClientOriginalExtension();
            $imageName = 'image_'.uniqid().'.'.$ext;
            $pathImage = $image->storeAs($path,$imageName,'public');

            return 'storage/'.$pathImage;
        }
    }

    public function updateImage(Request $request,$filename,$oldPath,$path): string{

        if($request->hasFile($filename)){
            if(File::exists($oldPath)){
                File::delete($oldPath);
            }

            $image = $request->{$filename};
            $ext = $image->getClientOriginalExtension();
            $imageName = 'image_'.uniqid().'.'.$ext;
            $pathImage = $image->storeAs($path,$imageName,'public');

            return 'storage/'.$pathImage;
        }
    }

    public function deleteImage($path):void{
        if(File::exists(public_path($path))){
            File::delete(public_path($path));
        }
    }
}