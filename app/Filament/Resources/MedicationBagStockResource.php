<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\MedicationBagStockResource\Pages\CreateMedicationBagStock;
use App\Filament\Resources\MedicationBagStockResource\Pages\EditMedicationBagStock;
use App\Filament\Resources\MedicationBagStockResource\Pages\ListMedicationBagStocks;
use App\Filament\Resources\MedicationBagStockResource\Pages\ViewMedicationBagStock;
use App\Models\MedicationBagStock;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Table;

class MedicationBagStockResource extends Resource
{
    protected static ?string $model = MedicationBagStock::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => ListMedicationBagStocks::route('/'),
            'create' => CreateMedicationBagStock::route('/create'),
            'view' => ViewMedicationBagStock::route('/{record}'),
            'edit' => EditMedicationBagStock::route('/{record}/edit'),
        ];
    }
}
