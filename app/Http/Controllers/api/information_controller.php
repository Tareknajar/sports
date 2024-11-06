<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\information;
use App\Http\Traits\GeneralTrait;
use App\Http\Traits\Upload_Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\information_resource;
use Illuminate\Validation\Rules\Unique;

class information_controller extends Controller
{
    use Upload_Image;
    use GeneralTrait;
    
    public function store(Request $request){
        if($request->isMethod('post')){
        $validator=Validator::make($request->all(),[
            'title'=>'required|string',
            'content'=>'required|string',
            'image'=>'required|file|mimes:png,jpg',
            'type'=>'required|in:news,stategy',
            'statistic_id'=>'unique:information,statistic_id|exists:statistics,id',
        ]);
        if($validator->fails()){
            return $this->requiredField($validator->errors());
        }
        $information=new information();
        $information->uuid=Str::uuid();
        $information->title=$request->title;
        $information->content=$request->content;
        $information->image=$this->uploadimage($request,'image','information');
        $information->type=$request->type;
        $information->statistic_id=$request->statistic_id;
        $information->save();
        return $this->apiResponse('Done Successfull');}
        else{
            return $this->requiredField('error in sending');
        }
    }

    public function update(Request $request,$uuid){
        if($request->isMethod('post')){

        $validator=Validator::make($request->all(),[
        'title'=>'required|string',
        'content'=>'required|string',
        'image'=>'required|file|mimes:png,jpg',
        'reads'=>'required|',
        'type'=>'required|in:news,stategy',
        'statistic_id'=>'unique:information,statistic_id|exists:statistics,id',
        ]);
        if($validator->fails()){
            return $this->requiredField($validator->errors());
        }
        $information=information::where('uuid',$uuid)->first();
        $information->title=$request->title;
        $information->content=$request->content;
        $this->deleteimage($information->image,'information/');
        $information->image=$this->uploadimage($request,'image','information');
        $information->reads=$request->reads;
        $information->type=$request->type;
        $information->statistic_id=$request->statistic_id;
        $information->save();
        return $this->apiResponse('Done Successfull');}
        else{
            return $this->requiredField('error in sending');
        }
    }

    public function index(){
        $informations=information::all();
        $information=information_resource::collection($informations);
        foreach($informations as $information_reads){
            $information_reads->reads+=1;
            $information_reads->save();
        }
        return $this->apiResponse($information);
    }

    public function destore($uuid){
        $information=information::where('uuid',$uuid)->first();
        if(!$information){
            return $this->requiredField('item does not exist');
        }
        $this->deleteimage($information->image,'information/');
        $information->delete();
        return $this->apiResponse('deleted');
    }


}
