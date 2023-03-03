<?php

declare(strict_types=1);

namespace App\Enums;

enum CFRLevel: string
{
    case NA = 'N/A';
    case CFRC = 'CFR Community';
    case CFRA = 'CFR Advanced';

    public static function toArray(): array
    {
        $cfrLevels = [];

        foreach (CFRLevel::cases() as $value) {
            $cfrLevels[$value->name] = $value->value;
        }

        return $cfrLevels;
    }
}
