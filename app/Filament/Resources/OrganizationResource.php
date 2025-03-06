<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrganizationResource\Pages;
use App\Models\Organization;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;

class OrganizationResource extends Resource
{
    protected static ?string $model = Organization::class;

    // protected static ?string $navigationIcon = 'heroicon-o-office-building';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->required(),
            Forms\Components\TextInput::make('slug')->unique(),
            Forms\Components\TextInput::make('email')->email()->required()->unique(),
            Forms\Components\TextInput::make('phone'),
            Forms\Components\FileUpload::make('logo')->image(),
            Forms\Components\Select::make('owner_id')->relationship('owner', 'name')->required(),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('email')->sortable()->searchable(),
            Tables\Columns\ImageColumn::make('logo'),
            Tables\Columns\TextColumn::make('owner.name')->label('Owner'),
        ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrganizations::route('/'),
            'create' => Pages\CreateOrganization::route('/create'),
            'edit' => Pages\EditOrganization::route('/{record}/edit'),
        ];
    }
}
