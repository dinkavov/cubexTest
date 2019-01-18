<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
