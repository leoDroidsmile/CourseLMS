<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ApiPasswordReset extends Model
{
    //
    protected $fillable = [
        'email', 'token'
    ];
}
