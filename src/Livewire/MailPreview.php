<?php

declare(strict_types=1);

namespace JeffersonGoncalves\FilamentMail\Livewire;

use Livewire\Component;

class MailPreview extends Component
{
    public string $html = '';

    public string $subject = '';

    public function render()
    {
        return view('filament-mail::livewire.mail-preview');
    }
}
