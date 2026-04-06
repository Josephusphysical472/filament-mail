@php
    $variables = $getRecord()->variables ?? [];
@endphp

<div>
    @if(count($variables) > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-gray-500 uppercase bg-gray-50 dark:bg-gray-800 dark:text-gray-400">
                    <tr>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Type</th>
                        <th class="px-4 py-2">Example</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($variables as $variable)
                        <tr class="border-b dark:border-gray-700">
                            <td class="px-4 py-2 font-mono text-sm">{{ '{{ $' . ($variable['name'] ?? '') . ' }}' }}</td>
                            <td class="px-4 py-2">
                                <x-filament::badge color="gray">
                                    {{ $variable['type'] ?? 'string' }}
                                </x-filament::badge>
                            </td>
                            <td class="px-4 py-2 text-gray-500">{{ $variable['example'] ?? '—' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-sm text-gray-500 dark:text-gray-400 italic">No variables defined.</p>
    @endif
</div>
