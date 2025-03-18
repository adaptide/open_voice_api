<?php

namespace App\Filament\Pages\Tenancy;

use App\Models\Organization;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Tenancy\RegisterTenant;

class RegisterOrganization extends RegisterTenant
{
    public static function getLabel(): string
    {
        return 'Register Organization';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Organization Name')
                    ->placeholder('Input Organization Name')
                    ->required(),
                TextInput::make('email')
                    ->email()
                    ->placeholder('dev@organization.com')
                    ->required(),
                FileUpload::make('logo')
                    ->image(),
            ]);
    }

    protected function handleRegistration(array $data): Organization
    {
        $organization = Organization::create($data + ['owner_id' => auth()->user()->id]);
        $organization->members()->attach(auth()->user());
        return $organization;
    }
}
