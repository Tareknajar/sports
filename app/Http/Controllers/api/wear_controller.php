<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\wear;
use App\Http\Traits\GeneralTrait;
use App\Http\Traits\Upload_Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Resources\wear_resource;
use Illuminate\Validation\Rules\Exists;

class wear_controller extends Controller
{
    use GeneralTrait;
    use Upload_Image;
    public function store(Request $request){
        if($request->isMethod('post')){
        $validator=Validator::make($request->all(),[
            'image'=>'Required|file|mimes:png,jfif,jpg',
            'Sports_id'=>'Required|exists:sports,id',
            'seasons_id'=>'Required|exists:seasones,id'
        ]);
        if($validator->fails()){
            return $this->requiredField($validator->errors());
        }
        $wear=new wear();
        $wear->uuid=Str::uuid();
        $wear->image=$this->uploadimage($request,'image','wear');
        $wear->Sports_id=$request->Sports_id;
        $wear->seasons_id=$request->seasons_id;
        $wear->save();
        return $this->apiResponse('Done Successfully');}
        else{
            return $this->requiredField('error in sending');
        }

    }
    public function update(Request $request,$uuid){
        if($request->isMethod('post')){
        $validator=Validator::make($request->all(),[
            'image'=>'Required|file|mimes:png,jfif,jpg',
            'Sports_id'=>'Required|exists:sports,id',
            'seasons_id'=>'Required|exists:seasones,id'
        ]);
        if($validator->fails()){
            return $this->requiredField($validator->errors());
        }
        $wear=wear::where('uuid',$uuid)->first();
        $this->deleteimage($wear->image,'wear/');
        $wear->image=$this->uploadimage($request,'image','wear');
        $wear->Sports_id=$request->Sports_id;
        $wear->seasons_id=$request->seasons_id;
        $wear->save();
        return $this->apiResponse('Done Successfully');}
        else{
            return $this->requiredField('error in sending');
        }
    }
    public function destore($uuid){
        $wear=wear::where('uuid',$uuid)->first();
        if(!$wear){
            return $this->requiredField('item does not exist');
        }
        $this->deleteimage($wear->image,'wear/');
        $wear->delete();
        return $this->apiResponse('deleted');
    }
    public function index(){
        $wears=wear::all();
        $wear=wear_resource::collection($wears);
        return $this->apiResponse($wear);
    }
}
