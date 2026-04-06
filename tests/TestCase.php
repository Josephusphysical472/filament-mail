<?php

declare(strict_types=1);

namespace JeffersonGoncalves\FilamentMail\Tests;

use Filament\FilamentServiceProvider;
use Filament\Support\SupportServiceProvider;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use JeffersonGoncalves\FilamentMail\FilamentMailServiceProvider;
use JeffersonGoncalves\FilamentMail\Tests\Fixtures\TestPanelProvider;
use JeffersonGoncalves\LaravelMail\LaravelMailServiceProvider;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase();
    }

    protected function getPackageProviders($app): array
    {
        return [
            LivewireServiceProvider::class,
            SupportServiceProvider::class,
            FilamentServiceProvider::class,
            TestPanelProvider::class,
            LaravelMailServiceProvider::class,
            FilamentMailServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        $app['config']->set('app.key', 'base64:'.base64_encode(random_bytes(32)));
        $app['config']->set('filament-mail.template_editor.locales', ['en', 'pt_BR']);
    }

    protected function setUpDatabase(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password')->default('');
            $table->timestamps();
        });

        // Run laravel-mail migrations
        $this->artisan('migrate', ['--database' => 'testing'])->run();
    }
}
