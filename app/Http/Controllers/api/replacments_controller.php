<?php

namespace App\Http\Controllers\api;
use App\Http\Traits\GeneralTrait;
use App\Http\Traits\Upload_Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\replacment;
use Illuminate\Validation\Rules\Exists;
use App\Http\Resources\replacment_resource;

class replacments_controller extends Controller
{
    use Upload_Image;
    use GeneralTrait;
    public function store(Request $request){
        if($request->isMethod('post')){
        $validator=Validator::make($request->all(),[
            'inplayer_id'=>'required|exists:players,id',
            'outplayer_id'=>'required|exists:players,id',
            'matches_id'=>'required|exists:matches,id',
            ]);
            if($validator->fails()){
                return $this->requiredField($validator->errors());
            }
            $inreplacment=replacment::where('matches_id',$request->matches_id)->where('outplayer_id',$request->inplayer_id)->exists();
            if($inreplacment){
                return $this->requiredField('The player has already been replaced');
            }
        $replacment=new replacment();
        $replacment->uuid=Str::uuid();
        $replacment->inplayer_id=$request->inplayer_id;
        $replacment->outplayer_id=$request->outplayer_id;
        $replacment->matches_id=$request->matches_id;
        $replacment->save();
        return $this->apiResponse('Done Successfull');}
        else{
            return $this->requiredField('error in sending');
        }
    }
    public function update(Request $request,$uuid){
        if($request->isMethod('post')){
        $validator=Validator::make($request->all(),[
            'inplayer_id'=>'required|exists:players,id',
            'outplayer_id'=>'required|exists:players,id',
            'matches_id'=>'required|exists:matches,id',
            ]);
            if($validator->fails()){
                return $this->requiredField($validator->errors());
            }
            $inreplacment=replacment::where('matches_id',$request->matches_id)->where('outplayer_id',$request->inplayer_id)->exists();
            if($inreplacment){
                return $this->requiredField('The player has already been replaced');
            }
        $replacment=replacment::where('uuid',$uuid)->first();
        $replacment->inplayer_id=$request->inplayer_id;
        $replacment->outplayer_id=$request->outplayer_id;
        $replacment->matches_id=$request->matches_id;
        $replacment->save();
        return $this->apiResponse('Done Successfull');}
        else{
            return $this->requiredField('error in sending');
        }

    }
    public function destore($uuid){
        $replacment=replacment::where('uuid',$uuid)->first();
        if(!$replacment){
            return $this->requiredField('item does not exist');
        }
        $replacment->delete();
        return $this->apiResponse('deleted');
    }
    public function show(Request $request){
        
        $replacments=replacment::with('match')->get();
        $replacment=replacment_resource::collection($replacments);
        return $this->apiResponse($replacment);
        
    }
}
