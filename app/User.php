<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'nickname', 'email', 'password', 'gender_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Reservations

    /**
     * Return the avatar associated with this user
     */
    public function avatar() {
        return $this->hasOne('App\Avatar');
    }

    /**
     * Return all reservations made by this user
     */
    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }

    /**
     * Return all the items owned by this user
     */
    public function items()
    {
        return $this->hasMany('App\Item');
    }

    /**
     * Return all the wardrobes owned by this user
     */
    public function wardrobes()
    {
        return $this->hasMany('App\Wardrobe');
    }

    /**
     * Return all the item images owned by this user
     */
    public function itemImages()
    {
        return $this->hasManyThrough('App\ItemImages', 'App\Item');
    }

}
