<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationUser extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'data' => 'array'
    ];
}
