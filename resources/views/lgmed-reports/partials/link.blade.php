@php
    $text = trim((string) ($value ?? ''));
    $isUrl = $text !== '' && preg_match('#^https?://\S+$#i', $text);
@endphp
@if ($isUrl)<a href="{{ $text }}" target="_blank" rel="noopener noreferrer" style="color:#b45309;text-decoration:underline;">{{ $text }}</a>@else{{ $text }}@endif