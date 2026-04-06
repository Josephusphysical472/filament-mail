<?php

declare(strict_types=1);

namespace JeffersonGoncalves\FilamentMail\Resources\MailLog;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use JeffersonGoncalves\FilamentMail\FilamentMailPlugin;
use JeffersonGoncalves\FilamentMail\Resources\MailLog\Schemas\MailLogInfolist;
use JeffersonGoncalves\FilamentMail\Resources\MailLog\Tables\MailLogsTable;
use JeffersonGoncalves\LaravelMail\Models\MailLog;

class MailLogResource extends Resource
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-inbox-stack';

    protected static ?int $navigationSort = 1;

    public static function getModel(): string
    {
        return config('laravel-mail.models.mail_log', MailLog::class);
    }

    public static function getNavigationGroup(): ?string
    {
        return FilamentMailPlugin::get()->getNavigationGroup();
    }

    public static function getModelLabel(): string
    {
        return config('filament-mail.resources.mail_log.label', 'Mail Log');
    }

    public static function getPluralModelLabel(): string
    {
        return config('filament-mail.resources.mail_log.plural_label', 'Mail Logs');
    }

    public static function table(Table $table): Table
    {
        return MailLogsTable::configure($table);
    }

    public static function infolist(Schema $schema): Schema
    {
        return MailLogInfolist::configure($schema);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMailLogs::route('/'),
            'view' => Pages\ViewMailLog::route('/{record}'),
        ];
    }
}
