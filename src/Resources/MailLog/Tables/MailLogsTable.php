<?php

declare(strict_types=1);

namespace JeffersonGoncalves\FilamentMail\Resources\MailLog\Tables;

use Filament\Actions;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Table;
use JeffersonGoncalves\LaravelMail\Enums\MailStatus;
use JeffersonGoncalves\LaravelMail\Models\MailLog;

class MailLogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (MailStatus $state): string => match ($state) {
                        MailStatus::Pending => 'gray',
                        MailStatus::Sent => 'info',
                        MailStatus::Delivered => 'success',
                        MailStatus::Bounced => 'danger',
                        MailStatus::Complained => 'warning',
                        MailStatus::Failed => 'danger',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('subject')
                    ->searchable()
                    ->limit(50)
                    ->weight(FontWeight::Medium),

                Tables\Columns\TextColumn::make('to')
                    ->label('To')
                    ->formatStateUsing(function ($state): string {
                        if (is_array($state) && count($state) > 0) {
                            return $state[0]['email'] ?? '';
                        }

                        return '';
                    })
                    ->searchable(query: function ($query, string $search) {
                        $query->where('to', 'like', "%{$search}%");
                    })
                    ->limit(30),

                Tables\Columns\TextColumn::make('mailer')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('template.name')
                    ->label('Template')
                    ->toggleable()
                    ->placeholder('—'),

                Tables\Columns\TextColumn::make('attachments')
                    ->label('Attachments')
                    ->formatStateUsing(fn ($state): string => is_array($state) ? (string) count($state) : '0')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(collect(MailStatus::cases())->mapWithKeys(
                        fn (MailStatus $status) => [$status->value => ucfirst($status->value)]
                    )->all()),

                Tables\Filters\SelectFilter::make('mailer')
                    ->options(fn () => config('laravel-mail.models.mail_log', MailLog::class)::query()
                        ->whereNotNull('mailer')
                        ->distinct()
                        ->pluck('mailer', 'mailer')
                        ->all()),

                Tables\Filters\TernaryFilter::make('has_attachments')
                    ->label('Has Attachments')
                    ->queries(
                        true: fn ($query) => $query->whereRaw('json_array_length(attachments) > 0'),
                        false: fn ($query) => $query->where(function ($q) {
                            $q->whereNull('attachments')
                                ->orWhereRaw('json_array_length(attachments) = 0');
                        }),
                    ),
            ])
            ->recordActions([
                Actions\ViewAction::make(),
            ])
            ->toolbarActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
