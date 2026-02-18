<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'user_id',
        'plan_name',
        'status',
        'expired_at',
        'payment_reference',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
