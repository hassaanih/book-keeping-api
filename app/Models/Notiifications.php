<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $from_user_id
 * @property int    $to_user_id
 * @property int    $created_at
 * @property int    $updated_at
 * @property string $title
 * @property boolean $is_read
 */
class Notiifications extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'notiifications';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'from_user_id', 'to_user_id', 'is_read', 'title', 'created_at', 'updated_at'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'from_user_id' => 'int', 'to_user_id' => 'int', 'title' => 'string', 'created_at' => 'timestamp', 'updated_at' => 'timestamp', 'is_read' => 'boolean'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = true;

    // Scopes...

    // Functions ...

    // Relations ...
}
