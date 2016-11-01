<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TwitchRelation extends Model
{
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
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'twitch_relations';

    /**
     * The attributes that are mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'nickname', 'user_id'
    ];
    
    /**
     * Retrieve the user connected to the relation.
     * 
     * @return App\User
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'id', 'user_id');
    }
}
