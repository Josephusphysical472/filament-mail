<div class="space-y-4">
    @if($subject ?? null)
        <div class="text-sm font-medium text-gray-700 dark:text-gray-300">
            <strong>Subject:</strong> {{ $subject }}
        </div>
    @endif

    @if($html ?? null)
        <iframe
            srcdoc="{{ e($html) }}"
            class="w-full border rounded-lg bg-white"
            style="min-height: 600px; max-width: {{ config('filament-mail.preview.max_width', '800px') }};"
            @if(config('filament-mail.preview.sandbox', true))
                sandbox="allow-same-origin"
            @endif
        ></iframe>
    @else
        <p class="text-sm text-gray-500 dark:text-gray-400 italic">No HTML content available.</p>
    @endif
</div>
