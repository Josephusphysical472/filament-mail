<?php

declare(strict_types=1);

namespace JeffersonGoncalves\FilamentMail\Resources\MailTemplate\Pages;

use Filament\Resources\Pages\ViewRecord;
use JeffersonGoncalves\FilamentMail\Resources\MailTemplate\MailTemplateResource;

class ViewMailTemplate extends ViewRecord
{
    protected static string $resource = MailTemplateResource::class;
}
