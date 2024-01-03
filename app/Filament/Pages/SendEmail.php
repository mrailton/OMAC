<?php

namespace App\Filament\Pages;

use App\Mail\MassMail;
use App\Models\Member;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Mail;

class SendEmail extends Page implements HasForms
{
    use HasPageShield;
    use InteractsWithForms;

    public $recipients;
    public $subject;
    public $body;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.send-email';

    protected static ?string $navigationGroup = 'System';

    public function form(Form $form): Form
    {
        return $form->schema([
            Select::make('recipients')
                ->options(Member::query()->whereNotNull('email')->get()->pluck('name', 'email'))
                ->preload()
                ->multiple()
                ->required(),
            TextInput::make('subject')
                ->required(),
            MarkdownEditor::make('body')
                ->required()
        ]);
    }

    public function send()
    {
        Mail::to($this->recipients)
            ->send(new MassMail($this->subject, $this->body));

            Notification::make()->title('Email Sent Successfully')->success()->send();

            return redirect('/');
    }
}
