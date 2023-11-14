<?php declare(strict_types=1);

use App\Livewire\AcceptInvitation;

Route::middleware('signed')
    ->get('invitation/{invitation}/accept', AcceptInvitation::class)
    ->name('invitation.accept');
