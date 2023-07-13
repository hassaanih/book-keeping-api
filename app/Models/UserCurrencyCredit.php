<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $currency_id
 * @property int    $user_id
 * @property int    $created_at
 * @property int    $updated_at
 * @property string $currency_id_name
 * @property float  $credit_balance
 */
class UserCurrencyCredit extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_currency_credit';

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
        'currency_id', 'currency_id_name', 'user_id', 'credit_balance', 'created_at', 'updated_at'
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
        'currency_id' => 'int', 'currency_id_name' => 'string', 'user_id' => 'int', 'credit_balance' => 'double', 'created_at' => 'timestamp', 'updated_at' => 'timestamp'
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
