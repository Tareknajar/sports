<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
use App\Http\Resources\matche_resource;
class replacment_resource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'uuid'=>$this->uuid,
            'inplayer_id'=>$this->inplayer->name,
            'outplayer_id'=>$this->outplayer->name,
            'matches_id'=>$this->match->when,
            'created_at'=>Carbon::parse($this->created_at)->format('d/m/y h:i'),
            'updated_at'=>Carbon::parse($this->updated_at)->format('d/m/y h:i'),
            'match'=>matche_resource::collection($this->whenLoaded('match')),

        ];
    }
}
