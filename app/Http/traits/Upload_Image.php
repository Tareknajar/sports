<?php
namespace App\Http\traits;


trait Upload_Image
{
    public function uploadimage($request,$namerequst,$namefolder){

      try{
   
       $fileextension=request()->file($namerequst)->getclientoriginalExtension();
        $filename=time().'.'.$fileextension;
        $path=$namefolder;
        $request->$namerequst->move($path,$filename);
        return $filename;
    
        }
        catch (\Throwable $erroer) {
            report($erroer);

            return $erroer->getMessage();
        }

    }
    public function deleteimage($pathimage,$namefolder){

        try{
        $images=public_path($namefolder.$pathimage);
        unlink($images);
        return true;
              }

        catch (\Throwable $erroer) {
            report($erroer);

            return $erroer->getMessage();
        }
        
    }

}







?>