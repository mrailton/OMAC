<?php

declare(strict_types=1);

namespace App\Enums;

enum ClinicalLevel: string
{
    case NA = 'N/A';
    case CFR = 'CFR';
    case STUDENT_FAT = 'Student FAR';
    case FAR = 'FAR';
    case STUDENT_EFR = 'Student EFR';
    case EFR = 'EFR';
    case STUDENT_EMT = 'Student EMT';
    case EMT = 'EMT';
    case STUDENT_PARAMEDIC = 'Student Paramedic';
    case PARAMEDIC = 'Paramedic';
    case ADVANCED_PARAMEDIC = 'Advanced Paramedic';
    case NURSE = 'Nurse';
    case DOCTOR = 'Doctor';

    public static function toArray(): array
    {
        $clinicalLevels = [];

        foreach (ClinicalLevel::cases() as $value) {
            $clinicalLevels[$value->name] = $value->value;
        }

        return $clinicalLevels;
    }
}
