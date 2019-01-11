<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $guarded = [];
    
    public function ticketType() {
        return $this->belongsTo(TicketType::class);
    }
}
