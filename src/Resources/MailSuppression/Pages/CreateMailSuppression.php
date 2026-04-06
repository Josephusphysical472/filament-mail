<?php

declare(strict_types=1);

namespace JeffersonGoncalves\FilamentMail\Resources\MailSuppression\Pages;

use Filament\Resources\Pages\CreateRecord;
use JeffersonGoncalves\FilamentMail\Resources\MailSuppression\MailSuppressionResource;

class CreateMailSuppression extends CreateRecord
{
    protected static string $resource = MailSuppressionResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['suppressed_at'] = now();

        return $data;
    }
}
