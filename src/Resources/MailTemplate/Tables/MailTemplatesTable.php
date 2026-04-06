<?php

declare(strict_types=1);

namespace JeffersonGoncalves\FilamentMail\Resources\MailTemplate\Tables;

use Filament\Actions;
use Filament\Tables;
use Filament\Tables\Table;

class MailTemplatesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->searchable()
                    ->sortable()
                    ->copyable(),

                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Active'),

                Tables\Columns\TextColumn::make('subject')
                    ->label('Locales')
                    ->formatStateUsing(function ($record): string {
                        $translations = $record->getTranslations('subject');

                        return collect(array_keys($translations))->implode(', ');
                    })
                    ->badge(),

                Tables\Columns\TextColumn::make('versions_count')
                    ->counts('versions')
                    ->label('Versions')
                    ->sortable(),

                Tables\Columns\TextColumn::make('logs_count')
                    ->counts('logs')
                    ->label('Emails Sent')
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active'),
            ])
            ->recordActions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->toolbarActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('updated_at', 'desc');
    }
}
