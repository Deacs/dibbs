<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemImage extends Model
{
    protected $table = 'item_images';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_id', 'user_id', 'img_path',
    ];

    // Relationships

    /**
     * Return associated item
     */
    public function item()
    {
        return $this->hasOne('App\Item');
    }

    /**
     * Return the owning user
     */
    public function user()
    {
        return $this->hasOne('App\User');
    }
}
