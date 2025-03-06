<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TextResource\Pages;
use App\Models\Text;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;

class TextResource extends Resource
{
    protected static ?string $model = Text::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\Select::make('project_id')->relationship('project', 'name')->required(),
            Forms\Components\Select::make('category_id')->relationship('category', 'name'),
            Forms\Components\Textarea::make('content')->required(),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('project.name')->label('Project'),
            Tables\Columns\TextColumn::make('category.name')->label('Category'),
            Tables\Columns\TextColumn::make('content')->limit(50),
        ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTexts::route('/'),
            'create' => Pages\CreateText::route('/create'),
            'edit' => Pages\EditText::route('/{record}/edit'),
        ];
    }
}
