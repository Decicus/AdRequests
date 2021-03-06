<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Uuid;

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
        'id', 'type_id', 'name', 'body'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

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
     * Adds a new request with a randomly generated UUID.
     *
     * @param integer $type The type ID of the request.
     * @param string $name The name of the request.
     * @param array $body The request body.
     * @return App\Request
     */
    public static function add($type = 0, $name = null, $body = [])
    {
        $id = Uuid::generate(4);

        if (is_array($body)) {
            $body = json_encode($body);
        }

        return new Request([
            'id' => $id,
            'type_id' => $type,
            'name' => $name,
            'body' => $body
        ]);
    }

    /**
     * Get the associated comments for this request.
     */
    public function comments()
    {
        return $this->hasMany('App\Comment', 'request_id', 'id');
    }

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
