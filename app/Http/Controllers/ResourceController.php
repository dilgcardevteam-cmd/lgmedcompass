<?php

namespace App\Http\Controllers;

use App\Models\ResourceCategory;
use App\Models\ResourceFile;
use App\Models\ResourceFolder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ResourceController extends Controller
{
    // GET /api/resources/folders/{categorySlug}/{folderId?}
    public function folders($categorySlug, $folderId = null)
    {
        $category = ResourceCategory::where('slug', $categorySlug)->firstOrFail();

        $query = ResourceFolder::where('category_id', $category->id);

        if ($folderId) {
            $query->where('parent_id', $folderId);
        } else {
            $query->whereNull('parent_id');
        }

        $folders = $query->get();

        $files = [];
        if ($folderId) {
            // 🔁 ADDED: eager load 'user' relationship
            $files = ResourceFile::where('folder_id', $folderId)
                ->with('user')
                ->get()
                ->map(function ($file) {
                    if ($file->type === 'FILE' && $file->path) {
                        $file->url = route('resource.file.view', $file->id);
                        // Compute file size in KB from the actual stored file
                        $fullPath = storage_path('app/public/'.$file->path);
                        if (file_exists($fullPath)) {
                            $file->size_in_kb = round(filesize($fullPath) / 1024, 2);
                        } else {
                            $file->size_in_kb = null;
                        }
                    } else {
                        $file->size_in_kb = null; // links have no size
                    }
                    $file->uploaded_by_name = $file->user ? $file->user->name : null;
                    // Format the updated_at timestamp
                    $file->updated_at_formatted = $file->updated_at ? $file->updated_at->format('Y-m-d H:i:s') : null;

                    return $file;
                });

        }

        return response()->json([
            'folders' => $folders,
            'files' => $files,
        ]);
    }

    // POST /api/resources/folder
    public function createFolder(Request $request)
    {
        $request->validate([
            'category_slug' => 'required|string',
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:resource_folders,id',
        ]);

        $category = ResourceCategory::where('slug', $request->category_slug)->firstOrFail();

        $folder = ResourceFolder::create([
            'category_id' => $category->id,
            'name' => $request->name,
            'parent_id' => $request->parent_id,
        ]);

        return response()->json($folder);
    }

    // POST /api/resources/upload
    public function uploadFile(Request $request)
    {
        $request->validate([
            'category_slug' => 'required|string',
            'folder_id' => 'required|exists:resource_folders,id',
            'files' => 'required|array',
            'files.*' => 'file|max:51200',
        ]);

        $category = ResourceCategory::where('slug', $request->category_slug)->firstOrFail();
        $uploaded = [];

        foreach ($request->file('files') as $file) {
            $path = $file->store("resources/{$category->slug}", 'public');
            // 🔁 ADDED: user_id = currently authenticated user
            $resourceFile = ResourceFile::create([
                'folder_id' => $request->folder_id,
                'name' => $file->getClientOriginalName(),
                'type' => 'FILE',
                'path' => $path,
                'user_id' => auth()->id(),
            ]);
            \Log::info('New file created', [
                'file_name' => $resourceFile->name,
                'user_id' => $resourceFile->user_id,
                'auth_id' => auth()->id(),
            ]);
            $uploaded[] = [
                'id' => $resourceFile->id,
                'name' => $resourceFile->name,
                'type' => $resourceFile->type,
                'url' => asset('storage/'.$path),
            ];
        }

        return response()->json(['success' => true, 'files' => $uploaded]);
    }

    public function renameFolder(Request $request, $id)
    {
        $user = auth()->user();

        // Only Admin and Employee can rename
        if (! in_array($user->role, ['Admin', 'Employee'])) {
            return response()->json([
                'error' => 'You do not have permission to rename folders.',
            ], 403);
        }

        $request->validate(['name' => 'required|string|max:255']);
        $folder = ResourceFolder::findOrFail($id);
        $folder->name = $request->name;
        $folder->save();

        return response()->json(['success' => true]);
    }

    public function renameFile(Request $request, $id)
    {
        $user = auth()->user();

        if (! in_array($user->role, ['Admin', 'Employee'])) {
            return response()->json([
                'error' => 'You do not have permission to rename files.',
            ], 403);
        }

        $request->validate(['name' => 'required|string|max:255']);
        $file = ResourceFile::findOrFail($id);
        $file->name = $request->name;
        $file->save();

        return response()->json(['success' => true]);
    }

    // POST /api/resources/link
    public function addLink(Request $request)
    {
        $request->validate([
            'folder_id' => 'required|exists:resource_folders,id',
            'name' => 'required|string|max:255',
            'url' => 'required|url',
        ]);

        // 🔁 ADDED: user_id = currently authenticated user
        $link = ResourceFile::create([
            'folder_id' => $request->folder_id,
            'name' => $request->name,
            'type' => 'LINK',
            'url' => $request->url,
            'user_id' => auth()->id(),
        ]);

        return response()->json($link);
    }

    // DELETE /api/resources/file/{id}
    public function deleteFile($id)
    {
        if (auth()->user()->role !== 'Admin') {
            return response()->json(['error' => 'Unauthorized. Only admin can delete files.'], 403);
        }

        $file = ResourceFile::findOrFail($id);
        if ($file->type === 'FILE' && $file->path) {
            Storage::disk('public')->delete($file->path);
        }
        $file->delete();

        return response()->json(['success' => true]);
    }

    public function deleteFolder($id)
    {
        if (auth()->user()->role !== 'Admin') {
            return response()->json(['error' => 'Unauthorized. Only admin can delete folders.'], 403);
        }

        DB::beginTransaction();
        try {
            $folder = ResourceFolder::findOrFail($id);
            $this->deleteFolderRecursive($folder);
            DB::commit();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function deleteFolderRecursive($folder)
    {
        foreach ($folder->files as $file) {
            if ($file->type === 'FILE' && $file->path) {
                Storage::disk('public')->delete($file->path);
            }
            $file->delete();
        }
        foreach ($folder->subfolders as $subfolder) {
            $this->deleteFolderRecursive($subfolder);
        }
        $folder->delete();
    }

    public function viewFile($id)
    {
        $file = ResourceFile::findOrFail($id);

        // Allow any authenticated user (employee) to view the file
        // If you have categories that should be restricted, add logic here
        if (! auth()->check()) {
            abort(403, 'You must be logged in.');
        }

        // If it's a link, redirect to the external URL
        if ($file->type === 'LINK') {
            return redirect($file->url);
        }

        // Build the full filesystem path
        $path = storage_path('app/public/'.$file->path);

        if (! file_exists($path)) {
            abort(404, 'File not found.');
        }

        // Serve the file inline (or as download if you prefer)
        return response()->file($path, [
            'Content-Type' => mime_content_type($path),
            'Content-Disposition' => 'inline; filename="'.$file->name.'"',
        ]);
    }

    // Web view (for the main drive page)
    public function showCategory($categorySlug, $folderId = null)
    {
        $category = ResourceCategory::where('slug', $categorySlug)->firstOrFail();

        $currentFolder = null;
        $folders = ResourceFolder::where('category_id', $category->id)
            ->whereNull('parent_id')
            ->get();
        $files = collect();
        $breadcrumbs = [];

        if ($folderId) {
            $currentFolder = ResourceFolder::findOrFail($folderId);
            $folders = ResourceFolder::where('parent_id', $folderId)->get();

            // 🔁 ADDED: eager load 'user' relationship for files
            $files = ResourceFile::where('folder_id', $folderId)
                ->with('user')
                ->get()
                ->map(function ($file) {
                    if ($file->type === 'FILE' && $file->path) {
                        $file->url = route('resource.file.view', $file->id);
                        // Compute file size in KB from the actual stored file
                        $fullPath = storage_path('app/public/'.$file->path);
                        if (file_exists($fullPath)) {
                            $file->size_in_kb = round(filesize($fullPath) / 1024, 2);
                        } else {
                            $file->size_in_kb = null;
                        }
                    } else {
                        $file->size_in_kb = null; // links have no size
                    }
                    $file->uploaded_by_name = $file->user ? $file->user->name : null;
                    // Format the updated_at timestamp
                    $file->updated_at_formatted = $file->updated_at ? $file->updated_at->format('Y-m-d H:i:s') : null;

                    return $file;
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

        return view('resources.drive', compact(
            'category', 'categorySlug', 'currentFolder', 'folders', 'files',
            'breadcrumbs', 'isAdmin'
        ));
    }
}
