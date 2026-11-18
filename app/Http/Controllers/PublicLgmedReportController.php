<?php

namespace App\Http\Controllers;

use App\Models\LgmedReport;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Read-only, guest-accessible view of the active LGMED reports.
 */
class PublicLgmedReportController extends Controller
{
    public function index(Request $request): View
    {
        $filters = $request->only(['search', ...LgmedReport::FILTERABLE]);

        $reports = LgmedReport::query()
            ->where('is_active', true)
            ->filter($filters)
            ->orderByRaw('item_no is null')
            ->orderBy('item_no')
            ->orderBy('id')
            ->paginate(15)
            ->withQueryString();

        $filterOptions = [];
        foreach (LgmedReport::FILTERABLE as $column) {
            $filterOptions[$column] = LgmedReport::query()
                ->where('is_active', true)
                ->whereNotNull($column)
                ->where($column, '!=', '')
                ->distinct()
                ->orderBy($column)
                ->pluck($column);
        }

        return view('lgmed-reports.public.index', [
            'reports' => $reports,
            'filters' => $filters,
            'filterOptions' => $filterOptions,
        ]);
    }

    public function show(LgmedReport $lgmedReport): View
    {
        abort_unless($lgmedReport->is_active, 404);

        return view('lgmed-reports.public.show', ['report' => $lgmedReport]);
    }
}
