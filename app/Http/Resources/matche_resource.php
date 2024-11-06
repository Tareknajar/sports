<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
use App\Http\Resources\replacment_resource;
class matche_resource extends JsonResource
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
            'when'=>$this->when,
            'status'=>$this->status,
            'plan'=>$this->plan,
            'channel'=>$this->channel,
            'round'=>$this->round,
            'play_ground'=>$this->play_ground,
            'seasons_id'=>$this->seasone->name,
            'club1_id'=>$this->club1->name,
            'club2_id'=>$this->club2->name,
            'created_at'=>Carbon::parse($this->created_at)->format('d/m/y h:i'),
            'updated_at'=>Carbon::parse($this->updated_at)->format('d/m/y h:i'),




        ];
    }
}
