<?php

namespace App\Http\Controllers\api;
use App\Models\employee;
use App\Http\Traits\GeneralTrait;
use App\Http\Traits\Upload_Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Exists;
use App\Http\Resources\employee_resource;

class employee_controller extends Controller
{
    use Upload_Image;
    use GeneralTrait;
    public function store(Request $request){
        if($request->isMethod('post')){
        $validator=Validator::make($request->all(),[
            'name'=>'required|string',
            'job_type'=>'required|in:manager,coach',
            'work'=>'required|string',
            'image'=>'required|file|mimes:png,jpg',
            'Sports_id'=>'required|exists:sports,id',
        ]);
        if($validator->fails()){
            return $this->requiredField($validator->errors());
        }
        $employee=new employee();
        $employee->uuid=Str::uuid();
        $employee->name=$request->name;
        $employee->job_type=$request->job_type;
        $employee->work=$request->work;
        $employee->image=$this->uploadimage($request,'image','employee');
        $employee->Sports_id=$request->Sports_id;
        $employee->save();
        return $this->apiResponse('Done Successfull');}
        else{
            return $this->requiredField('error in sending');
        }
    }
    public function update(Request $request,$uuid){
        if($request->isMethod('post')){
        $validator=Validator::make($request->all(),[
            'name'=>'required|string',
            'job_type'=>'required|in:manager,coach',
            'work'=>'required|string',
            'image'=>'required|file|mimes:png,jpg',
            'Sports_id'=>'required|exists:sports,id',
        ]);
        if($validator->fails()){
            return $this->requiredField($validator->errors());
        }
        $employee=employee::where('uuid',$uuid)->first();
        $employee->name=$request->name;
        $employee->job_type=$request->job_type;
        $employee->work=$request->work;
        $this->deleteimage($employee->image,'employee/');
        $employee->image=$this->uploadimage($request,'image','employee');
        $employee->Sports_id=$request->Sports_id;
        $employee->save();
        return $this->apiResponse('Done Successfull');}
        else{
            return $this->requiredField('error in sending');
        }  
    }
    public function destore($uuid){
        $employee=employee::where('uuid',$uuid)->first();
        if(!$employee){
            return $this->requiredField('item does not exist');
        }
        $this->deleteimage($employee->image,'employee/');
        $employee->delete();
        return $this->apiResponse('deleted');
    }
    public function index(){
        $employees=employee::all();
        $employee=employee_resource::collection($employees);
        return $this->apiResponse($employee);

    }
}
