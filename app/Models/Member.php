<?php

namespace App\Models;

use App\Enums\CFRLevel;
use App\Enums\ClinicalLevel;
use App\Enums\Rank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'omac_id_number', 'rank', 'clinical_level', 'cfr_level', 'cfr_expires_on', 'cfr_cert_number', 'cert_expires_on', 'cert_number', 'garda_vetting_date', 'garda_vetting_id', 'cpap_date', 'files', 'original_file_names'];

    protected $casts = [
        'cert_expires_on' => 'date',
        'cfr_expires_on' => 'date',
        'garda_vetting_date' => 'date',
        'cpap_date' => 'date',
        'clinical_level' => ClinicalLevel::class,
        'cfr_level' => CFRLevel::class,
        'rank' => Rank::class,
        'files' => 'array',
        'original_file_names' => 'array',
    ];

    public function notes(): HasMany
    {
        return $this->hasMany(MemberNote::class);
    }

    public function trainingSessions(): BelongsToMany
    {
        return $this->belongsToMany(TrainingSession::class);
    }
}
