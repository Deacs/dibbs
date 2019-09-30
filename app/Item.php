<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'user_id', 'item_type_id',
    ];

    // Relationships

    /**
     * Return the owner of the item
     */
    public function user() {
        return $this->belongsTo('App\User');
    }

    /**
     * Return the associated item type
     */
    public function itemType() {
        return $this->hasOne('App\ItemType');
    }

    /**
     * Return the associated item group, through the item type
     */
    public function itemGroup() {
        return $this->hasOneThrough('App\ItemGroup', 'App\ItemType');
    }

    /**
     * Return the associated seasons
     */
    public function seasons() {
        return $this->hasMany('App\Season');
    }

    /**
     * Return the images associated with this item
     */
    public function images() {
        return $this->hasMany('App\ItemImage');
    }

    /**
     * Return the wardrobe housing this item
     */
    public function wardrobe() {
        return $this->belongsTo('App\Wardobe');
    }

    /**
     * Return any reservations for this item
     */
    public function reservations () {
        return $this->hasMany('App\Reservation');
    }
}
