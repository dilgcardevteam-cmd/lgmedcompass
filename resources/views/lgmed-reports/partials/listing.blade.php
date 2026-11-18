@php
    $isPublic = $isPublic ?? false;
    $canManage = ! $isPublic && ($canManage ?? false);
    $filterLabels = [
        'section' => 'Section',
        'frequency' => 'Frequency',
        'ppa_category' => 'PPA Category',
        'end_user_level' => 'End User Level',
    ];
    $columnCount = $isPublic ? 13 : 15;
@endphp
<div class="lr-card">
    <form method="GET" action="{{ $action }}" class="lr-filters">
        <div class="lr-search">
            <label for="search">Search</label>
            <input type="search" id="search" name="search" value="{{ $filters['search'] ?? '' }}" placeholder="PPA, focal person, remarks, legal basis…">
        </div>
        @foreach ($filterLabels as $column => $label)
            <div>
                <label for="{{ $column }}">{{ $label }}</label>
                <select id="{{ $column }}" name="{{ $column }}">
                    <option value="">All</option>
                    @foreach ($filterOptions[$column] as $option)
                        <option value="{{ $option }}" @selected(($filters[$column] ?? '') === $option)>{{ $option }}</option>
                    @endforeach
                </select>
            </div>
        @endforeach
        @unless ($isPublic)
            <div>
                <label for="status">Status</label>
                <select id="status" name="status">
                    <option value="">All</option>
                    <option value="active" @selected(($filters['status'] ?? '') === 'active')>Active</option>
                    <option value="inactive" @selected(($filters['status'] ?? '') === 'inactive')>Inactive</option>
                </select>
            </div>
        @endunless
        <button type="submit" class="lr-btn"><i class="bi bi-search"></i> Apply</button>
        <a href="{{ $action }}" class="lr-btn secondary">Reset</a>
    </form>

    <div class="lr-table-wrap">
        <table class="lr-table" @if ($isPublic) style="min-width: 2470px;" @endif>
            <colgroup>
                <col style="width:70px">
                <col style="width:380px">
                <col style="width:130px">
                <col style="width:220px">
                <col style="width:260px">
                <col style="width:260px">
                <col style="width:200px">
                <col style="width:220px">
                <col style="width:240px">
                <col style="width:150px">
                <col style="width:240px">
                <col style="width:200px">
                <col style="width:240px">
                @unless ($isPublic)
                    <col style="width:100px">
                @endunless
                <col style="width:{{ $isPublic ? 120 : 230 }}px">
            </colgroup>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>PPA</th>
                    <th>Frequency</th>
                    <th>Timelines (Report Submission to RO)</th>
                    <th>Focal Person</th>
                    <th>Section</th>
                    <th>Mode of Submission</th>
                    <th>Monitoring Link</th>
                    <th>End User Level</th>
                    <th>PPA Category</th>
                    <th>Legal Basis/ Reference</th>
                    <th>Reference Link</th>
                    <th>Remarks</th>
                    @unless ($isPublic)
                        <th>Status</th>
                    @endunless
                    <th>{{ $isPublic ? 'Details' : 'Actions' }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reports as $report)
                    <tr>
                        <td>{{ $report->item_no }}</td>
                        <td>{{ $report->ppa }}</td>
                        <td>{{ $report->frequency }}</td>
                        <td>{{ $report->timelines }}</td>
                        <td>{{ $report->focal_person }}</td>
                        <td>{{ $report->section }}</td>
                        <td>{{ $report->mode_of_submission }}</td>
                        <td>@include('lgmed-reports.partials.link', ['value' => $report->monitoring_link])</td>
                        <td>{{ $report->end_user_level }}</td>
                        <td>{{ $report->ppa_category }}</td>
                        <td>{{ $report->legal_basis_reference }}</td>
                        <td>@include('lgmed-reports.partials.link', ['value' => $report->reference_link])</td>
                        <td>{{ $report->remarks }}</td>
                        @unless ($isPublic)
                            <td><span class="lr-badge {{ $report->is_active ? '' : 'off' }}">{{ $report->is_active ? 'Active' : 'Inactive' }}</span></td>
                        @endunless
                        <td class="lr-actions">
                            <a href="{{ $isPublic ? route('public.lgmed-reports.show', $report) : route('lgmed-reports.show', $report) }}" class="lr-btn secondary sm">View</a>
                            @if ($canManage)
                                <button type="button" class="lr-btn sm" data-lr-edit="{{ $report->id }}" data-report="{{ json_encode($report->only([...\App\Models\LgmedReport::SEARCHABLE, 'item_no', 'end_user_level', 'reference_link', 'is_active'])) }}">Edit</button>
                                <button type="button" class="lr-btn danger sm" data-lr-delete="{{ route('lgmed-reports.destroy', $report) }}" data-name="{{ \Illuminate\Support\Str::limit($report->ppa, 80) }}">Delete</button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ $columnCount }}" class="lr-empty">No reports found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 1rem;">
        {{ $reports->links('pagination::tailwind') }}
    </div>
</div>
