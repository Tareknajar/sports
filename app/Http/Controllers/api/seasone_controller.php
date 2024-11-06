<?php

namespace App\Http\Controllers\api;
use App\Http\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\seasone;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Unique;
use App\Http\Resources\seasone_resource;
class seasone_controller extends Controller
{
    use GeneralTrait;
    public function store(Request $request){
        if($request->isMethod('post')){
        $validator=Validator::make($request->all(),[
            'name'=>'required|string|unique:seasones,name',
            'start_date'=>'required|date|before_or_equal:end_date',
            'end_date'=>'required|date|after_or_equal:start_date',
        ]);
        if($validator->fails()){
            return $this->requiredField($validator->errors());
        }
        $seasone=new seasone();
        $seasone->uuid=Str::uuid();
        $seasone->name=$request->name;
        $seasone->start_date=$request->start_date;
        $seasone->end_date=$request->end_date;
        $seasone->save();
        return $this->apiResponse('Done Successfully');}
        else{
            return $this->requiredField('error in sending');
        }
    }
    public function update(Request $request,$uuid){
        if($request->isMethod('post')){
        $validator=Validator::make($request->all(),[
            'name'=>'required|string|unique:seasones,name',
            'start_date'=>'required|date|before_or_equal:end_date',
            'end_date'=>'required|date|after_or_equal:start_date',
        ]);
        if($validator->fails()){
            return $this->requiredField($validator->errors());
        }
        $seasone=seasone::where('uuid',$uuid)->first();
        $seasone->name=$request->name;
        $seasone->start_date=$request->start_date;
        $seasone->end_date=$request->end_date;
        $seasone->save();
        return $this->apiResponse('Done Successfully');}
        else{
            return $this->requiredField('error in sending');
        }
    }
    public function destore($uuid){
        $seasone=seasone::where('uuid',$uuid)->first();
        if(!$seasone){
            return $this->requiredField('item does not exist');
        }
        $seasone->delete();
        return $this->apiResponse('deleted');
    }
    public function index(){
        $seasones=seasone::all();
        $seasone=seasone_resource::collection($seasones);
        return $this->apiResponse($seasone);
    }
    public function show(Request $request){
        $seasones=seasone::where('name',$request->name)->get();
        $seasone=seasone_resource::collection($seasones);
        return $this->apiResponse($seasone);
    }
}
