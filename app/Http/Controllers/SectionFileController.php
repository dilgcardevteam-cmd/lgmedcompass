<?php

namespace App\Http\Controllers;

use App\Models\SectionFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SectionFileController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX (View files + folders)
    |--------------------------------------------------------------------------
    */
    public function index($section, $folder = null)
    {
        $items = SectionFile::where('section', $section)
            ->where('parent_id', $folder)
            ->orderByRaw("type = 'folder' DESC") // folders first
            ->orderBy('created_at', 'desc')
            ->get();

        // Breadcrumbs
        $breadcrumbs = [];
        $temp_id = $folder;

        while ($temp_id) {
            $current = SectionFile::find($temp_id);
            if (! $current) {
                break;
            }

            array_unshift($breadcrumbs, [
                'id' => $current->id,
                'name' => $current->name,
            ]);

            $temp_id = $current->parent_id;
        }

        return view("resources.rd-{$section}", [
            'section' => $section,
            'items' => $items,
            'parent_id' => $folder,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | OPEN FOLDER (route helper)
    |--------------------------------------------------------------------------
    */
    public function openFolder($section, $id)
    {
        return $this->index($section, $id);
    }

    /*
    |--------------------------------------------------------------------------
    | UPLOAD FILE
    |--------------------------------------------------------------------------
    */
    public function upload(Request $request)
    {
        $request->validate([
            'section' => 'required|string',
            'file' => 'required|file|max:10240',
            'parent_id' => 'nullable|exists:section_files,id',
        ]);

        $file = $request->file('file');
        $path = $file->store("resources/{$request->section}", 'public');

        SectionFile::create([
            'section' => $request->section,
            'name' => $file->getClientOriginalName(),
            'type' => 'file',
            'file_path' => $path,
            'parent_id' => $request->parent_id,
            'user_id' => auth()->id(),
        ]);

        return back()->with('success', 'File uploaded successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | STORE LINK
    |--------------------------------------------------------------------------
    */
    public function storeLink(Request $request)
    {
        $request->validate([
            'section' => 'required|string',
            'name' => 'required|string|max:255',
            'url' => 'required|url',
            'parent_id' => 'nullable|exists:section_files,id',
        ]);

        SectionFile::create([
            'section' => $request->section,
            'name' => $request->name,
            'type' => 'link',
            'url' => $request->url,
            'parent_id' => $request->parent_id,
            'user_id' => auth()->id(),
        ]);

        return back()->with('success', 'Link saved successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE FOLDER
    |--------------------------------------------------------------------------
    */
    public function createFolder(Request $request)
    {
        $request->validate([
            'section' => 'required|string',
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:section_files,id',
        ]);

        SectionFile::create([
            'section' => $request->section,
            'name' => $request->name,
            'type' => 'folder',
            'parent_id' => $request->parent_id,
            'user_id' => auth()->id(),
        ]);

        return back()->with('success', 'Folder created successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE (RECURSIVE)
    |--------------------------------------------------------------------------
    */
    public function destroy(SectionFile $file)
    {
        $this->deleteRecursive($file);

        return back()->with('success', 'Item deleted successfully');
    }

    /*
    |--------------------------------------------------------------------------
    | RECURSIVE DELETE LOGIC
    |--------------------------------------------------------------------------
    */
    private function deleteRecursive($item)
    {
        // If folder → delete children first
        if ($item->type === 'folder') {
            $children = SectionFile::where('parent_id', $item->id)->get();

            foreach ($children as $child) {
                $this->deleteRecursive($child);
            }
        }

        // If file → delete storage
        if ($item->type === 'file' && $item->file_path) {
            Storage::disk('public')->delete($item->file_path);
        }

        $item->delete();
    }
}
