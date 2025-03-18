<?php

namespace App\Filament\Resources;

use App\Enums\User\Role;
use App\Filament\Resources\TextResource\Pages;
use App\Models\Text;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class TextResource extends Resource
{
    protected static ?string $tenantOwnershipRelationshipName = 'organization';
    protected static ?string $model = Text::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        if (Auth::user()->hasRole(Role::ORGANIZATION)) {
            return $query->whereHas('organization', function ($query) {
                $query->where('organizations.id', Filament::getTenant()?->id);
            });
        }
        return $query;
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('project_id')
                    ->relationship('project', 'name', function ($query) {
                        $query->whereIn('organization_id', Auth::user()->organizations()->pluck('id')->toArray());
                    })
                    ->visible(fn() => Auth::user()->hasRole(Role::ORGANIZATION)),
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
                    ->columnSpanFull()
                    ->native(false)
                    ->preload()
                    ->searchable(),
                Forms\Components\Textarea::make('content')
                    ->placeholder('input content')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('is_public')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('project.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->sortable(),
                    Tables\Columns\TextColumn::make('content')
                    ->wrap()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_public')
                    ->boolean(),
                // Tables\Columns\TextColumn::make('recordings_count')
                //     ->badge()
                //     ->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListTexts::route('/'),
            'create' => Pages\CreateText::route('/create'),
            'edit' => Pages\EditText::route('/{record}/edit'),
        ];
    }
}
