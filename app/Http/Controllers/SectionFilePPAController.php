<?php

namespace App\Http\Controllers;

use App\Models\SectionFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SectionFilePPAController extends Controller
{
    public function index($section, $folder = null)
    {
        // 1. Fetch items using the correct Model (SectionFile)
        $items = SectionFile::where('section', $section)
            ->where('parent_id', $folder)
            ->orderByRaw("CASE WHEN type='folder' THEN 0 ELSE 1 END")
            ->orderBy('created_at', 'desc')
            ->get();

        // 2. Build the breadcrumbs using SectionFile
        $breadcrumbs = [];
        $temp_id = $folder; // This is the current folder ID from the URL

        while ($temp_id) {
            $currentFolder = SectionFile::find($temp_id);

            if (! $currentFolder) {
                break;
            }

            array_unshift($breadcrumbs, [
                'id' => $currentFolder->id,
                'name' => $currentFolder->name,
            ]);

            // Move to the parent of the current folder
            $temp_id = $currentFolder->parent_id;
        }

        return view("resources.rd-{$section}", [
            'section' => $section,
            'items' => $items,
            'parent_id' => $folder,
            'breadcrumbs' => $breadcrumbs, // Pass the trail to the view
        ]);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'section' => 'required|string',
            'file' => 'required|file|max:10240', // max 10MB
        ]);

        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();
        // Store in a section-based folder to keep things organised
        $path = $file->store("resources/{$request->section}", 'public');
        SectionFile::create([
            'section' => $request->section,
            'name' => $originalName,
            'type' => 'file',
            'file_path' => $path,
            'parent_id' => $request->parent_id,
            'user_id' => auth()->id(),
        ]);

        return back()->with('success', 'File uploaded successfully.');
    }

    public function storeLink(Request $request)
    {
        $request->validate([
            'section' => 'required|string',
            'name' => 'required|string|max:255',
            'url' => 'required|url',
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

    // Optional: delete method
    public function destroy(SectionFile $file)
    {
        // delete file from storage
        if ($file->type === 'file' && $file->file_path) {
            Storage::disk('public')->delete($file->file_path);
        }

        // delete children if folder
        if ($file->type === 'folder') {

            $children = SectionFile::where('parent_id', $file->id)->get();

            foreach ($children as $child) {

                if ($child->type === 'file' && $child->file_path) {
                    Storage::disk('public')->delete($child->file_path);
                }

                $child->delete();
            }
        }

        $file->delete();

        return back()->with('success', 'Item deleted successfully');
    }

    public function createFolder(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'section' => 'required|string',
        ]);

        SectionFile::create([
            'section' => $request->section,
            'name' => $request->name,
            'type' => 'folder',
            'parent_id' => $request->parent_id ?? null,
            'user_id' => auth()->id(),
        ]);

        return back()->with('success', 'Folder created successfully');
    }

    public function showFiles($section, $parent_id = null)
    {
        // 1. Get the items for the current folder
        $items = Item::where('section', $section)
            ->where('parent_id', $parent_id)
            ->get();

        // 2. Build the breadcrumbs array
        $breadcrumbs = [];
        $currentFolderId = $parent_id;

        while ($currentFolderId) {
            $folder = Item::find($currentFolderId);
            if (! $folder) {
                break;
            }

            // Add to the START of the array so it goes: Root > Parent > Child
            array_unshift($breadcrumbs, [
                'id' => $folder->id,
                'name' => $folder->name,
            ]);

            // Move up to the next parent
            $currentFolderId = $folder->parent_id;
        }

        // 3. Pass EVERYTHING to the view
        return view('resources.rd-administrative', compact('items', 'section', 'parent_id', 'breadcrumbs'));
    }
}
