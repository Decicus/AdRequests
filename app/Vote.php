<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'votes';

    /**
     * The attributes that are mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'result'
    ];

    /**
     * Get the request associated with this vote
     *
     * @return App\Request.
     */
    public function request()
    {
        return $this->hasOne('App\Request', 'id', 'request_id');
    }

    /**
     * Get the user that has voted.
     *
     * @return App\User
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
