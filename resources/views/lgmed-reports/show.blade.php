<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    @include('lgmed-reports.partials.styles')

    @include('lgmed-reports.partials.detail', ['backUrl' => route('lgmed-reports.index'), 'isPublic' => false])
</x-app-layout>
