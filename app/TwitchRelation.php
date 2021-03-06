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
     * Retrieve the user connected to the relation.
     *
     * @return App\User
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
