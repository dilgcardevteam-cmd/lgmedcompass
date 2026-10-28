<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePpaProjectRequest;
use App\Models\PpaProject;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PpaProjectController extends Controller
{
    private const SECTIONS = [
        'lgrpcs' => 'Local Government Relations & Policy Compliance Section',
        'lgpmras' => 'Local Government Performance Management, Recognition, and Awards Section',
        'lgpopscm' => 'Local Government Peace & Order and Public Safety Compliance and Monitoring',
        'ssu' => 'Support Services Unit',
        'dsu' => 'Database & Statistical Unit',
        'qms' => 'Quality Management System',
    ];

    public function index(): View
    {
        $sections = collect(self::SECTIONS)->map(
            fn (string $name, string $code): object => (object) ['code' => $code, 'name' => $name]
        );

        return view('ppa.index', compact('sections'));
    }

    public function showSection(string $sectionCode): View
    {
        abort_unless(isset(self::SECTIONS[$sectionCode]), 404);

        $sectionDisplay = (object) [
            'code' => $sectionCode,
            'name' => self::SECTIONS[$sectionCode],
        ];
        $projects = PpaProject::query()
            ->where('section_code', $sectionCode)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();
        $allowProjectEditing = auth()->user()?->role === 'Admin';

        return view('ppa.ppa-drive', compact('sectionCode', 'sectionDisplay', 'projects', 'allowProjectEditing'));
    }

    public function landingPage(string $sectionCode): View
    {
        abort_unless(isset(self::SECTIONS[$sectionCode]), 404);

        $projects = PpaProject::query()
            ->where('section_code', $sectionCode)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view("landingpage.lp-{$sectionCode}", compact('projects'));
    }

    public function updateProject(UpdatePpaProjectRequest $request, PpaProject $project): RedirectResponse
    {
        $project->update($request->validated());

        return redirect()
            ->route('ppa.section', $project->section_code)
            ->with('success', 'Project details updated successfully.');
    }
}
