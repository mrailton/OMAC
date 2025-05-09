<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Enums\CFRLevel;
use App\Enums\ClinicalLevel;
use App\Enums\Rank;
use App\Filament\Resources\MemberResource\Pages\CreateMember;
use App\Filament\Resources\MemberResource\Pages\EditMember;
use App\Filament\Resources\MemberResource\Pages\ListMembers;
use App\Filament\Resources\MemberResource\Pages\ViewMember;
use App\Filament\Resources\MemberResource\RelationManagers\DutiesRelationManager;
use App\Filament\Resources\MemberResource\RelationManagers\NotesRelationManager;
use App\Filament\Resources\MemberResource\RelationManagers\TrainingSessionsRelationManager;
use App\Models\Member;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required(),
                Select::make('active')
                    ->options([false => 'No', true => 'Yes'])
                    ->default(false)
                    ->required(),
                TextInput::make('omac_id_number')
                    ->label('OMAC ID'),
                DatePicker::make('join_date')
                    ->native(false)
                    ->label('Join Date'),
                TextInput::make('email')
                    ->label('Email Address')
                    ->email(),
                TextInput::make('phone')
                    ->label('Phone Number'),
                Select::make('rank')
                    ->options(Rank::class)
                    ->required()
                    ->default(Rank::VOLUNTEER),
                Select::make('clinical_level')
                    ->options(ClinicalLevel::class)
                    ->label('Clinical Level')
                    ->required(),
                TextInput::make('cert_number')
                    ->label('Clinical Level Certificate Number'),
                DatePicker::make('cert_expires_on')
                    ->label('Clinical Level Certificate Expiry')
                    ->native(false),
                Select::make('cfr_level')
                    ->label('CFR Level')
                    ->options(CFRLevel::class)
                    ->required(),
                TextInput::make('cfr_cert_number')
                    ->label('CFR Certificate Number'),
                DatePicker::make('cfr_expires_on')
                    ->label('CFR Certificate Expiry')
                    ->native(false),
                DatePicker::make('manual_handling_date')
                    ->label('Manual Handling Date')
                    ->native(false),
                TextInput::make('garda_vetting_id')
                    ->label('Garda Vetting Number'),
                DatePicker::make('garda_vetting_date')
                    ->label('Garda Vetting Date')
                    ->native(false),
                DatePicker::make('cpap_date')
                    ->label('CPAP Date')
                    ->native(false),
                Select::make('driver')
                    ->options([false => 'No', true => 'Yes'])
                    ->live()
                    ->required(),
                TextInput::make('driving_license_number')
                    ->label('Driving License Number')
                    ->visible(fn (Get $get): bool => null !== $get('driver') && $get('driver')),
                Select::make('driving_license_classes')
                    ->label('Driving License Classes')
                    ->options(['B', 'C1', 'C', 'D1', 'D', 'BE', 'C1E', 'CE', 'D1E', 'D'])
                    ->multiple()
                    ->visible(fn (Get $get): bool => null !== $get('driver') && $get('driver')),
                FileUpload::make('files')
                    ->label('Member Files')
                    ->multiple()
                    ->disk('s3')
                    ->directory('member-files')
                    ->visibility('private')
                    ->storeFileNamesIn('original_file_names')
                    ->openable()
                    ->downloadable()
                    ->previewable(false)
                    ->reorderable()
                    ->panelLayout('list')
                    ->appendFiles(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                IconColumn::make('active')->boolean(),
                TextColumn::make('omac_id_number')->sortable()->searchable()->label('OMAC ID'),
                TextColumn::make('rank')->sortable()->searchable(),
                TextColumn::make('clinical_level')->sortable()->searchable()->label('Clinical Level'),
                TextColumn::make('cfr_level')->sortable()->searchable()->label('CFR Level'),
                IconColumn::make('driver')->boolean(),
            ])
            ->defaultSort('name')
            ->filters([
                TrashedFilter::make(),
                SelectFilter::make('rank')->options(Rank::class)->multiple(),
                SelectFilter::make('cfr_level')->options(CFRLevel::class)->label('CFR Level'),
                SelectFilter::make('clinical_level')->options(ClinicalLevel::class)->label('Clinical Level')->multiple(),
                SelectFilter::make('active')->options([0 => 'No', 1 => 'Yes']),
                SelectFilter::make('driver')->options([0 => 'No', 1 => 'Yes']),
                Filter::make('join_date')
                    ->form([
                        Fieldset::make('Join Date')->schema([
                            DatePicker::make('from'),
                            DatePicker::make('to'),
                        ])->columns(1),
                    ])
                    ->query(fn (Builder $query, array $data) => $query
                        ->when($data['from'] ?? null, fn (Builder $query) => $query->whereDate('join_date', '>=', $data['from']))
                        ->when($data['to'] ?? null, fn (Builder $query) => $query->whereDate('join_date', '<=', $data['to']))),
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
            NotesRelationManager::class,
            TrainingSessionsRelationManager::class,
            DutiesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMembers::route('/'),
            'create' => CreateMember::route('/create'),
            'view' => ViewMember::route('/{record}'),
            'edit' => EditMember::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
