<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Duty extends Model implements AuditableContract
{
    use Auditable;
    use HasFactory;

    protected $fillable = ['name', 'organizer', 'start', 'end', 'notes'];

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(Member::class);
    }

    public function vehicles(): BelongsToMany
    {
        return $this->belongsToMany(Vehicle::class);
    }

    protected function casts(): array
    {
        return [
            'start' => 'datetime',
            'end' => 'datetime',
        ];
    }
}
