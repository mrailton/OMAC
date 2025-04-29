<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class MedicationBag extends Model implements AuditableContract
{
    use Auditable;
    use SoftDeletes;

    protected $fillable = ['name', 'location'];

    public function stock(): HasMany
    {
        return $this->hasMany(MedicationBagStock::class);
    }
}
