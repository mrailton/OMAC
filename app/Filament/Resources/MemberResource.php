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
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;
    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                TextInput::make('omac_id_number')->label('OMAC ID'),
                Select::make('rank')->options(Rank::class)->required(),
                Select::make('clinical_level')->options(ClinicalLevel::class)->label('Clinical Level')->required(),
                TextInput::make('cert_number')->label('Clinical Level Certificate Number'),
                DatePicker::make('cert_expires_on')->label('Clinical Level Certificate Expiry')->native(false),
                Select::make('cfr_level')->options(CFRLevel::class)->label('CFR Level')->required(),
                TextInput::make('cfr_cert_number')->label('CFR Certificate Number'),
                DatePicker::make('cfr_expires_on')->label('CFR Certificate Expiry')->native(false),
                TextInput::make('garda_vetting_id')->label('Garda Vetting Number'),
                DatePicker::make('garda_vetting_date')->label('Garda Vetting Date')->native(false),
                DatePicker::make('cpap_date')->label('CPAP Date')->native(false),
                FileUpload::make('files')
                    ->multiple()
                    ->disk('s3')
                    ->directory('member-files')
                    ->visibility('private')
                    ->storeFileNamesIn('original_file_names')
                    ->openable()
                    ->downloadable()
                    ->previewable(false)
                    ->reorderable()
                    ->appendFiles()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('omac_id_number')->sortable()->searchable()->label('OMAC ID'),
                TextColumn::make('rank')->sortable()->searchable(),
                TextColumn::make('clinical_level')->sortable()->searchable()->label('Clinical Level'),
                TextColumn::make('cfr_level')->sortable()->searchable()->label('CFR Level'),
            ])
            ->defaultSort('name')
            ->filters([
                TrashedFilter::make(),
                SelectFilter::make('rank')->options(Rank::class),
                SelectFilter::make('cfr_level')->options(CFRLevel::class)->label('CFR Level'),
                SelectFilter::make('clinical_level')->options(ClinicalLevel::class)->label('Clinical Level'),
            ])
            ->actions([
                ViewAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
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
