<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\CFRLevel;
use App\Enums\ClinicalLevel;
use App\Enums\Rank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Member extends Model implements AuditableContract
{
    use Auditable;
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'omac_id_number', 'rank', 'clinical_level', 'cfr_level', 'cfr_expires_on', 'cfr_cert_number', 'cert_expires_on', 'cert_number', 'garda_vetting_date', 'garda_vetting_id', 'cpap_date', 'files', 'original_file_names', 'active', 'driver', 'email', 'phone'];

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
        'active' => 'boolean',
        'driver' => 'boolean',
    ];

    public function notes(): HasMany
    {
        return $this->hasMany(MemberNote::class);
    }

    public function trainingSessions(): BelongsToMany
    {
        return $this->belongsToMany(TrainingSession::class);
    }

    public function duties(): BelongsToMany
    {
        return $this->belongsToMany(Duty::class);
    }
}
