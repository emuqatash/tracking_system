<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use pxlrbt\FilamentSpotlight\SpotlightPlugin;

//Modal::closedByClickingAway(false);

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {

//        FilamentView::registerRenderHook(
//            'panels::auth.login.form.before',
//            fn(): string => '<h1>HELLO WORKD</h1>',
//        );
        //or
//        FilamentView::registerRenderHook(
//            'panels::body.start',
//            fn(): View => view('livewire.list-services'),
//        );

        return $panel
            ->default()
            ->id('dashboard')
            ->path('dashboard')
            ->login()
//            ->registration()  //enable it if you want user to create or register new login
            ->passwordReset()
            ->emailVerification()
            ->profile()
            ->colors([
                'primary' => Color::Sky,
            ])
            ->font('Poppins')
            ->favicon('images/vehicle_tracker_logo.PNG')
            // ->darkMode(false)
            ->globalSearchKeyBindings(['command+k', 'ctrl+k'])
            ->sidebarCollapsibleOnDesktop()
            ->navigationItems([
                NavigationItem::make('Registration Renewal')
                    ->url('https://renew.txdmv.gov/Renew/registrationrenewal/jsp/txdot_reg_ren_enter_vehicle_info.jsp',
                        shouldOpenInNewTab: true)
                    ->icon('heroicon-o-pencil-square')
                    ->group('External')
                    ->sort(9)
                // ->hidden(fn(): bool => auth()->user()->can('view'))
            ])
            ->userMenuItems([
                MenuItem::make()
                    ->label('Settings')
                    ->url('')
                    ->icon('heroicon-o-cog-6-tooth'),
                'logout' => MenuItem::make()->label('Log Out'),
            ])
            ->plugins([
                SpotlightPlugin::make(),
            ])
            ->breadcrumbs(true)
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
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

    public function boot(): void
    {
        //You enable it if i use AWS S3
//        if ($this->app->environment() !== 'local') {
//            ImageColumn::configureUsing(static function (ImageColumn $column) {
//                $column->disk('s3');
//            });
//            FileUpload::configureUsing(static function (FileUpload $component) {
//                $component->disk('s3');
//            });
//        }
    }
}
