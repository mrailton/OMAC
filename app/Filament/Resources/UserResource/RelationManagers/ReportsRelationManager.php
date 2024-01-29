<?php

declare(strict_types=1);

namespace App\Filament\Resources\UserResource\RelationManagers;

use App\Models\UserReport;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Livewire\Component as Livewire;

class ReportsRelationManager extends RelationManager
{
    public static array $options = ['certificate_expiry_report' => 'Certificate Expiry Report'];

    protected static string $relationship = 'reports';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('report')
                    ->options(self::$options)
                    ->disableOptionWhen(function (string $value, Livewire $livewire): bool {
                        return UserReport::query()
                            ->where('user_id', '=', $livewire->ownerRecord->id)
                            ->where('report', '=', $value)
                            ->exists();
                    })
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('report')
            ->columns([
                TextColumn::make('report')->formatStateUsing(fn(string $state): string => ucwords(str_replace('_', ' ', $state))),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                CreateAction::make()
            ]);
    }

    public function isReadOnly(): bool
    {
        return false;
    }
}
