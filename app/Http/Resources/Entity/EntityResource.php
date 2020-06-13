<?php

namespace App\Http\Resources\Entity;

use Illuminate\Http\Resources\Json\JsonResource;

class EntityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'body' => $this->body,
            'type' => $this->type,
            'start' => $this->start,
            'end' => $this->end
        ];
    }
}
