<?php

namespace App\Models;

use App\Enums\CFRLevel;
use App\Enums\ClinicalLevel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'omac_id_number', 'clinical_level', 'cfr_level', 'cfr_expires_on', 'cfr_cert_number', 'cert_expires_on', 'cert_number', 'garda_vetting_date', 'garda_vetting_id', 'cpap_date'];

    protected $casts = [
        'cert_expires_on' => 'date',
        'cfr_expires_on' => 'date',
        'garda_vetting_date' => 'date',
        'cpap_date' => 'date',
        'clinical_level' => ClinicalLevel::class,
        'cfr_level' => CFRLevel::class,
    ];

    public function notes(): HasMany
    {
        return $this->hasMany(MemberNote::class);
    }
}
