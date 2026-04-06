@php
    $versions = $getRecord()->versions()->orderBy('version_number', 'desc')->get();
@endphp

<div>
    @if($versions->isNotEmpty())
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-gray-500 uppercase bg-gray-50 dark:bg-gray-800 dark:text-gray-400">
                    <tr>
                        <th class="px-4 py-2">Version</th>
                        <th class="px-4 py-2">Change Note</th>
                        <th class="px-4 py-2">Author</th>
                        <th class="px-4 py-2">Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($versions as $version)
                        <tr class="border-b dark:border-gray-700">
                            <td class="px-4 py-2">
                                <x-filament::badge color="gray">
                                    v{{ $version->version_number }}
                                </x-filament::badge>
                            </td>
                            <td class="px-4 py-2">{{ $version->change_note ?? '—' }}</td>
                            <td class="px-4 py-2">{{ $version->author ?? '—' }}</td>
                            <td class="px-4 py-2">{{ $version->created_at?->format('Y-m-d H:i:s') ?? '—' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-sm text-gray-500 dark:text-gray-400 italic">No version history.</p>
    @endif
</div>
