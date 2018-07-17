<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Reply extends Model
{

    public function owner()
    {
        // we path the parameter to that
        // make laravel use user_id not owner_id

        return $this->belongsTo(User::class,'user_id');
    }
}
