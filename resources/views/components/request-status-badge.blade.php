@props(['status'])

@php
    $statusClasses = match ($status) {
        \App\Models\ServiceRequest::STATUS_RECEIVED => 'bg-sky-100 text-sky-800 ring-sky-200',
        \App\Models\ServiceRequest::STATUS_UNDER_REVIEW => 'bg-blue-100 text-blue-800 ring-blue-200',
        \App\Models\ServiceRequest::STATUS_MORE_INFORMATION_NEEDED => 'bg-amber-100 text-amber-900 ring-amber-200',
        \App\Models\ServiceRequest::STATUS_COMPLETED => 'bg-green-100 text-green-800 ring-green-200',
        \App\Models\ServiceRequest::STATUS_DECLINED => 'bg-red-100 text-red-800 ring-red-200',
        default => 'bg-gray-100 text-gray-800 ring-gray-200',
    };
@endphp

<span {{ $attributes->class(["inline-flex items-center rounded-full px-3 py-1 text-xs font-bold ring-1 ring-inset {$statusClasses}"]) }}>
    {{ $status }}
</span>
