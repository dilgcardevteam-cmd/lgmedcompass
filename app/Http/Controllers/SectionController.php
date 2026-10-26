<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:sections,name',
            'color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
        ]);

        $section = Section::create($validated);

        return response()->json([
            'message' => 'Section created successfully.',
            'section' => $section,
        ]);
    }

    public function update(Request $request, Section $section)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:sections,name,'.$section->id,
            'color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
        ]);

        $section->update($validated);

        return response()->json([
            'message' => 'Section updated successfully.',
            'section' => $section,
        ]);
    }

    public function destroy(Section $section)
    {
        if ($section->is_protected) {
            return response()->json([
                'message' => 'Protected sections cannot be deleted.',
            ], 403);
        }

        if ($section->users()->exists()) {
            return response()->json([
                'message' => 'Cannot delete section with users assigned.',
            ], 422);
        }

        $section->delete();

        return response()->json([
            'message' => 'Section deleted successfully.',
        ]);
    }
}
