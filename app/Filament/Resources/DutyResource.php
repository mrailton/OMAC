<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\DutyResource\Pages\CreateDuty;
use App\Filament\Resources\DutyResource\Pages\EditDuty;
use App\Filament\Resources\DutyResource\Pages\ListDuties;
use App\Filament\Resources\DutyResource\Pages\ViewDuty;
use App\Models\Duty;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class DutyResource extends Resource
{
    protected static ?string $model = Duty::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('organizer')
                    ->required()
                    ->maxLength(255),
                DateTimePicker::make('start')
                    ->seconds(false)
                    ->required(),
                DateTimePicker::make('end')
                    ->seconds(false)
                    ->required(),
                Select::make('members')
                    ->relationship('members', 'name')
                    ->preload()
                    ->multiple()
                    ->label('Crew'),
                Select::make('vehicles')
                    ->relationship('vehicles', 'call_sign')
                    ->preload()
                    ->multiple()
                    ->label('Vehicles'),
                Textarea::make('notes')
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('organizer')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('start')
                    ->dateTime('M d, Y H:i')
                    ->sortable(),
                TextColumn::make('end')
                    ->dateTime('M d, Y H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('organizer')->options(Duty::query()->get()->pluck('organizer', 'organizer')),
            ])
            ->actions([
                ViewAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('start');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDuties::route('/'),
            'create' => CreateDuty::route('/create'),
            'view' => ViewDuty::route('/{record}'),
            'edit' => EditDuty::route('/{record}/edit'),
        ];
    }
}
