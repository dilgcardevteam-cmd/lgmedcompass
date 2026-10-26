<?php

namespace App\Http\Controllers;

use App\Models\DriveFile;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DriveController extends Controller
{
    public function folders($division, $parent = null)
    {
        $query = Folder::where('division_id', $division);

        if ($parent) {
            $query->where('parent_id', $parent);
        } else {
            $query->whereNull('parent_id');
        }

        $folders = $query->get();

        $files = [];
        if ($parent) {
            $files = DriveFile::where('folder_id', $parent)
                ->get()
                ->map(function ($file) {
                    if ($file->type === 'FILE' && ! empty($file->path)) {
                        $file->url = asset('storage/'.$file->path);
                    }

                    return $file;
                });
        }

        return response()->json([
            'folders' => $folders,
            'files' => $files,
        ]);
    }

    public function createFolder(Request $request)
    {
        $folder = Folder::create([
            'name' => $request->name,
            'division_id' => $request->division_id,
            'parent_id' => $request->parent_id,
        ]);

        return response()->json($folder);
    }

    // ✅ FIXED DELETE FOLDER
    public function deleteFolder($id)
    {
        DB::beginTransaction();

        try {
            $folder = Folder::findOrFail($id);

            $this->deleteFolderRecursive($folder);

            DB::commit();

            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // ✅ CLEAN RECURSIVE DELETE
    private function deleteFolderRecursive($folder)
    {
        // Delete files inside folder
        foreach ($folder->files as $file) {

            if ($file->type === 'FILE' && ! empty($file->path)) {
                Storage::disk('public')->delete($file->path);
            }

            $file->delete();
        }

        // Recursively delete subfolders
        foreach ($folder->subfolders as $subfolder) {
            $this->deleteFolderRecursive($subfolder);
        }

        // Delete the folder itself
        $folder->delete();
    }

    public function uploadFile(Request $request)
    {
        if (! $request->hasFile('file')) {
            return response()->json(['error' => 'No file uploaded'], 400);
        }

        $file = $request->file('file');

        $path = $file->store('drive', 'public');

        $url = asset('storage/'.$path);

        $driveFile = DriveFile::create([
            'folder_id' => $request->folder_id,
            'name' => $file->getClientOriginalName(),
            'type' => 'FILE',
            'path' => $path,
        ]);

        return response()->json([
            'id' => $driveFile->id,
            'name' => $driveFile->name,
            'type' => $driveFile->type,
            'url' => $url,
        ]);
    }

    public function addLink(Request $request)
    {
        $file = DriveFile::create([
            'folder_id' => $request->folder_id,
            'name' => $request->name,
            'type' => 'LINK',
            'url' => $request->url,
        ]);

        return response()->json($file);
    }

    public function deleteFile($id)
    {
        $file = DriveFile::findOrFail($id);

        if ($file->type === 'FILE' && ! empty($file->path)) {
            Storage::disk('public')->delete($file->path);
        }

        $file->delete();

        return response()->json(['success' => true]);
    }
}
