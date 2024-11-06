<?php

namespace App\Http\Controllers\api;
use App\Http\Traits\GeneralTrait;
use App\Http\Traits\Upload_Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\player;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\player_resource;

class Player_Controller extends Controller
{
    use Upload_Image;
    use GeneralTrait;

    public function store(Request $request){
        if($request->isMethod('post')){
        $validator=Validator::make($request->all(),[
        'name'=>'required|string',
        'height'=>'required|integer',
        'play'=>'required|in:GK,CB,LB,RB,CM,DM,AM,LWB,RWB,CF,SS',
        'number'=>'required|integer|unique:players,number',
        'born'=>'required|date',
        'from'=>'required|string',
        'first_club'=>'required|string',
        'career'=>'required|string',
        'image'=>'required|file|mimes:png,jpg',
        'Sports_id'=>'required|exists:sports,id',
        ]);
        if($validator->fails()){
            return $this->requiredField($validator->errors());
        }
        $player=new player();
        $player->uuid=Str::uuid();
        $player->name=$request->name;
        $player->high=$request->height; //////////////////////////////////////////
        $player->play=$request->play;
        $player->number=$request->number;
        $player->born=$request->born;
        $player->from=$request->from;
        $player->first_club=$request->first_club;
        $player->career=$request->career;
        $player->image=$this->uploadimage($request,'image','player');
        $player->Sports_id=$request->Sports_id;
        $player->save();
        return $this->apiResponse('Done Successfull');}
        else{
            return $this->requiredField('error in sending');
        }
    }
    public function update(Request $request,$uuid){
        if($request->isMethod('post')){
        $player=player::where('uuid',$uuid)->first();
        $validator=Validator::make($request->all(),[
            'name'=>'required|string',
            'height'=>'required|integer',
            'play'=>'required|in:GK,CB,LB,RB,CM,DM,AM,LWB,RWB,CF,SS',
            'number'=>'required|integer|unique:players,number,'.$player->id,
            'born'=>'required|date',
            'from'=>'required|string',
            'first_club'=>'required|string',
            'career'=>'required|string',
            'image'=>'required|file|mimes:png,jpg',
            'Sports_id'=>'required|exists:sports,id',
            ]);
            if($validator->fails()){
                return $this->requiredField($validator->errors());
            }
        $player->name=$request->name;
        $player->high=$request->height; //////////////////////////////////////////
        $player->play=$request->play;
        $player->number=$request->number;
        $player->born=$request->born;
        $player->from=$request->from;
        $player->first_club=$request->first_club;
        $player->career=$request->career;
        $this->deleteimage($player->image,'player/');
        $player->image=$this->uploadimage($request,'image','player');
        $player->Sports_id=$request->Sports_id;
        $player->save();
        return $this->apiResponse('Done Successfull');}
        else{
            return $this->requiredField('error in sending');
        }
    }
    public function destore($uuid){
        $player=player::where('uuid',$uuid)->first();
        if(!$player){
            return $this->requiredField('item does not exist');
        }
        $this->deleteimage($player->image,'player/');
        $player->delete();
        return $this->apiResponse('deleted');
    }
    public function index(){
        $player=player::all();
        $players=player_resource::collection($player);
        return $this->apiResponse($players);
    }
    public function show(Request $request){
        $searchplayer=$request->name;
        $player=player::where('name','like',"%$searchplayer%")->get();
        dd($player);
     //   $players=player_resource::collection($player);
        return $this->apiResponse($player);
    }
}
