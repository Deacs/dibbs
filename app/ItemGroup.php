<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemGroup extends Model
{
    protected $table = 'item_groups';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'season_id',
    ];

    // Relationships

    /**
     * Return the related item type
     */
    public function itemType()
    {
        return $this->hasOne('App\ItemType');
    }

    /**
     * Return the associated items, through item_types
     */
    public function items()
    {
        return $this->hasManyThrough('App\Items', 'App\ItemType');
    }
}
