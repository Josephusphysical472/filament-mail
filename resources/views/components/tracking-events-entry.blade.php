@php
    $events = $getRecord()->trackingEvents()->orderBy('occurred_at', 'desc')->get();
@endphp

<div>
    @if($events->isNotEmpty())
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-gray-500 uppercase bg-gray-50 dark:bg-gray-800 dark:text-gray-400">
                    <tr>
                        <th class="px-4 py-2">Type</th>
                        <th class="px-4 py-2">Provider</th>
                        <th class="px-4 py-2">Recipient</th>
                        <th class="px-4 py-2">Bounce Type</th>
                        <th class="px-4 py-2">URL</th>
                        <th class="px-4 py-2">Occurred At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                        <tr class="border-b dark:border-gray-700">
                            <td class="px-4 py-2">
                                @php
                                    $typeColor = match($event->type->value) {
                                        'delivered' => 'success',
                                        'bounced' => 'danger',
                                        'opened' => 'info',
                                        'clicked' => 'primary',
                                        'complained' => 'warning',
                                        'deferred' => 'gray',
                                        default => 'gray',
                                    };
                                @endphp
                                <x-filament::badge :color="$typeColor">
                                    {{ ucfirst($event->type->value) }}
                                </x-filament::badge>
                            </td>
                            <td class="px-4 py-2">
                                <x-filament::badge color="info">
                                    {{ ucfirst($event->provider->value) }}
                                </x-filament::badge>
                            </td>
                            <td class="px-4 py-2">{{ $event->recipient ?? '—' }}</td>
                            <td class="px-4 py-2">{{ $event->bounce_type ?? '—' }}</td>
                            <td class="px-4 py-2">
                                @if($event->url)
                                    <a href="{{ $event->url }}" target="_blank" class="text-primary-600 hover:underline" title="{{ $event->url }}">
                                        {{ Str::limit($event->url, 30) }}
                                    </a>
                                @else
                                    —
                                @endif
                            </td>
                            <td class="px-4 py-2">{{ $event->occurred_at?->format('Y-m-d H:i:s') ?? '—' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-sm text-gray-500 dark:text-gray-400 italic">No tracking events recorded.</p>
    @endif
</div>
