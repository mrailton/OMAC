<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicationBag extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'location'];
}
