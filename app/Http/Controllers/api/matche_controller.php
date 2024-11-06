<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\GeneralTrait;
use App\Http\Traits\Upload_Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\matche;
use App\Http\Resources\matche_resource;
use Illuminate\Validation\Rules\Unique;

class matche_controller extends Controller
{
    use GeneralTrait;
    use Upload_Image;
    public function store(Request $request){
        if($request->isMethod('post')){
        $matche=new matche();
        $validator=Validator::make($request->all(),[
            'when'=>'Required|date',
            'status'=>'Required|in:not_started,finished',
            'plan'=>'Required|file|mimes:png,jfif,jpg',
            'channel'=>'Required|string',
            'round'=>'Required|unique:matches,round|integer',
            'play_ground'=>'Required|string',
            'seasons_id'=>'Required|exists:seasones,id',
            'club1_id'=>'Required|exists:clubs,id',
            'club2_id'=>'Required|exists:clubs,id',

        ]);
        if($validator->fails()){
            return $this->requiredField($validator->errors());
        }
        $matche->uuid=Str::uuid();
        $matche->when=$request->when;
        $matche->status=$request->status;
        $matche->plan=$this->uploadimage($request,'plan','matche');
        $matche->channel=$request->channel;
        $matche->round=$request->round;
        $matche->play_ground=$request->play_ground;
        $matche->seasons_id=$request->seasons_id;
        $matche->club1_id=$request->club1_id;
        $matche->club2_id=$request->club2_id;
        $matche->save();
        return $this->apiResponse('Done successfull');}
        else{
            return $this->requiredField('error in sending');
        }

    }
    public function update(Request $request,$uuid){
        if($request->isMethod('post')){
        $validator=Validator::make($request->all(),[
            'when'=>'Required|date',
            'status'=>'Required|in:not_started,finished',
            'plan'=>'Required|file|mimes:png,jfif,jpg',
            'channel'=>'Required|string',
            'round'=>'Required|integer',
            'play_ground'=>'Required|string',
            'seasons_id'=>'Required|exists:seasones,id',
            'club1_id'=>'Required|exists:clubs,id',
            'club2_id'=>'Required|exists:clubs,id',

        ]);
        if($validator->fails()){
            return $this->requiredField($validator->errors());
        }
        $matche=matche::where('uuid',$uuid)->first();
        $matche->when=$request->when;
        $matche->status=$request->status;
        $this ->deleteimage($matche->plan,'matche/');
        $matche->plan=$this->uploadimage($request,'plan','matche');
        $matche->channel=$request->channel;
        $matche->round=$request->round;
        $matche->play_ground=$request->play_ground;
        $matche->seasons_id=$request->seasons_id;
        $matche->club1_id=$request->club1_id;
        $matche->club2_id=$request->club2_id;
        $matche->save();
        return $this->apiResponse('Done successfull');}
        else{
            return $this->requiredField('error in sending');
        }
    }
    public function destore($uuid){
        $matche=matche::where('uuid',$uuid)->first();
        if(!$matche){
            return $this->requiredField('item does not exist');
        }
        $this ->deleteimage($matche->plan,'matche/');
        $matche->delete();
        return $this->apiResponse('deleted');
    }
    public function index(){
        $matche=matche::all();
        $matche=matche_resource::collection($matche);
        return $this->apiResponse($matche);
    }
    public function show(Request $request){
        $matche=matche::where('when',$request->when)->get();
        $matche=matche_resource::collection($matche);
        return $this->apiResponse($matche);
    }







    
}
