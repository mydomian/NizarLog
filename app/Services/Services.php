<?php
namespace App\Services;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use File;


class Services{
 

    function imageUpload($file, $folder){
        try {
       
            $ext = "." . strtolower($file->getClientOriginalExtension());
            $imageName = rand(1000, 9999) . time() . $ext;
            Storage::disk('public')->put($folder . $imageName, File::get($file));
            return $imageName;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    function imageDestroy($modelData,$folder){

        try{
            $old_file = $folder.$modelData;
           
            if (Storage::disk('public')->exists($old_file)) {
                Storage::disk('public')->delete($old_file);
            }
            return true;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
 

}