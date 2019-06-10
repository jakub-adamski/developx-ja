<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class UserTransaction extends Model
{
    public $table = 'users_transactions';

    protected $fillable = [
        'user_id',
        'value'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User\User');
    }
}
