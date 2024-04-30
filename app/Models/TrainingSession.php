<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class TrainingSession extends Model implements AuditableContract
{
    use Auditable;
    use HasFactory;

    protected $fillable = ['date', 'topic', 'notes'];

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(Member::class);
    }

    protected function casts(): array
    {
        return [
            'date' => 'date',
        ];
    }
}
