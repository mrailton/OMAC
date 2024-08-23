<?php

declare(strict_types=1);

namespace App\Filament\Resources\MedicationBagResource\RelationManagers;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StockRelationManager extends RelationManager
{
    protected static string $relationship = 'stock';

    protected static ?string $label = 'Medication Bag Stock Item';

    protected static ?string $title = 'Medication Bag Stock';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('medication_id')
                    ->relationship('medication', 'name')
                    ->required()
                    ->preload()
                    ->disabledOn('edit'),
                TextInput::make('quantity')
                    ->required(),
                DatePicker::make('expiry_date')
                    ->required(),
                Textarea::make('notes'),
            ])
            ->columns(1);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('medication.name'),
                TextColumn::make('quantity'),
                TextColumn::make('expiry_date')->date('d/m/Y'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public function isReadOnly(): bool
    {
        return false;
    }
}
