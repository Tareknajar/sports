<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\standing_resource;
use Illuminate\Http\Request;
use App\Models\standing;
use App\Http\Traits\GeneralTrait;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\statistic_resource;
use App\Models\seasone;

class standing_controller extends Controller
{
    use GeneralTrait;
    public function winanddraw($request){
        $win=$request->win*3;
        $draw=$request->draw*1;
        $point=$win+$draw;
        return $point;  
    }
    public function for_himorattic($request){
        $difference=$request->for_him-$request->attic;
        return $difference;
    }
    public function store(Request $request){
        if($request->isMethod('post')){
        $standingclub=standing::where('Clubs_id',$request->Clubs_id)->where('seasons_id',$request->seasons_id)->exists();
        if($standingclub){
            return $this->requiredField('The team is there');
        }
        $validato=Validator::make($request->all(),[
            'win'=>'required|numeric|min:0|max:50',
            'lose'=>'required|numeric|min:0|max:50',
            'draw'=>'required|numeric|min:0|max:50',
            'for_him'=>'required|numeric|min:0|max:100',
            'attic'=>'required|numeric|min:0|max:100',
            'play'=>'required|numeric|min:0|max:50',
            'Clubs_id'=>'required|',
            'seasons_id'=>'required|exists:seasones,id',
         ]);
         if($validato->fails())
         {
          return $this->requiredField($validato->errors());
         }


        $Standing=new standing();
        $Standing->uuid=Str::uuid();
        $Standing->win=$request->win;
        $Standing->lose=$request->lose;
        $Standing->draw=$request->draw;
        $Standing->for_him=$request->for_him;
        $Standing->attic=$request->attic;
        $difference=$this->for_himorattic($request);
        $Standing['+/-']=$difference;
        $point=$this->winanddraw($request);
        $Standing->point=$point;
        $Standing->play=$request->play;
        $Standing->Clubs_id=$request->Clubs_id;
        $Standing->seasons_id=$request->seasons_id;
        $Standing->save();
        return $this->apiResponse('Done Successfully');}
        else{
            return $this->requiredField('error in sending');
        }
    
    }

    public function update(Request $request,$uuid){
        if($request->isMethod('post')){
        $standingclub=standing::where('Clubs_id',$request->Clubs_id)->where('seasons_id',$request->seasons_id)->exists();
        if($standingclub){
            return $this->requiredField('The team is there');
        }
        $validato=Validator::make($request->all(),[
            'win'=>'required|numeric|min:0|max:50',
            'lose'=>'required|numeric|min:0|max:50',
            'draw'=>'required|numeric|min:0|max:50',
            'for_him'=>'required|numeric|min:0|max:100',
            'attic'=>'required|numeric|min:0|max:100',
            'play'=>'required|numeric|min:0|max:50',
            'Clubs_id'=>'required|',
            'seasons_id'=>'required|exists:seasones,id',
         ]);
         if($validato->fails())
         {
          return $this->requiredField($validato->errors());
         }

        
        $Standing=standing::where('uuid',$uuid)->first();
        $Standing->win=$request->win;
        $Standing->lose=$request->lose;
        $Standing->draw=$request->draw;
        $Standing->for_him=$request->for_him;
        $Standing->attic=$request->attic;
        $difference=$this->for_himorattic($request);
        $Standing['+/-']=$difference;
        $point=$this->winanddraw($Standing);
        $Standing->point=$point;
        $Standing->play=$request->play;
        $Standing->Clubs_id=$request->Clubs_id;
        $Standing->seasons_id=$request->seasons_id;
        $Standing->save();
        return $this->apiResponse('Done Successfully');}
        else{
            return $this->requiredField('error in sending');
        }
    
    }
    public function show(Request $request){
        $seazon=$request->name;
        $Standing=standing::select('standings.*')->join('seasones','standings.seasons_id','=','seasons_id')->where('seasones.name',$seazon)
        ->get();
        $showstanding=standing_resource::collection($Standing);
        return $this->apiResponse($showstanding);
    }
    public function destore($uuid){
        $Standing=standing::where('uuid',$uuid)->first();
        if(!$Standing){
            return $this->requiredField('item does not exist');
        }
        $Standing->delete();
        return $this->apiResponse('deleted');
    }

}
