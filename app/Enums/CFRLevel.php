<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum CFRLevel: string implements HasLabel
{
    case NA = 'N/A';
    case CFRC = 'CFR Community';
    case CFRA = 'CFR Advanced';

    public function getLabel(): ?string
    {
        return $this->value;
    }
}
