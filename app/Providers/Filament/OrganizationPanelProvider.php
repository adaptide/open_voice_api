<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Tenancy\EditOrganizationProfile;
use App\Filament\Pages\Tenancy\RegisterOrganization;
use App\Filament\Resources\ProjectResource;
use App\Filament\Resources\RecordingResource;
use App\Filament\Resources\TextResource;
use App\Http\Middleware\ApplyTenantScopes;
use App\Models\Organization;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class OrganizationPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('organization')
            ->path('/')
            ->brandName('OpenVoice Organization Page')
            ->colors([
                'primary' => Color::Cyan,
            ])
            ->login()
            ->discoverResources(in: app_path('Filament/Organization/Resources'), for: 'App\\Filament\\Organization\\Resources')
            ->discoverPages(in: app_path('Filament/Organization/Pages'), for: 'App\\Filament\\Organization\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Organization/Widgets'), for: 'App\\Filament\\Organization\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
            ])
            ->resources([
                ProjectResource::class,
                TextResource::class,
                RecordingResource::class,
            ])
            ->tenant(model: Organization::class, slugAttribute: 'slug')
            ->tenantMiddleware([
                ApplyTenantScopes::class,
            ], isPersistent: true)
            ->tenantMenuItems([
                'profile' => MenuItem::make()->label('Edit Profile'),
            ])
            ->tenantRegistration(RegisterOrganization::class)

            ->tenantProfile(EditOrganizationProfile::class, )
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
