<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wardrobe extends Model
{
    protected $table = 'wardrobes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'item_id', 'reservation_date',
    ];

    // Relationships

    /**
     * Return all the items in the wardrobe
     */
    public function items()
    {
        return $this->hasMany('App\Item');
    }
}
