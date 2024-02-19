<?php

declare(strict_types=1);

namespace App\Filament\Resources\MemberResource\RelationManagers;

use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TrainingSessionsRelationManager extends RelationManager
{
    protected static string $relationship = 'trainingSessions';

    public function form(Form $form): Form
    {
        return $form;
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('topic')
            ->columns([
                TextColumn::make('date')->date('d/m/Y'),
                TextColumn::make('topic'),
            ])
            ->defaultSort('date', 'desc');
    }
}
