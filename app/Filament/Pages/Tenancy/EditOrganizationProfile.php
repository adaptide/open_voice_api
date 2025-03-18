<?php

namespace App\Filament\Pages\Tenancy;

use Filament\Facades\Filament;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Tenancy\EditTenantProfile;

class EditOrganizationProfile extends EditTenantProfile
{
    public static function getLabel(): string
    {
        return Filament::getTenant()->name;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                        TextInput::make('name')
                            ->placeholder('Input Organization Name')
                            ->label('Organization Name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('phone')
                            ->mask('+7 (999) 999-99-99')
                            ->live()
                            ->placeholder('Input Organization Phone')
                            ->label('Organization Phone')
                            ->maxLength(255),
                        TextInput::make('email')
                            ->placeholder('Input Organization Email')
                            ->label('Organization Email')
                            ->required()
                            ->maxLength(255),
                ])->columnSpan(['lg' => 2]),
                Group::make()->schema([
                        FileUpload::make('logo')
                            ->image()
                            ->placeholder('Input Organization Logo')
                            ->label('Organization Logo')
                            ->maxFiles(1),
                ])->columnSpan(['lg' => 1])
            ])->columns(3);
    }
}
