<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum Rank: string implements HasLabel
{
    case VOLUNTEER = 'Volunteer';
    case CORPORAL = 'Corporal';
    case SERGEANT = 'Sergeant';
    case ADJUTANT = 'Adjutant';
    case SECOND_LIEUTENANT = 'Second Lieutenant';
    case FIRST_LIEUTENANT = 'First Lieutenant';
    case CAPTAIN = 'Captain';
    case COMMANDANT = 'Commandant';
    case ASSISTANT_COMMANDER = 'Assistant Commander';
    case COMMANDER = 'Commander';

    public function getLabel(): string
    {
        return $this->value;
    }
}
