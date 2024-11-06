<?php

namespace App\Http\Controllers\api;
use App\Http\Traits\GeneralTrait;
use App\Http\Traits\Upload_Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\plan;
use App\Http\Resources\plan_resource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class plan_controller extends Controller
{
    use GeneralTrait;
    use Upload_Image;
    public function store(Request $request){

        $validator=Validator::make($request->all(),[
            'Players_id'=>'Required|exists:players,id|unique:plans,Players_id',
            'matches_id'=>'Required|exists:matches,id|unique:plans,matches_id',
            'status'=>'Required|in:main,beanch'
        ]);
        if($validator->fails()){
            return $this->requiredField($validator->errors());
        }
        $plan=new plan();
        $plan->uuid=Str::uuid();
        $plan->Players_id=$request->Players_id;
        $plan->matches_id=$request->matches_id;
        $plan->status=$request->status;
        $plan->save();
        return $this->apiResponse('Done Successfully');
    }
    public function update(Request $request,$uuid){
        $plan=plan::where('uuid',$uuid)->first();
        $validator=Validator::make($request->all(),[
            'Players_id'=>'Required|exists:players,id|unique:plans,Players_id,'.$plan->id,
            'matches_id'=>'Required|exists:matches,id|unique:plans,matches_id,'.$plan->id,
            'status'=>'Required|in:main,beanch',
        ]);
        if($validator->fails()){
            return $this->requiredField($validator->errors());
        }
        $plan->Players_id=$request->Players_id;
        $plan->matches_id=$request->matches_id;
        $plan->status=$request->status;
        $plan->save();
        return $this->apiResponse('Done Successfully');
    }
    public function destore($uuid){
        $plan=plan::where('uuid',$uuid)->first();
        if(!$plan){
            return $this->requiredField('item does not exist');
        }
        $plan->delete();
        return $this->apiResponse('deleted');
    }
    public function index(){
        $plans=plan::all();
        $plan=plan_resource::collection($plans);
        return $this->apiResponse($plan);
    }

    
}
