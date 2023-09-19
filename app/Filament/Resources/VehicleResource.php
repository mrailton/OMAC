<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Enums\VehicleType;
use App\Filament\Resources\VehicleResource\Pages;
use App\Filament\Resources\VehicleResource\RelationManagers\DutiesRelationManager;
use App\Models\Vehicle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class VehicleResource extends Resource
{
    protected static ?string $model = Vehicle::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('call_sign')
                    ->maxLength(255),
                TextInput::make('registration')
                    ->maxLength(255),
                Select::make('type')
                    ->options(VehicleType::class)
                    ->required(),
                TextInput::make('make')
                    ->maxLength(255),
                TextInput::make('model')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('call_sign')
                    ->searchable(),
                TextColumn::make('registration')
                    ->searchable(),
                TextColumn::make('type')
                    ->searchable(),
                TextColumn::make('make')
                    ->searchable(),
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
            DutiesRelationManager::make(),
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVehicles::route('/'),
            'create' => Pages\CreateVehicle::route('/create'),
            'view' => Pages\ViewVehicle::route('/{record}'),
            'edit' => Pages\EditVehicle::route('/{record}/edit'),
        ];
    }
}
