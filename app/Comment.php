<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'comments';

    /**
     * The attributes that are mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'comment', 'public'
    ];

    /**
     * Specifies if the primary key is incrementing.
     *
     * @var boolean
     */
    public $incrementing = false;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get the request associated with this comment.
     */
    public function request()
    {
        return $this->belongsTo('App\Request', 'request_id', 'id');
    }

    /**
     * Get the user that created this comment.
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
