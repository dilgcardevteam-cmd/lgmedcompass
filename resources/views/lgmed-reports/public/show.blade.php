<x-guest-layout>
    <title>DILG - 1ClickMe Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    @include('lgmed-reports.partials.styles')

    <div style="background: linear-gradient(160deg, #fdfcf0 0%, #fef9c3 100%); min-height: 100vh; padding: 7rem 0 3rem;">
        @include('lgmed-reports.partials.detail', ['backUrl' => route('public.lgmed-reports.index'), 'isPublic' => true])
    </div>
</x-guest-layout>
