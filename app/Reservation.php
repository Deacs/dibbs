<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_id', 'reserved_date',
    ];
    
    // Relationships

    public function item()
    {
        return $this->hasOne('App\Item');
    }

    /**
     * Return the user who has made this reservation
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
