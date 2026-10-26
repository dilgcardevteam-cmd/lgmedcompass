<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\SectionFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PpaController extends Controller
{
    /**
     * Map section codes (from URL) to division IDs.
     * Adjust these IDs to match your actual divisions.
     */
    private function getDivisionIdFromSectionCode($code)
    {
        $map = [
            'lgrpcs' => 1,   // matches division id 1
            'lgpmras' => 2,   // matches division id 2
            'lgpopscm' => 3,   // matches division id 3
            'ssu' => 4,   // matches division id 4
            'dsu' => 5,   // matches division id 5
        ];

        return $map[$code] ?? null;
    }

    // GET /ppa/folders/{section}/{parentId?}
    public function folders($sectionCode, $parentId = null)
    {
        $divisionId = $this->getDivisionIdFromSectionCode($sectionCode);
        if (! $divisionId) {
            return response()->json(['error' => 'Invalid section'], 404);
        }

        $query = SectionFile::where('division_id', $divisionId)
            ->where('type', 'folder');

        if ($parentId) {
            $query->where('parent_id', $parentId);
        } else {
            $query->whereNull('parent_id');
        }
        $folders = $query->get();

        // Get files (and links) inside the current folder
        $files = [];
        if ($parentId) {
            $files = SectionFile::where('parent_id', $parentId)
                ->whereIn('type', ['file', 'link'])
                ->with('user')
                ->get()
                ->map(function ($item) {
                    if ($item->type === 'file' && $item->file_path) {
                        $item->url = route('ppa.file.view', $item->id);
                        $fullPath = storage_path('app/public/'.$item->file_path);
                        $item->size_in_kb = file_exists($fullPath) ? round(filesize($fullPath) / 1024, 2) : null;
                    } else {
                        $item->size_in_kb = null;
                    }
                    $item->uploaded_by_name = $item->user?->name;
                    $item->updated_at_formatted = $item->updated_at?->format('Y-m-d H:i:s');

                    return $item;
                });
        }

        return response()->json([
            'folders' => $folders,
            'files' => $files,
        ]);
    }

    // GET /ppa/folders-list/{divisionId}
    public function getFoldersByDivision($divisionId)
    {
        \Log::info('getFoldersByDivision called with division: '.$divisionId);
        $folders = SectionFile::where('division_id', $divisionId)
            ->where('type', 'folder')
            ->whereNull('parent_id')
            ->select('id', 'name')
            ->get();

        return response()->json(['folders' => $folders]);
    }

    // PUT /ppa/move/{type}/{id}
    public function moveItem(Request $request, $type, $id)
    {
        // Only admin and employee can move items
        if (! in_array(auth()->user()->role, ['Admin', 'Employee'])) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'division_id' => 'required|integer|min:1|max:5',
            'new_parent_id' => 'nullable|integer|exists:section_files,id',
        ]);

        if ($type === 'folder') {
            $item = SectionFile::findOrFail($id);
            if ($item->type !== 'folder') {
                return response()->json(['error' => 'Item is not a folder'], 400);
            }
        } elseif ($type === 'file') {
            $item = SectionFile::findOrFail($id);
            if (! in_array($item->type, ['file', 'link'])) {
                return response()->json(['error' => 'Item is not a file or link'], 400);
            }
        } else {
            return response()->json(['error' => 'Invalid item type'], 400);
        }

        // Prevent moving a folder into itself or its own descendant
        if ($type === 'folder' && $validated['new_parent_id']) {
            if ($validated['new_parent_id'] == $item->id) {
                return response()->json(['error' => 'Cannot move a folder into itself'], 400);
            }
            if ($this->isDescendant($item->id, $validated['new_parent_id'])) {
                return response()->json(['error' => 'Cannot move a folder into its own subfolder'], 400);
            }
        }

        // If moving to a folder, ensure that folder belongs to the target division
        if ($validated['new_parent_id']) {
            $parentFolder = SectionFile::find($validated['new_parent_id']);
            if (! $parentFolder || $parentFolder->division_id != $validated['division_id']) {
                return response()->json(['error' => 'The selected folder does not belong to the target division'], 400);
            }
        }

        // Start transaction to ensure data integrity
        DB::beginTransaction();
        try {
            $oldDivisionId = $item->division_id;
            $newDivisionId = $validated['division_id'];

            // Move the item itself
            $item->division_id = $newDivisionId;
            $item->parent_id = $validated['new_parent_id'];
            $item->save();

            // If it's a folder and the division changed, update all descendants
            if ($type === 'folder' && $oldDivisionId != $newDivisionId) {
                $this->updateChildrenDivision($item, $newDivisionId);
            }

            DB::commit();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => 'Failed to move item: '.$e->getMessage()], 500);
        }
    }

    /**
     * Recursively update division_id for all children of a folder.
     *
     * @param  SectionFile  $folder
     * @param  int  $newDivisionId
     */
    private function updateChildrenDivision($folder, $newDivisionId)
    {
        $children = SectionFile::where('parent_id', $folder->id)->get();
        foreach ($children as $child) {
            $child->division_id = $newDivisionId;
            $child->save();

            if ($child->type === 'folder') {
                $this->updateChildrenDivision($child, $newDivisionId);
            }
        }
    }

    /**
     * Helper to check if a folder is a descendant of another folder.
     */
    private function isDescendant($folderId, $potentialDescendantId)
    {
        $current = SectionFile::find($potentialDescendantId);
        while ($current && $current->parent_id) {
            if ($current->parent_id == $folderId) {
                return true;
            }
            $current = SectionFile::find($current->parent_id);
        }

        return false;
    }

    // POST /ppa/folder
    public function createFolder(Request $request)
    {
        $request->validate([
            'section' => 'required|string',
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:section_files,id',
        ]);

        $divisionId = $this->getDivisionIdFromSectionCode($request->section);
        if (! $divisionId) {
            return response()->json(['error' => 'Invalid section'], 404);
        }

        $folder = SectionFile::create([
            'division_id' => $divisionId,
            'name' => $request->name,
            'type' => 'folder',
            'parent_id' => $request->parent_id,
            'user_id' => auth()->id(),
        ]);

        return response()->json($folder);
    }

    // POST /ppa/upload
    public function uploadFile(Request $request)
    {
        $request->validate([
            'section' => 'required|string',
            'parent_id' => 'nullable|integer|exists:section_files,id',
            'files' => 'required|array',
            'files.*' => 'file|max:51200',
        ]);

        $divisionId = $this->getDivisionIdFromSectionCode($request->section);
        if (! $divisionId) {
            return response()->json(['error' => 'Invalid section'], 404);
        }

        $uploaded = [];
        foreach ($request->file('files') as $file) {
            $path = $file->store("ppa/{$request->section}", 'public');
            $ppaFile = SectionFile::create([
                'division_id' => $divisionId,
                'parent_id' => $request->parent_id ?: null,
                'name' => $file->getClientOriginalName(),
                'type' => 'file',
                'file_path' => $path,
                'user_id' => auth()->id(),
            ]);
            $uploaded[] = [
                'id' => $ppaFile->id,
                'name' => $ppaFile->name,
                'url' => asset('storage/'.$path),
            ];
        }

        return response()->json(['success' => true, 'files' => $uploaded]);
    }

    // POST /ppa/link
    public function addLink(Request $request)
    {
        $request->validate([
            'section' => 'required|string',
            'parent_id' => 'nullable|integer|exists:section_files,id',
            'name' => 'required|string|max:255',
            'url' => 'required|url',
        ]);

        $divisionId = $this->getDivisionIdFromSectionCode($request->section);
        if (! $divisionId) {
            return response()->json(['error' => 'Invalid section'], 404);
        }

        $link = SectionFile::create([
            'division_id' => $divisionId,
            'parent_id' => $request->parent_id ?: null,
            'name' => $request->name,
            'type' => 'link',
            'url' => $request->url,
            'user_id' => auth()->id(),
        ]);

        return response()->json($link);
    }

    // PUT /ppa/folder/{id}
    public function renameFolder(Request $request, $id)
    {
        if (! in_array(auth()->user()->role, ['Admin', 'Employee'])) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $request->validate(['name' => 'required|string|max:255']);
        $folder = SectionFile::findOrFail($id);
        $folder->name = $request->name;
        $folder->save();

        return response()->json(['success' => true]);
    }

    // PUT /ppa/file/{id}
    public function renameFile(Request $request, $id)
    {
        // Allow both Admin and Employee
        if (! in_array(auth()->user()->role, ['Admin', 'Employee'])) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate(['name' => 'required|string|max:255']);
        $file = SectionFile::findOrFail($id);
        $file->name = $request->name;
        $file->save();

        return response()->json(['success' => true]);
    }

    // DELETE /ppa/file/{id}
    public function deleteFile($id)
    {
        if (auth()->user()->role !== 'Admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $file = SectionFile::findOrFail($id);
        if ($file->type === 'file' && $file->file_path) {
            Storage::disk('public')->delete($file->file_path);
        }
        $file->delete();

        return response()->json(['success' => true]);
    }

    // DELETE /ppa/folder/{id}
    public function deleteFolder($id)
    {
        if (auth()->user()->role !== 'Admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        DB::beginTransaction();
        try {
            $folder = SectionFile::findOrFail($id);
            $this->deleteFolderRecursive($folder);
            DB::commit();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function deleteFolderRecursive(SectionFile $folder): void
    {
        foreach ($folder->children()->get() as $child) {
            if ($child->type === 'folder') {
                $this->deleteFolderRecursive($child);
            } else {
                if ($child->type === 'file' && $child->file_path) {
                    Storage::disk('public')->delete($child->file_path);
                }

                $child->delete();
            }
        }

        $folder->delete();
    }

    // GET /ppa/view/{id}
    public function viewFile($id)
    {
        $item = SectionFile::findOrFail($id);
        if (! auth()->check()) {
            abort(403);
        }

        if ($item->type === 'link') {
            return redirect($item->url);
        }

        $path = storage_path('app/public/'.$item->file_path);
        if (! file_exists($path)) {
            abort(404);
        }

        return response()->file($path, [
            'Content-Type' => mime_content_type($path),
            'Content-Disposition' => 'inline; filename="'.$item->name.'"',
        ]);
    }

    // Web view: main PPA index (card grid)
    public function index()
    {
        $sections = [
            (object) ['code' => 'lgrpcs',   'name' => 'Local Government Relations & Policy Compliance Section'],
            (object) ['code' => 'lgpmras',  'name' => 'Local Government Performance Management, Recognition, and Awards Section'],
            (object) ['code' => 'lgpopscm', 'name' => 'Local Government Peace & Order and Public Safety Compliance and Monitoring'],
            (object) ['code' => 'ssu',      'name' => 'Support Services Unit'],
            (object) ['code' => 'dsu',      'name' => 'Database & Statistical Unit'],
        ];

        return view('ppa.index', compact('sections'));
    }

    // Web view: drive interface for a specific section
    public function showSection($sectionCode, $parentId = null)
    {
        $divisionId = $this->getDivisionIdFromSectionCode($sectionCode);
        if (! $divisionId) {
            abort(404, 'Invalid section');
        }

        $sectionNames = [
            'lgrpcs' => 'Local Government Relations & Policy Compliance Section',
            'lgpmras' => 'Local Government Performance Management, Recognition, and Awards Section',
            'lgpopscm' => 'Local Government Peace & Order and Public Safety Compliance and Monitoring',
            'ssu' => 'Support Services Unit',
            'dsu' => 'Database & Statistical Unit',
        ];

        $sectionDisplay = (object) [
            'code' => $sectionCode,
            'name' => $sectionNames[$sectionCode] ?? ucfirst($sectionCode),
        ];

        $currentFolder = null;
        $folders = SectionFile::where('division_id', $divisionId)
            ->where('type', 'folder')
            ->whereNull('parent_id')
            ->get();
        $files = collect();
        $breadcrumbs = [];

        if ($parentId) {
            $currentFolder = SectionFile::findOrFail($parentId);
            $folders = SectionFile::where('parent_id', $parentId)
                ->where('type', 'folder')
                ->get();
            $files = SectionFile::where('parent_id', $parentId)
                ->whereIn('type', ['file', 'link'])
                ->with('user')
                ->get()
                ->map(function ($item) {
                    if ($item->type === 'file' && $item->file_path) {
                        $item->url = route('ppa.file.view', $item->id);
                        $fullPath = storage_path('app/public/'.$item->file_path);
                        $item->size_in_kb = file_exists($fullPath) ? round(filesize($fullPath) / 1024, 2) : null;
                    } else {
                        $item->size_in_kb = null;
                    }
                    $item->uploaded_by_name = $item->user?->name;
                    $item->updated_at_formatted = $item->updated_at?->format('Y-m-d H:i:s');

                    return $item;
                });

            // Build breadcrumbs
            $ancestors = collect();
            $parent = $currentFolder;
            while ($parent) {
                $ancestors->prepend($parent);
                $parent = $parent->parent;
            }
            foreach ($ancestors as $ancestor) {
                $breadcrumbs[] = ['id' => $ancestor->id, 'name' => $ancestor->name];
            }
        }

        $isAdmin = auth()->user()->role === 'Admin';

        return view('ppa.ppa-drive', compact(
            'sectionCode',
            'sectionDisplay',
            'currentFolder',
            'folders',
            'files',
            'breadcrumbs',
            'isAdmin'
        ));
    }
}
