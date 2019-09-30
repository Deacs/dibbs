<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workplace extends Model
{
    
    protected $table = 'workplaces';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    // Relationships
    
    /**
     * Return the users registered to this workplace
     * INCORRECT - runs through a res table workplace_users
     */
    public function users() {
        return $this->hasMany('App\User');
    }
}
