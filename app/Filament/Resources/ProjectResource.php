<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    // protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\Select::make('organization_id')->relationship('organization', 'name')->required(),
            Forms\Components\Select::make('user_id')->relationship('user', 'name')->required(),
            Forms\Components\TextInput::make('name')->required(),
            Forms\Components\TextInput::make('slug')->unique(),
            Forms\Components\Textarea::make('description'),
            Forms\Components\Toggle::make('is_public'),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('organization.name')->label('Organization'),
            Tables\Columns\TextColumn::make('user.name')->label('Created By'),
            Tables\Columns\BooleanColumn::make('is_public'),
        ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
