<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum PractitionerLevel: string implements HasLabel
{
    case EMT = 'EMT';
    case P = 'Paramedic';
    case AP = 'Advanced Paramedic';

    public function getLabel(): string
    {
        return $this->value;
    }
}
