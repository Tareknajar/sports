<?php

namespace App\Http\Controllers\api;
use App\Models\sport;
use App\Http\Traits\GeneralTrait;
use App\Http\Traits\Upload_Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\sport_resource;

class sport_controller extends Controller
{
    use GeneralTrait;
    use Upload_Image;
    public function store(Request $request){
        if($request->isMethod('post')){
        $validator=Validator::make($request->all(),[
            'name'=>'Required|string|unique:sports,name',
            'image'=>'Required|file|mimes:png,jfif,jpg'
        ]);
        if($validator->fails()){
            return $this->requiredField($validator->errors());
        }
        $sport=new sport();
        $sport->uuid=Str::uuid();
        $sport->name=$request->name;
        $sport->image=$this->uploadimage($request,'image','sport');
        $sport->save();
        return $this->apiResponse('Done Successfully');}
        else{
            return $this->requiredField('error in sending');
        }

    }
    public function update(Request $request,$uuid){
        if($request->isMethod('post')){
        $validator=Validator::make($request->all(),[
            'name'=>'Required|string|unique:sports,name',
            'image'=>'Required|file|mimes:png,jfif,jpg'
        ]);
        if($validator->fails()){
            return $this->requiredField($validator->errors());
        }
        $sport=sport::where('uuid',$uuid)->first();
        if(!$sport){
            return $this->requiredField('item does not exist');
        }
        $sportdelete= $this->deleteimage($sport->image,'sport/');
        $sport->name=$request->name;
        $sport->image=$this->uploadimage($request,'image','sport');
        $sport->save();
        return $this->apiResponse('Done Successfully'); }
        else{
            return $this->requiredField('error in sending');
        } 
    }
    public function destore($uuid){
        $sport=sport::where('uuid',$uuid)->first();
        if(!$sport){
            return $this->requiredField('item does not exist');
        }
        $sportdelete= $this->deleteimage($sport->image,'sport/');
        $sport->delete();
        return $this->apiResponse('deleted');
    }
    public function index(){
        $sports=sport::all();
        $sport=sport_resource::collection($sports);
        return $this->apiResponse($sport);
    }
}