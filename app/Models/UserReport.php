<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserReport extends Model
{
    protected $fillable = ['user_id', 'report'];

    public function user(): BelongsTo#
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
