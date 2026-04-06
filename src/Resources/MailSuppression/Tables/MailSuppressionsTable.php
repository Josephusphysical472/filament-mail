<?php

declare(strict_types=1);

namespace JeffersonGoncalves\FilamentMail\Resources\MailSuppression\Tables;

use Filament\Actions;
use Filament\Tables;
use Filament\Tables\Table;
use JeffersonGoncalves\LaravelMail\Enums\SuppressionReason;
use JeffersonGoncalves\LaravelMail\Models\MailSuppression;

class MailSuppressionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->copyable(),

                Tables\Columns\TextColumn::make('reason')
                    ->badge()
                    ->color(fn (SuppressionReason $state): string => match ($state) {
                        SuppressionReason::HardBounce => 'danger',
                        SuppressionReason::Complaint => 'warning',
                        SuppressionReason::Manual => 'gray',
                    })
                    ->formatStateUsing(fn (SuppressionReason $state): string => match ($state) {
                        SuppressionReason::HardBounce => 'Hard Bounce',
                        SuppressionReason::Complaint => 'Complaint',
                        SuppressionReason::Manual => 'Manual',
                    }),

                Tables\Columns\TextColumn::make('provider')
                    ->badge()
                    ->color('info')
                    ->placeholder('—'),

                Tables\Columns\TextColumn::make('suppressed_at')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('mailLog.subject')
                    ->label('Related Email')
                    ->limit(30)
                    ->placeholder('—')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('reason')
                    ->options(collect(SuppressionReason::cases())->mapWithKeys(
                        fn (SuppressionReason $reason) => [$reason->value => match ($reason) {
                            SuppressionReason::HardBounce => 'Hard Bounce',
                            SuppressionReason::Complaint => 'Complaint',
                            SuppressionReason::Manual => 'Manual',
                        }]
                    )->all()),

                Tables\Filters\SelectFilter::make('provider')
                    ->options(fn () => config('laravel-mail.models.mail_suppression', MailSuppression::class)::query()
                        ->whereNotNull('provider')
                        ->distinct()
                        ->pluck('provider', 'provider')
                        ->all()),
            ])
            ->recordActions([
                Actions\DeleteAction::make()
                    ->label('Unsuppress'),
            ])
            ->toolbarActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make()
                        ->label('Unsuppress Selected'),
                ]),
            ])
            ->defaultSort('suppressed_at', 'desc');
    }
}
