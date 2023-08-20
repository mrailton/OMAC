<?php

namespace App\Filament\Resources;

use App\Enums\CFRLevel;
use App\Enums\ClinicalLevel;
use App\Filament\Resources\MemberResource\Pages;
use App\Filament\Resources\MemberResource\RelationManagers;
use App\Models\Member;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('omac_id_number')->label('OMAC ID'),
                Forms\Components\Select::make('clinical_level')->options(ClinicalLevel::class)->label('Clinical Level')->required(),
                Forms\Components\TextInput::make('cert_number')->label('Clinical Level Certificate Number'),
                Forms\Components\DatePicker::make('cert_expires_on')->label('Clinical Level Certificate Expiry'),
                Forms\Components\Select::make('cfr_level')->options(CFRLevel::class)->label('CFR Level')->required(),
                Forms\Components\TextInput::make('cfr_cert_number')->label('CFR Certificate Number'),
                Forms\Components\DatePicker::make('cfr_expires_on')->label('CFR Certificate Expiry'),
                Forms\Components\TextInput::make('garda_vetting_id')->label('Garda Vetting Number'),
                Forms\Components\DatePicker::make('garda_vetting_date')->label('Garda Vetting Date'),
                Forms\Components\DatePicker::make('cpap_date')->label('CPAP Date'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('omac_id_number')->sortable()->searchable()->label('OMAC ID'),
                Tables\Columns\TextColumn::make('clinical_level')->sortable()->searchable()->label('Clinical Level'),
                Tables\Columns\TextColumn::make('cfr_level')->sortable()->searchable()->label('CFR Level'),
            ])
            ->defaultSort('name', 'asc')
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\SelectFilter::make('cfr_level')->options(CFRLevel::class)->label('CFR Level'),
                Tables\Filters\SelectFilter::make('clinical_level')->options(ClinicalLevel::class)->label('Clinical Level'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListMembers::route('/'),
            'create' => Pages\CreateMember::route('/create'),
            'view' => Pages\ViewMember::route('/{record}'),
            'edit' => Pages\EditMember::route('/{record}/edit'),
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
