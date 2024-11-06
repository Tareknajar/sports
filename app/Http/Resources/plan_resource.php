<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class plan_resource extends JsonResource
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
            'Players_id'=>$this->player->name,
            'matches_id'=>$this->matche->when,
            'status'=>$this->status,
            'created_at'=>Carbon::parse($this->created_at)->format('d/m/y h:i'),
            'updated_at'=>Carbon::parse($this->updated_at)->format('d/m/y h:i'),

        ];
    }
}
