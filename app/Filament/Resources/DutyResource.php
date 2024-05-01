<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Enums\InvoicePaymentMethods;
use App\Filament\Resources\DutyResource\Pages\CreateDuty;
use App\Filament\Resources\DutyResource\Pages\EditDuty;
use App\Filament\Resources\DutyResource\Pages\ListDuties;
use App\Filament\Resources\DutyResource\Pages\ViewDuty;
use App\Models\Duty;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

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
                    ->datalist(Duty::query()->groupBy('organizer')->pluck('organizer')->all())
                    ->required()
                    ->maxLength(255),
                DateTimePicker::make('start')
                    ->seconds(false)
                    ->required()
                    ->live()
                    ->afterStateUpdated(fn (Set $set, Get $get) => $set('end', $get('start'))),
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
                Textarea::make('invoice_amount')
                    ->label('Invoice Amount')
                    ->nullable(),
                DatePicker::make('invoice_paid_on')
                    ->label('Invoice Paid On')
                    ->nullable(),
                Select::make('invoice_payment_method')
                    ->label('Invoice Payment Method')
                    ->options(InvoicePaymentMethods::class)
                    ->nullable(),
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
                IconColumn::make('invoice_paid_on')
                    ->label('Invoice Paid')
                    ->boolean(),
            ])
            ->filters([
                SelectFilter::make('organizer')->options(Duty::query()->get()->pluck('organizer', 'organizer')),
                Filter::make('start')
                    ->form([
                        Fieldset::make('Duty Start Date / Time')
                            ->schema([
                                DateTimePicker::make('from')->default(now()->startOfYear()),
                                DateTimePicker::make('to')->default(now()->endOfYear()),
                            ])
                            ->columns(1),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when(
                                $data['from'] ?? null,
                                fn (Builder $query) => $query->whereDate('start', '>=', $data['from'])
                            )
                            ->when(
                                $data['to'] ?? null,
                                fn (Builder $query) => $query->whereDate('start', '<=', $data['to'])
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
                ExportBulkAction::make()->exports([
                    ExcelExport::make()->withColumns([
                        Column::make('name'),
                        Column::make('organizer'),
                        Column::make('start')->format('Y-m-d H:i'),
                        Column::make('end')->format('Y-m-d H:i'),
                        Column::make('duration')
                            ->getStateUsing(fn ($record) => $record->start->diff($record->end)->format('%H:%i')),
                        Column::make('duty_hours')
                            ->getStateUsing(fn ($record) => $record->start->diff($record->end)->multiply($record->members->count())->format('%H:%i')),
                        Column::make('members')
                            ->heading('Members')
                            ->getStateUsing(fn ($record) => $record->members->pluck('name')->join(', ')),
                        Column::make('vehicles')
                            ->heading('Vehicles')
                            ->getStateUsing(fn ($record) => $record->vehicles->pluck('call_sign')->join(', ')),
                        Column::make('invoice_amount')
                            ->heading('Invoice Amount'),
                        Column::make('invoice_paid_on')
                            ->heading('Invoice Paid On')
                            ->getStateUsing(fn ($record) => $record->invoice_paid_on ? $record->invoice_paid_on->format('d/m/Y') : 'Not Paid'),
                        Column::make('invoice_payment_method')
                            ->heading('Invoice Payment Method')
                            ->getStateUsing(fn ($record) => $record->invoice_payment_method ?: 'Not Paid'),
                    ])
                        ->withFilename('Rathdrum OMAC Duties'),
                ]),
            ])
            ->defaultSort('start', 'desc');
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
