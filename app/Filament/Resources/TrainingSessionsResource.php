<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrainingSessionsResource\Pages;
use App\Filament\Resources\TrainingSessionsResource\RelationManagers;
use App\Models\TrainingSession;
use App\Models\TrainingSessions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TrainingSessionsResource extends Resource
{
    protected static ?string $model = TrainingSession::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make('date')->native(false),
                TextInput::make('topic'),
                Textarea::make('notes'),
                Select::make('members')
                    ->relationship('members', 'name')
                    ->preload()
                    ->multiple()
                    ->required()
                    ->label('Attendees')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('date')->date('d/m/Y'),
                TextColumn::make('topic'),
            ])
            ->filters([
                //
            ])
            ->actions([
                ViewAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTrainingSessions::route('/'),
            'create' => Pages\CreateTrainingSessions::route('/create'),
            'view' => Pages\ViewTrainingSessions::route('/{record}'),
            'edit' => Pages\EditTrainingSessions::route('/{record}/edit'),
        ];
    }
}
