<?php

declare(strict_types=1);

namespace JeffersonGoncalves\FilamentMail\Resources\MailSuppression\Schemas;

use Filament\Forms;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use JeffersonGoncalves\LaravelMail\Enums\SuppressionReason;

class MailSuppressionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(null)
            ->components([
                Section::make()
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('reason')
                            ->options(collect(SuppressionReason::cases())->mapWithKeys(
                                fn (SuppressionReason $reason) => [$reason->value => match ($reason) {
                                    SuppressionReason::HardBounce => 'Hard Bounce',
                                    SuppressionReason::Complaint => 'Complaint',
                                    SuppressionReason::Manual => 'Manual',
                                }]
                            )->all())
                            ->default(SuppressionReason::Manual->value)
                            ->required(),
                    ]),
            ]);
    }
}
