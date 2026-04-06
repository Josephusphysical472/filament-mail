<div>
    @if($subject)
        <div class="mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
            {{ $subject }}
        </div>
    @endif

    @if($html)
        <iframe
            srcdoc="{{ e($html) }}"
            class="w-full border rounded-lg bg-white"
            style="min-height: 400px; max-width: {{ config('filament-mail.preview.max_width', '800px') }};"
            @if(config('filament-mail.preview.sandbox', true))
                sandbox="allow-same-origin"
            @endif
        ></iframe>
    @else
        <div class="text-sm text-gray-500 dark:text-gray-400 italic">
            No HTML content available.
        </div>
    @endif
</div>
