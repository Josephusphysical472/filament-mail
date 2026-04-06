<?php

declare(strict_types=1);

namespace JeffersonGoncalves\FilamentMail\Resources\MailSuppression\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentMail\Resources\MailSuppression\MailSuppressionResource;

class ListMailSuppressions extends ListRecords
{
    protected static string $resource = MailSuppressionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Add Suppression'),
        ];
    }
}
