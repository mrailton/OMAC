<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum VehicleType: string implements HasLabel
{
    case AMBULANCE = 'Ambulance';
    case JEEP = 'Jeep';
    case MINIBUS = 'Minibus';

    public function getLabel(): string
    {
        return $this->value;
    }
}
