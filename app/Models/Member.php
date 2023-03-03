<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\CFRLevel;
use App\Enums\ClinicalLevel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'omac_id_number', 'clinical_level', 'cfr_level', 'cfr_expires_on', 'cfr_cert_number', 'far_expires_on', 'far_cert_number', 'efr_expires_on', 'efr_cert_number', 'phecc_pin', 'notes'];

    protected $casts = [
        'cfr_expires_on' => 'date',
        'far_expires_on' => 'date',
        'efr_expires_on' => 'date',
        'clinical_level' => ClinicalLevel::class,
        'cfr_level' => CFRLevel::class,
    ];
}
