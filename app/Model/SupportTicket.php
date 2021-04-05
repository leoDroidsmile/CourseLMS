<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupportTicket extends Model
{


    public function replays(){
        return $this->hasMany(SupportTicketReplay::class,'ticket_id','id');
    }


}
