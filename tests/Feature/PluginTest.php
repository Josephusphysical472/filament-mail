<?php

declare(strict_types=1);

use JeffersonGoncalves\FilamentMail\FilamentMailPlugin;
use JeffersonGoncalves\FilamentMail\FilamentMailServiceProvider;

it('can register the service provider', function () {
    expect(app()->getProviders(FilamentMailServiceProvider::class))
        ->not->toBeEmpty();
});

it('can create plugin instance', function () {
    $plugin = FilamentMailPlugin::make();

    expect($plugin)->toBeInstanceOf(FilamentMailPlugin::class);
    expect($plugin->getId())->toBe('filament-mail');
});

it('has fluent configuration api', function () {
    $plugin = FilamentMailPlugin::make()
        ->mailLogResource()
        ->mailTemplateResource()
        ->mailSuppressionResource()
        ->statsWidgets()
        ->analyticsWidget()
        ->dashboard()
        ->navigationGroup('Custom Email')
        ->navigationIcon('heroicon-o-inbox')
        ->navigationSort(10)
        ->tenantScoping(false);

    expect($plugin->getNavigationGroup())->toBe('Custom Email');
    expect($plugin->getNavigationIcon())->toBe('heroicon-o-inbox');
    expect($plugin->getNavigationSort())->toBe(10);
    expect($plugin->hasTenantScoping())->toBeFalse();
});

it('can disable resources via fluent api', function () {
    $plugin = FilamentMailPlugin::make()
        ->mailLogResource(false)
        ->mailTemplateResource(false)
        ->mailSuppressionResource(false);

    expect($plugin)->toBeInstanceOf(FilamentMailPlugin::class);
});

it('uses default navigation group from config', function () {
    $plugin = FilamentMailPlugin::make();

    expect($plugin->getNavigationGroup())->toBe('Email');
});
