<?php

namespace App\Enums;

enum ClinicalLevel: string
{
    case CFR = 'CFR';
    case FAR = 'FAR';
    case EFR = 'EFR';
    CASE EMT = 'EMT';
    case PARAMEDIC = 'Paramedic';
    case ADVANCED_PARAMEDIC = 'Advanced Paramedic';
    case NURSE = 'Nurse';
}
