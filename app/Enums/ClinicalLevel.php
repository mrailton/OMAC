<?php

namespace App\Enums;

enum ClinicalLevel: string
{
    case NA = 'N/A';
    case CFR = 'CFR';
    case FAR = 'FAR';
    case EFR = 'EFR';
    CASE EMT = 'EMT';
    case PARAMEDIC = 'Paramedic';
    case ADVANCED_PARAMEDIC = 'Advanced Paramedic';
    case NURSE = 'Nurse';

    public static function toArray(): array
    {
        $clinicalLevels = [];

        foreach (ClinicalLevel::cases() as $value) {
            $clinicalLevels[$value->name] = $value->value;
        }

        return $clinicalLevels;
    }
}
