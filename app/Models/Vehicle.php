<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = ['call_sign', 'registration', 'type', 'make', 'model'];

    public function duties(): BelongsToMany
    {
        return $this->belongsToMany(Duty::class);
    }
}
