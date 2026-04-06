<?php

declare(strict_types=1);

namespace JeffersonGoncalves\FilamentMail\Resources\MailLog\Pages;

use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentMail\Resources\MailLog\MailLogResource;

class ListMailLogs extends ListRecords
{
    protected static string $resource = MailLogResource::class;
}
