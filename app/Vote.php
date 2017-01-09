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
     * Get the request associated with this vote.
     */
    public function request() {
        return $this->hasOne('App\Request', 'id', 'request_id');
    }
}
