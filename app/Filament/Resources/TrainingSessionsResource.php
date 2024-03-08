<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\TrainingSessionsResource\Pages;
use App\Models\TrainingSession;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TrainingSessionsResource extends Resource
{
    protected static ?string $model = TrainingSession::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make('date')->native(false)->default(now())->required(),
                TextInput::make('topic')->required(),
                Textarea::make('notes'),
                Select::make('members')
                    ->relationship('members', 'name')
                    ->preload()
                    ->multiple()
                    ->required()
                    ->label('Attendees'),
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
                Filter::make('date')
                    ->form([
                        Fieldset::make('Training Date')
                            ->schema([
                                DatePicker::make('from')->default(now()->startOfYear()),
                                DatePicker::make('to')->default(now()->endOfYear()),
                            ])
                            ->columns(1),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when(
                                $data['from'] ?? null,
                                fn (Builder $query) => $query->whereDate('date', '>=', $data['from'])
                            )
                            ->when(
                                $data['to'] ?? null,
                                fn (Builder $query) => $query->whereDate('date', '<=', $data['to'])
                            );
                    }),
            ])
            ->actions([
                ViewAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('date', 'desc');
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
