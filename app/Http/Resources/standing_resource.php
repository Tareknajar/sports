<?php

namespace App\Http\Resources;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class standing_resource extends JsonResource
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
            'Clubs_id'=>$this->club->name,
            'play'=>$this->play,
           	'win'=>$this->win,
            'lose'=>$this->lose,	
            'draw'=>$this->draw,
            'for_him'=>$this->for_him,
        	'attic'=>$this->attic,	
            '+/-'=>$this->{'+/-'},
            'point'=>$this->point,
        	'seasons_id'=>$this->seasons->name,
            'created_at'=>Carbon::parse($this->created_at)->format('d/m/y h:i'),
            'updated_at'=>Carbon::parse($this->updated_at)->format('d/m/y h:i')
        ];
    }
}
