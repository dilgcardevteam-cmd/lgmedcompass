<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLgmedReportRequest;
use App\Http\Requests\UpdateLgmedReportRequest;
use App\Models\LgmedReport;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class LgmedReportController extends Controller
{
    public function index(Request $request): View
    {
        $filters = $request->only(['search', 'status', ...LgmedReport::FILTERABLE]);

        $reports = LgmedReport::query()
            ->filter($filters)
            ->orderByRaw('item_no is null')
            ->orderBy('item_no')
            ->orderBy('id')
            ->paginate(15)
            ->withQueryString();

        $filterOptions = [];
        foreach (LgmedReport::FILTERABLE as $column) {
            $filterOptions[$column] = LgmedReport::query()
                ->whereNotNull($column)
                ->where($column, '!=', '')
                ->distinct()
                ->orderBy($column)
                ->pluck($column);
        }

        return view('lgmed-reports.index', [
            'reports' => $reports,
            'filters' => $filters,
            'filterOptions' => $filterOptions,
            'canManage' => Gate::allows('create', LgmedReport::class),
            'dropdowns' => LgmedReport::dropdownOptions(),
        ]);
    }

    public function store(StoreLgmedReportRequest $request): RedirectResponse
    {
        $report = new LgmedReport($request->validated());
        $report->is_active = $request->boolean('is_active');
        $report->created_by = $request->user()->id;
        $report->updated_by = $request->user()->id;
        $report->save();

        return redirect()->route('lgmed-reports.index')->with('success', 'Report added successfully.');
    }

    public function show(LgmedReport $lgmedReport): View
    {
        return view('lgmed-reports.show', [
            'report' => $lgmedReport,
            'canManage' => Gate::allows('update', $lgmedReport),
        ]);
    }

    public function update(UpdateLgmedReportRequest $request, LgmedReport $lgmedReport): RedirectResponse
    {
        $lgmedReport->fill($request->validated());
        $lgmedReport->is_active = $request->boolean('is_active');
        $lgmedReport->updated_by = $request->user()->id;
        $lgmedReport->save();

        return redirect()->route('lgmed-reports.index')->with('success', 'Report updated successfully.');
    }

    public function destroy(LgmedReport $lgmedReport): RedirectResponse
    {
        Gate::authorize('delete', $lgmedReport);

        $lgmedReport->delete();

        return redirect()->route('lgmed-reports.index')->with('success', 'Report deleted successfully.');
    }
}
