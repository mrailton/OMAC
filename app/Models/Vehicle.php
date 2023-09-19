<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Vehicle extends Model implements AuditableContract
{
    use Auditable;
    use HasFactory;

    protected $fillable = ['call_sign', 'registration', 'type', 'make', 'model'];

    public function duties(): BelongsToMany
    {
        return $this->belongsToMany(Duty::class);
    }
}
