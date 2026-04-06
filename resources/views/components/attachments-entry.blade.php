@php
    $attachments = $getRecord()->attachments ?? [];
@endphp

<div>
    @if(count($attachments) > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-gray-500 uppercase bg-gray-50 dark:bg-gray-800 dark:text-gray-400">
                    <tr>
                        <th class="px-4 py-2">Filename</th>
                        <th class="px-4 py-2">Content Type</th>
                        <th class="px-4 py-2">Size</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attachments as $attachment)
                        <tr class="border-b dark:border-gray-700">
                            <td class="px-4 py-2 font-medium">{{ $attachment['filename'] ?? 'Unknown' }}</td>
                            <td class="px-4 py-2">{{ $attachment['content_type'] ?? '—' }}</td>
                            <td class="px-4 py-2">
                                @if(isset($attachment['size']))
                                    {{ number_format($attachment['size'] / 1024, 1) }} KB
                                @else
                                    —
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                @if(isset($attachment['path']) && isset($attachment['disk']))
                                    <a href="{{ Storage::disk($attachment['disk'])->url($attachment['path']) }}"
                                       target="_blank"
                                       class="text-primary-600 hover:text-primary-500 dark:text-primary-400">
                                        Download
                                    </a>
                                @else
                                    <span class="text-gray-400">—</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-sm text-gray-500 dark:text-gray-400 italic">No attachments.</p>
    @endif
</div>
