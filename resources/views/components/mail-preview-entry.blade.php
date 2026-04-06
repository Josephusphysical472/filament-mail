@php
    $html = $getRecord()->html_body;
@endphp

<div>
    @if($html)
        <iframe
            srcdoc="{{ e($html) }}"
            class="w-full border rounded-lg bg-white"
            style="min-height: 500px; max-width: {{ config('filament-mail.preview.max_width', '800px') }};"
            @if(config('filament-mail.preview.sandbox', true))
                sandbox="allow-same-origin"
            @endif
        ></iframe>
    @else
        <p class="text-sm text-gray-500 dark:text-gray-400 italic">No HTML content available.</p>
    @endif
</div>
