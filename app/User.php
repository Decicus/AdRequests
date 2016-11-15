<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The column to define as a primary key.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Specifies if the primary key is incrementing.
     *
     * @var boolean
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'nickname'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token'
    ];

    /**
     * Scope a query to search.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param  String $search
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearchName($query, $search)
    {
        return $query->where('name', 'LIKE', '%' . strtolower($search) . '%');
    }

    /**
     * Retrieve the Twitch relation connected for this user.
     *
     * @return App\TwitchRelation
     */
    public function twitch()
    {
        return $this->hasOne('App\TwitchRelation', 'user_id', 'id');
    }

    /**
     * Gets the associated requests for this user.
     *
     * @return App\Request
     */
    public function requests()
    {
        return $this->hasMany('App\Request', 'user_id', 'id');
    }
}
