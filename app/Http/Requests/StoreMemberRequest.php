<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\CFRLevel;
use App\Enums\ClinicalLevel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'omac_id_number' => ['nullable', 'string', 'max:255'],
            'clinical_level' => ['required', new Enum(ClinicalLevel::class)],
            'cfr_level' => ['required', new Enum(CFRLevel::class)],
            'cfr_cert_number' => ['nullable', 'string', 'max:255'],
            'cfr_expires_on' => ['nullable', 'date'],
            'far_cert_number' => ['nullable', 'string', 'max:255'],
            'far_expires_on' => ['nullable', 'date'],
            'efr_cert_number' => ['nullable', 'string', 'max:255'],
            'efr_expires_on' => ['nullable', 'date'],
            'phecc_pin' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
