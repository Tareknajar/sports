<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\prime;
use App\Http\Traits\GeneralTrait;
use App\Http\Traits\Upload_Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Resources\prime_resource;
use Illuminate\Validation\Rules\Unique;

class prime_controller extends Controller
{
    use GeneralTrait;
    use Upload_Image;

    public function store(Request $request){
        if($request->isMethod('post')){
        $validator=Validator::make($request->all(),[
            'name'=>'required|string|Unique:primes,name',
            'descreption'=>'required|string',
            'type'=>'required|in:manager,club',
            'image'=>'required|file|mimes:png,jpg',
            'Sports_id'=>'required|exists:sports,id',
            'seasons_id'=>'required|exists:seasones,id',
        ]);
        if($validator->fails()){
            return $this->requiredField($validator->errors());
        }
        $prime=new prime();
        $prime->uuid=Str::uuid();
        $prime->name=$request->name;
        $prime->descreption=$request->descreption;
        $prime->type=$request->type;
        $prime->image=$this->uploadimage($request,'image','prime');
        $prime->Sports_id=$request->Sports_id;
        $prime->seasons_id=$request->seasons_id;
        $prime->save();
        return $this->apiResponse('Done Successfull');}
        else{
            return $this->requiredField('error in sending');
        }
    }
    public function update(Request $request , $uuid){
        if($request->isMethod('post')){
        $prime=prime::where('uuid',$uuid)->first();
        $validator=Validator::make($request->all(),[
            'name'=>'required|string|Unique:primes,name,'.$prime->id,
            'descreption'=>'required|string',
            'type'=>'required|in:manager,club',
            'image'=>'required|file|mimes:png,jpg',
            'Sports_id'=>'required|exists:sports,id',
            'seasons_id'=>'required|exists:seasones,id',
        ]);
        if($validator->fails()){
            return $this->requiredField($validator->errors());
        }
        $prime->name=$request->name;
        $prime->descreption=$request->descreption;
        $prime->type=$request->type;
        $this->deleteimage($prime->image,'prime/');
        $prime->image=$this->uploadimage($request,'image','prime');
        $prime->Sports_id=$request->Sports_id;
        $prime->seasons_id=$request->seasons_id;
        $prime->save();
        return $this->apiResponse('Done Successfull');}
        else{
            return $this->requiredField('error in sending');
        }
    }
    public function destore($uuid){
        $prime=prime::where('uuid',$uuid)->first();
        if(!$prime){
            return $this->requiredField('item does not exist');
        }
         $this->deleteimage($prime->image,'prime/');
        $prime->delete();
        return $this->apiResponse('deleted');
    }
    public function index(){
        $primes=prime::all();
        $prime=prime_resource::collection($primes);
        return $this->apiResponse($prime);
    }
    
}
