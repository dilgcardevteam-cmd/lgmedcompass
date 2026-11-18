<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    @include('lgmed-reports.partials.styles')

    <div class="lr-page">
        <div class="lr-head">
            <h1>1ClickMe</h1>
            @if ($canManage)
                <button type="button" class="lr-btn" data-lr-add><i class="bi bi-plus-lg"></i> Add Report</button>
            @endif
        </div>

        @if (session('success'))
            <div class="lr-flash success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="lr-flash error">{{ session('error') }}</div>
        @endif

        @include('lgmed-reports.partials.listing', ['action' => route('lgmed-reports.index'), 'isPublic' => false])
    </div>

    @if ($canManage)
        @include('lgmed-reports.partials.form-modal')
    @endif
</x-app-layout>
