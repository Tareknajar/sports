<?php

namespace App\Http\Controllers\api;
use App\Models\club;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Traits\GeneralTrait;
use App\Http\Traits\Upload_Image;
use App\Http\Resources\club_resource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Exists;

class club_controller extends Controller
{
    use GeneralTrait;
    use Upload_Image;
    public function store(Request $request){
        if($request->isMethod('post')){
        $validator=Validator::make($request->all(),[
            'name'=>'required|string|unique:clubs,name',
            'addres'=>'required|string',
            'logo'=>'required|file|mimes:png,jpg',
            'Sports_id'=>'required|exists:sports,id',
        ]);
        if($validator->fails()){
            return $this->requiredField($validator->errors());
        }
        $club=new club();
        $club->uuid=Str::uuid();
        $club->name=$request->name;
        $club->address=$request->addres;
        $club->logo=$this->uploadimage($request,'logo','club');;
        $club->Sports_id=$request->Sports_id;
        $club->save();
        return $this->apiResponse('Done Successfull');}
        else{
            return $this->requiredField('error in sending');
        }

    }
    public function update(Request $request,$uuid){
        if($request->isMethod('post')){
        $validator=Validator::make($request->all(),[
            'name'=>'required|string|unique:clubs,name',
            'addres'=>'required|string',
            'logo'=>'required|file|mimes:png,jpg',
            'Sports_id'=>'required|exists:sports,id',
        ]);
        if($validator->fails()){
            return $this->requiredField($validator->errors());
        }
        $club=club::where('uuid',$uuid)->first();
        $club->name=$request->name;
        $club->address=$request->addres;
        $this->deleteimage($club->logo,'club/');
        $club->logo=$this->uploadimage($request,'logo','club');;
        $club->Sports_id=$request->Sports_id;
        $club->save();
        return $this->apiResponse('Done Successfull');}
        else{
            return $this->requiredField('error in sending');
        }

    }
    public function destore($uuid){

        $club=club::where('uuid',$uuid)->first();
        if(!$club){
            return $this->requiredField('item does not exist');
        }
        $this->deleteimage($club->logo,'club/');
        $club->delete();
        return $this->apiResponse('deleted');
    }
    public function index(){
        $clubs=club::all();
        $club=club_resource::collection($clubs);
        return $this->apiResponse($club);
    }
}
