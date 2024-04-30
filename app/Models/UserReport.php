<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserReport extends Model
{
    protected $fillable = ['user_id', 'report'];

    public function user(): BelongsTo#
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
