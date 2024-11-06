<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
class prime_resource extends JsonResource
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
        'name'=>$this->name,
        'descreption'=>$this->descreption,
        'image'=>$this->image,
        'type'=>$this->type,
        'Sports_id'	=>$this->sport->name,
        'seasons_id'=>$this->seasons->name,
        'created_at'=>Carbon::parse($this->created_at)->format('d/m/y h:i'),
        'updated_at'=>Carbon::parse($this->updated_at)->format('d/m/y h:i'),
        ];
    }
}
