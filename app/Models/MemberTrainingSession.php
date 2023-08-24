<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class MemberTrainingSession extends Pivot
{
    public $timestamps = false;
    public $pivotParent = Member::class;

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function trainingSession(): BelongsTo
    {
        return $this->belongsTo(TrainingSession::class);
    }
}
