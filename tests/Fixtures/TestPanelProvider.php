<?php

declare(strict_types=1);

namespace JeffersonGoncalves\FilamentMail\Tests\Fixtures;

use Filament\Panel;
use Filament\PanelProvider;
use JeffersonGoncalves\FilamentMail\FilamentMailPlugin;

class TestPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->plugins([
                FilamentMailPlugin::make(),
            ]);
    }
}
