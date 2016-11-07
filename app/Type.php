<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'types';

    /**
     * The attributes that are mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get the requests associated with this type.
     */
    public function requests() {
        return $this->hasMany('App\Request', 'id', 'type_id');
    }
    
    /**
     * Retrieves a type based on the name.
     * 
     * @param  string $name The type name
     * @return App\Type
     */
    public static function findByName($name = '')
    {
        return $this::where('name', $name);
    }
}
