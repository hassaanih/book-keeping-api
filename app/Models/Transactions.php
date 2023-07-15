<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $initiator_id
 * @property int    $manager_id
 * @property int    $recieved_by_user_id
 * @property int    $created_at
 * @property int    $updated_at
 * @property float  $balance
 * @property float  $commision
 * @property int    $target_currency_id
 * @property string $contact_number
 * @property int    $recieving_currency_id
 * @property string $otp_for_transaction
 * @property string $reason_for_reject
 */
class Transactions extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'transactions';

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
        'initiator_id', 'commision', 'contact_number', 'target_currency_id', 'recieving_currency_id', 'converted_amount', 'manager_id', 'balance', 'otp_for_transaction', 'transaction_status', 'reason_for_reject', 'recieved_by_user_id', 'created_at', 'updated_at'
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
        'initiator_id' => 'int', 'manager_id' => 'int', 'contact_number' => 'string', 'balance' => 'double', 'commision' => 'double', 'target_currency_id' => 'int', 'recieving_currency_id' => 'int', 'otp_for_transaction' => 'string', 'reason_for_reject' => 'string', 'recieved_by_user_id' => 'int', 'created_at' => 'timestamp', 'updated_at' => 'timestamp'
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
    public function initiator(){
        return $this->hasOne(Users::class, 'id', 'initiator_id');
    }

    public function manager(){
        return $this->hasOne(Users::class, 'id', 'manager_id');
    }

    public function reciever(){
        return $this->hasOne(Users::class, 'id', 'recieved_by_user_id');
    }
}
