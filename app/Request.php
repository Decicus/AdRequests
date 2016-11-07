<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Request extends Model
{
    use SoftDeletes;
    
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
    protected $table = 'requests';

    /**
     * The attributes that are mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'type_id', 'body'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
    /**
     * Get the associated type for this request.
     */
    public function type()
    {
        return $this->belongsTo('App\Type', 'type_id', 'id');
    }
    
    /**
     * Get the associated user for this request.
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    /**
     * Get the votes associated with this request.
     */
    public function votes()
    {
        return $this->hasMany('App\Vote', 'request_id', 'id');
    }
}
