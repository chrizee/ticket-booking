<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Ticket extends JsonResource
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
          'id' => $this->id,
          'event' => $this->event,
          'price' => $this->price,
          'type' => $this->ticketType->name,
          'total_number_available' => $this->total_number_available,
          'number_sold' => $this->number_sold ? $this->number_sold: 0,
          'number_unsold' => $this->number_unsold ? $this->number_unsold : 0,
          'created_at' => $this->created_at->toFormattedDateString(),
          'updated_at' => $this->updated_at->toFormattedDateString(),
            
        ];
    }
}
