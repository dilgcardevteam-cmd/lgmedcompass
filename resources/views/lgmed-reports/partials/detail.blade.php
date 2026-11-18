@php
    $isPublic = $isPublic ?? false;
    $sections = [
        'Schedule' => [
            'frequency' => 'Frequency',
            'timelines' => 'Timelines (Report Submission to RO)',
        ],
        'Responsible persons & section' => [
            'section' => 'Section',
            'focal_person' => 'Focal Person',
        ],
        'Submission' => [
            'mode_of_submission' => 'Mode of Submission',
            'monitoring_link' => 'Monitoring Link',
        ],
        'Classification & references' => [
            'end_user_level' => 'End User Level',
            'ppa_category' => 'PPA Category',
            'legal_basis_reference' => 'Legal Basis/ Reference',
            'reference_link' => 'Reference Link',
        ],
    ];
    $linkFields = ['monitoring_link', 'reference_link'];
    $wideFields = ['timelines', 'section', 'focal_person', 'mode_of_submission', 'monitoring_link', 'legal_basis_reference', 'reference_link'];
@endphp
<div class="lr-page" style="max-width: 1100px; margin: 0 auto;">
    <div class="lr-head">
        <a href="{{ $backUrl }}" class="lr-btn secondary"><i class="bi bi-arrow-left"></i> Back to list</a>
    </div>

    <div class="lr-detail-hero">
        <div class="lr-detail-tags">
            @if (filled($report->item_no))
                <span class="lr-tag">No. {{ $report->item_no }}</span>
            @endif
            @unless ($isPublic)
                <span class="lr-badge {{ $report->is_active ? '' : 'off' }}">{{ $report->is_active ? 'Active' : 'Inactive' }}</span>
            @endunless
            @if (filled($report->ppa_category))
                <span class="lr-tag">{{ $report->ppa_category }}</span>
            @endif
            @if (filled($report->frequency))
                <span class="lr-tag"><i class="bi bi-arrow-repeat"></i> {{ $report->frequency }}</span>
            @endif
        </div>
        <div class="lr-detail-label">PPA</div>
        <h1 class="lr-detail-title">{{ $report->ppa }}</h1>
    </div>

    @foreach ($sections as $title => $fields)
        <div class="lr-card lr-detail-section">
            <h2 class="lr-detail-heading">{{ $title }}</h2>
            <div class="lr-detail-grid">
                @foreach ($fields as $name => $label)
                    <div class="lr-detail-item {{ in_array($name, $wideFields, true) ? 'wide' : '' }}">
                        <div class="lr-detail-label">{{ $label }}</div>
                        <div class="lr-detail-value">
                            @if (! filled($report->$name))
                                <span class="lr-muted">—</span>
                            @elseif ($name === 'focal_person')
                                <div class="lr-chips">
                                    @foreach (preg_split('/\r?\n/', $report->focal_person, -1, PREG_SPLIT_NO_EMPTY) as $person)
                                        <span class="lr-chip"><i class="bi bi-person-fill"></i> {{ trim($person) }}</span>
                                    @endforeach
                                </div>
                            @elseif (in_array($name, $linkFields, true))
                                @include('lgmed-reports.partials.link', ['value' => $report->$name])
                            @else<span class="lr-pre">{{ $report->$name }}</span>@endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach

    <div class="lr-card lr-detail-section">
        <h2 class="lr-detail-heading">Remarks</h2>
        <div class="lr-detail-value">@if (filled($report->remarks))<span class="lr-pre">{{ $report->remarks }}</span>@else<span class="lr-muted">—</span>@endif</div>
    </div>
</div>
