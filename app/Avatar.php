<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    // Relationships

    /**
     * Return the user that owns this avatar
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
