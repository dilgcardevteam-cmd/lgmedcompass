<x-guest-layout>
    <title>DILG - 1ClickMe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    @include('lgmed-reports.partials.styles')

    <div style="background: linear-gradient(160deg, #fdfcf0 0%, #fef9c3 100%); min-height: 100vh; padding: 7rem 0 3rem;">
        <div class="lr-page" style="max-width: 1400px; margin: 0 auto;">
            <div class="lr-head">
                <div>
                    <h1>1ClickMe</h1>
                    <p style="margin: .25rem 0 0; color: #6b7280; font-size: .9rem;">Reports required from the Local Governance Monitoring and Evaluation Division. View only.</p>
                </div>
            </div>

            @include('lgmed-reports.partials.listing', ['action' => route('public.lgmed-reports.index'), 'isPublic' => true])
        </div>
    </div>
</x-guest-layout>
