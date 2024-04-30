<?php

declare(strict_types=1);

namespace App\Actions\Users;

use App\Mail\TeamInvitationMail;
use App\Models\Invitation;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Mail;

class InviteUser
{
    public function execute(string $email): void
    {
        if (Invitation::query()->where('email', $email)->exists()) {
            Notification::make('existingInvite')
                ->body('This user has already been invited but has not accepted their invitation.')
                ->danger()
                ->send();

            return;
        }

        if (User::query()->where('email', $email)->exists()) {
            Notification::make('existingUser')
                ->body('This email address is already being used by an existing user.')
                ->danger()
                ->send();

            return;
        }

        $invitation = Invitation::create(['email' => $email]);

        Mail::to($invitation->email)->send(new TeamInvitationMail($invitation));

        Notification::make('invitedSuccess')
            ->body('User invited successfully')
            ->success()
            ->send();
    }
}
