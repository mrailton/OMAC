<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Medication extends Model implements AuditableContract
{
    use Auditable;
    use SoftDeletes;

    protected $fillable = ['name', 'practitioner_level'];
}
