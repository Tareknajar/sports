<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\GeneralTrait;
use App\Http\Traits\Upload_Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\posse;
use App\Http\Resources\posse_resource;
class posse_controller extends Controller
{
    use Upload_Image;
    use GeneralTrait;
    public function store(Request $request){
        if($request->isMethod('post')){
        $validator=Validator::make($request->all(),[
            'name'=>'Required|string',
            'statr_tear'=>'Required',
            'image'=>'Required|file|mimes:png,jfif,jpg'
        ]);
        if($validator->fails()){
            return $this->requiredField($validator->errors());
        }
        $posse=new posse();
        $posse->uuid=Str::uuid();
        $posse->name=$request->name;
        $posse->statr_tear=$request->statr_tear;
        $posse->image=$this->uploadimage($request,'image','posse');
        $posse->save();
        return $this->apiResponse('Done Successfull');}
        else{
            return $this->requiredField('error in sending');
        }
    }
    public function update(Request $request,$uuid){
        if($request->isMethod('post')){
        $validator=Validator::make($request->all(),[
            'name'=>'Required|string',
            'statr_tear'=>'Required',
            'image'=>'Required|file|mimes:png,jfif,jpg'
        ]);
        if($validator->fails()){
            return $this->requiredField($validator->errors());
        }
        $posse=posse::where('uuid',$uuid)->first();
        $posse->name=$request->name;
        $posse->statr_tear=$request->statr_tear;
        $this->deleteimage($posse->image,'posse/');
        $posse->image=$this->uploadimage($request,'image','posse');
        $posse->save();
        return $this->apiResponse('Done Successfull');}
        else{
            return $this->requiredField('error in sending');
        }

    }
    public function destore($uuid){
        $posse=posse::where('uuid',$uuid)->first();
        if(!$posse){
            return $this->requiredField('item does not exist');
        }
        $this->deleteimage($posse->image,'posse/');
        $posse->delete();
        return $this->apiResponse('deleted');
    }
    public function index(){
        $posses=posse::all();
        $posse=posse_resource::collection($posses);
        return $this->apiResponse($posse);

    }
}
