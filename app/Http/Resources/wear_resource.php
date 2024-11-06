<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
class wear_resource extends JsonResource
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
            'image'=>$this->image,
            'Sports_id'=>$this->sport->name,
            'seasons_id'=>$this->season->name,
            'created_at'=>Carbon::parse($this->created_at)->format('d/m/y h:i'),
            'updated_at'=>Carbon::parse($this->updated_at)->format('d/m/y h:i')

        ];
    }
}
