<?php

declare(strict_types=1);

namespace JeffersonGoncalves\FilamentMail\Resources\MailSuppression;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use JeffersonGoncalves\FilamentMail\FilamentMailPlugin;
use JeffersonGoncalves\FilamentMail\Resources\MailSuppression\Schemas\MailSuppressionForm;
use JeffersonGoncalves\FilamentMail\Resources\MailSuppression\Tables\MailSuppressionsTable;
use JeffersonGoncalves\LaravelMail\Models\MailSuppression;

class MailSuppressionResource extends Resource
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-no-symbol';

    protected static ?int $navigationSort = 3;

    public static function getModel(): string
    {
        return config('laravel-mail.models.mail_suppression', MailSuppression::class);
    }

    public static function getNavigationGroup(): ?string
    {
        return FilamentMailPlugin::get()->getNavigationGroup();
    }

    public static function getModelLabel(): string
    {
        return config('filament-mail.resources.mail_suppression.label', 'Suppression');
    }

    public static function getPluralModelLabel(): string
    {
        return config('filament-mail.resources.mail_suppression.plural_label', 'Suppressions');
    }

    public static function form(Schema $schema): Schema
    {
        return MailSuppressionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MailSuppressionsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMailSuppressions::route('/'),
            'create' => Pages\CreateMailSuppression::route('/create'),
        ];
    }
}
