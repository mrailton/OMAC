<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicationBagStock extends Model
{
    protected $fillable = ['medication_id', 'medication_bag_id', 'quantity', 'expiry_date', 'notes'];

    public function medication(): BelongsTo
    {
        return $this->belongsTo(Medication::class);
    }
}
