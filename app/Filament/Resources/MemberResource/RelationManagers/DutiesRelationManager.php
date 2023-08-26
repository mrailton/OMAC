<?php

namespace App\Filament\Resources\MemberResource\RelationManagers;

use App\Filament\Resources\DutyResource;
use App\Models\Duty;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DutiesRelationManager extends RelationManager
{
    protected static string $relationship = 'duties';

    public function form(Form $form): Form
    {
        return $form;
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('start')->date('d/m/Y H:i'),
                TextColumn::make('end')->date('d/m/Y H:i'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('view')->url(fn (Duty $record): string => DutyResource::getUrl('view', ['record' => $record]))
            ]);
    }
}
