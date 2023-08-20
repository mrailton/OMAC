<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class MemberNote extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['note'];

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }
}
