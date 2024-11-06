<?php

namespace App\Http\Controllers\api;
use App\Models\statistic;
use App\Http\Traits\GeneralTrait;
use App\Http\Traits\Upload_Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Resources\statistic_resource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class statistic_controller extends Controller
{
    use GeneralTrait;
    use Upload_Image;
    public function store(Request $request){
        if($request->isMethod('post')){
        $validator=Validator::make($request->all(),[
            'name'=>'Required|string',
            'value'=>'Required|json',
            'matches_id'=>'Required|exists:matches,id',
        ]);
        if($validator->fails()){
            return $this->requiredField($validator->errors());
        }
        $statisticcheck=statistic::where('name',$request->name)->where('matches_id',$request->matches_id)->exists();
        if($statisticcheck)
        {
            return $this->requiredField('The value is there');
        }
        $statistic=new statistic();
        $statistic->uuid=Str::uuid();
        $statistic->name=$request->name;
        $statistic->value=$request->value;
        $statistic->matches_id=$request->matches_id;
        $statistic->save();
        return $this->apiResponse('Done Successfully');}
        else{
            return $this->requiredField('error in sending');
        }
    }

    public function update(Request $request,$uuid){
        if($request->isMethod('post')){
        $statistic=statistic::where('uuid',$uuid)->first();
        $validator=Validator::make($request->all(),[
            'name'=>'Required|string',
            'value'=>'Required|json',
            'matches_id'=>'Required|exists:matches,id',
        ]);
        if($validator->fails()){
            return $this->requiredField($validator->errors());
        }
        $statistic->value=$request->value;

        $statisticcheck=statistic::where('name',$request->name)
        ->where('matches_id',$request->matches_id)->where(function ($query) use ($uuid){
            if($uuid){
                $query->where('uuid','!=',$uuid);
            }
        })->exists();
        if($statisticcheck){
            return $this->requiredField('The value is there');
        }
        
        $statistic->name=$request->name;
        $statistic->value=$request->value;
        $statistic->matches_id=$request->matches_id;
        $statistic->save();
        return $this->apiResponse('Done Successfully');}
        else{
            return $this->requiredField('error in sending');
        }
    }

    public function destore($uuid){
        $statistic=statistic::where('uuid',$uuid)->first();
        if(!$statistic){
            return $this->requiredField('item does not exist');
        }
        $statistic->delete();
        return $this->apiResponse('deleted');
    }
    public function index(){
        $statistics=statistic::all();
        $statistic=statistic_resource::collection($statistics);
        return $this->apiResponse($statistic);
    }
}
