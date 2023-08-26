<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Duty extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'organizer', 'start', 'end', 'notes'];

    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime',
    ];

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(Member::class);
    }

    public function vehicles(): BelongsToMany
    {
        return $this->belongsToMany(Vehicle::class);
    }
}
