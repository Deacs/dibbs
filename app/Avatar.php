<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'type', 'path',
    ];
    
    // Relationships

    /**
     * Return the user that owns this avatar
     */
    public function user() {
        return $this->belongsTo('App\User');
    }

    /**
     * Return the correct avatar path for this user
     * 
     * They may have selected to upload a custom image,
     * link to their valid Gravatar image or,
     * we will return a generated Gravatar image for them
     */
    public function getPath($size = 200) {

        return ($this->type == 'custom' && !is_null($this->path)) ? $this->path : \Gravatar::src($this->user->email, $size);
    }

    /**
     * If a Gravatar is being used, is it system generated, 
     * or has this user uploaded one to the service?
     */
    public function isGeneratedGravatar() {

        // Returns true even for nonsense emails - ?
        return \Gravatar::exists($this->user->email);
    }
}
