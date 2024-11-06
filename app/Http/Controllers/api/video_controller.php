<?php

namespace App\Http\Controllers\api;
use App\Http\Traits\GeneralTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\video;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;
use App\Http\Resources\video_resource;
class video_controller extends Controller
{
    use GeneralTrait;
    public function store(Request $request){
        if($request->isMethod('post')){
        $validator=Validator::make($request->all(),[
            'url'=>'Required|url',
            'description'=>'Required|string',
            'type'=>'Required|in:Fans Shots,Beautiful goals'
        ]);
        if($validator->fails()){
            return $this->requiredField($validator->errors());
        }
        $video=new video();
        $video->uuid=Str::uuid();
        $video->url=$request->url;
        $video->description=$request->description;
        $video->type=$request->type;
        $video->save();
        return $this->apiResponse('Done Successfully');}
        else{
            return $this->requiredField('error in sending');
        }
    }
    public function update(Request $request,$uuid){
        if($request->isMethod('post')){
        $validator=Validator::make($request->all(),[
            'url'=>'Required|url',
            'description'=>'Required|string',
            'type'=>'Required|in:Fans Shots,Beautiful goals'
        ]);
        if($validator->fails()){
            return $this->requiredField($validator->errors());
        }
        $video=video::where('uuid',$uuid)->first();
        $video->url=$request->url;
        $video->description=$request->description;
        $video->type=$request->type;
        $video->save();
        return $this->apiResponse('Done Successfully');}
        else{
            return $this->requiredField('error in sending');
        }
    }
    public function destore($uuid){
        $video=video::where('uuid',$uuid)->first();
        if(!$video){
            return $this->requiredField('item does not exist');
        }
        $video->delete();
        return $this->apiResponse('deleted');
    }
    public function show(Request $request){
        $videos=video::where('type',$request->type)->get();
        $video=video_resource::collection($videos);
        return $this->apiResponse($video);
    }
}
