<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum InvoicePaymentMethods: string implements HasLabel
{
    case NA = 'Not Applicable';
    case CHEQUE = 'Cheque';
    case CASH = 'Cash';
    case TRANSFER = 'Bank Transfer';

    public function getLabel(): string
    {
        return $this->value;
    }
}
