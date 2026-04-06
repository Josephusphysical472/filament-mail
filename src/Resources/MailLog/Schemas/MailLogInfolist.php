<?php

declare(strict_types=1);

namespace JeffersonGoncalves\FilamentMail\Resources\MailLog\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use JeffersonGoncalves\FilamentMail\Resources\MailTemplate\MailTemplateResource;
use JeffersonGoncalves\LaravelMail\Enums\MailStatus;

class MailLogInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Details')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('status')
                            ->badge()
                            ->color(fn (MailStatus $state): string => match ($state) {
                                MailStatus::Pending => 'gray',
                                MailStatus::Sent => 'info',
                                MailStatus::Delivered => 'success',
                                MailStatus::Bounced => 'danger',
                                MailStatus::Complained => 'warning',
                                MailStatus::Failed => 'danger',
                            }),
                        TextEntry::make('subject'),
                        TextEntry::make('mailer')
                            ->placeholder('—'),
                        TextEntry::make('provider_message_id')
                            ->label('Provider Message ID')
                            ->placeholder('—')
                            ->columnSpanFull()
                            ->copyable(),
                        TextEntry::make('created_at')
                            ->dateTime(),
                        TextEntry::make('updated_at')
                            ->dateTime(),
                    ]),

                Section::make('Sender & Recipients')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('from')
                            ->formatStateUsing(fn ($state) => self::formatAddresses($state)),
                        TextEntry::make('to')
                            ->formatStateUsing(fn ($state) => self::formatAddresses($state)),
                        TextEntry::make('cc')
                            ->formatStateUsing(fn ($state) => self::formatAddresses($state))
                            ->placeholder('—'),
                        TextEntry::make('bcc')
                            ->formatStateUsing(fn ($state) => self::formatAddresses($state))
                            ->placeholder('—'),
                        TextEntry::make('reply_to')
                            ->label('Reply To')
                            ->formatStateUsing(fn ($state) => self::formatAddresses($state))
                            ->placeholder('—'),
                    ]),

                Section::make('Content')
                    ->schema([
                        Tabs::make('content_tabs')
                            ->tabs([
                                Tab::make('HTML')
                                    ->schema([
                                        ViewEntry::make('html_body')
                                            ->view('filament-mail::components.mail-preview-entry')
                                            ->columnSpanFull(),
                                    ]),
                                Tab::make('Plain Text')
                                    ->schema([
                                        TextEntry::make('text_body')
                                            ->prose()
                                            ->placeholder('No plain text version'),
                                    ]),
                            ]),
                    ]),

                Section::make('Headers')
                    ->schema([
                        TextEntry::make('headers')
                            ->formatStateUsing(function ($state): string {
                                if (! is_array($state) || empty($state)) {
                                    return '—';
                                }

                                return collect($state)
                                    ->map(fn ($value, $key) => is_int($key) ? $value : "{$key}: {$value}")
                                    ->implode("\n");
                            })
                            ->prose()
                            ->placeholder('—'),
                    ])
                    ->collapsible()
                    ->collapsed(),

                Section::make('Attachments')
                    ->schema([
                        ViewEntry::make('attachments')
                            ->view('filament-mail::components.attachments-entry')
                            ->columnSpanFull(),
                    ])
                    ->visible(fn ($record) => is_array($record->attachments) && count($record->attachments) > 0),

                Section::make('Metadata')
                    ->schema([
                        TextEntry::make('metadata')
                            ->formatStateUsing(function ($state): string {
                                if (! is_array($state) || empty($state)) {
                                    return '—';
                                }

                                return json_encode($state, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
                            })
                            ->prose()
                            ->placeholder('—'),
                    ])
                    ->collapsible()
                    ->collapsed(),

                Section::make('Template')
                    ->schema([
                        TextEntry::make('template.name')
                            ->label('Template')
                            ->url(fn ($record) => $record->mail_template_id
                                ? MailTemplateResource::getUrl('edit', ['record' => $record->mail_template_id])
                                : null),
                        TextEntry::make('template.key')
                            ->label('Template Key'),
                    ])
                    ->columns(2)
                    ->visible(fn ($record) => $record->mail_template_id !== null),

                Section::make('Tracking Events')
                    ->schema([
                        ViewEntry::make('tracking_events')
                            ->view('filament-mail::components.tracking-events-entry')
                            ->columnSpanFull(),
                    ])
                    ->visible(fn ($record) => $record->trackingEvents()->exists()),
            ]);
    }

    protected static function formatAddresses($state): string
    {
        if (! is_array($state) || empty($state)) {
            return '—';
        }

        return collect($state)
            ->map(function ($address) {
                $email = $address['email'] ?? '';
                $name = $address['name'] ?? '';

                return $name ? "{$name} <{$email}>" : $email;
            })
            ->implode(', ');
    }
}
