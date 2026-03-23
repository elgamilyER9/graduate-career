<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Upload a file
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:5120', // 5MB max
            'type' => 'required|string|in:resume,certificate,portfolio,cover_letter,document',
        ]);

        $file = $request->file('file');
        $type = $request->input('type');

        // Check MIME type
        if (!File::isAllowedMimeType($file->getMimeType())) {
            return back()->with('error', __('File type not allowed.'));
        }

        try {
            $path = $file->store("files/{$type}", 'public');

            $uploadedFile = File::create([
                'user_id' => auth()->id(),
                'name' => $file->getClientOriginalName(),
                'path' => $path,
                'type' => $type,
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize(),
            ]);

            return response()->json([
                'success' => true,
                'message' => __('File uploaded successfully.'),
                'file' => $uploadedFile
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => __('Error uploading file.')
            ], 500);
        }
    }

    /**
     * Get user's files by type
     */
    public function index(Request $request)
    {
        $type = $request->input('type', 'resume');
        $files = File::userFilesByType(auth()->id(), $type);

        return view('files.index', compact('files', 'type'));
    }

    /**
     * Admin: Get all files from all users
     */
    public function adminIndex(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, __('Unauthorized'));
        }

        $query = File::with('user')->latest();

        if ($request->filled('type')) {
            $query->where('type', $request->input('type'));
        }
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($uq) use ($search) {
                        $uq->where('name', 'like', "%{$search}%");
                    });
            });
        }

        $files = $query->paginate(20);
        return view('files.admin_index', compact('files'));
    }

    /**
     * Delete a file
     */
    public function destroy(File $file)
    {
        // Verify ownership
        if ($file->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            abort(403, __('Unauthorized'));
        }

        $file->deleteFromStorage();

        return response()->json([
            'success' => true,
            'message' => __('File deleted successfully.')
        ]);
    }

    /**
     * Download a file
     */
    public function download(File $file)
    {
        // Verify access
        if ($file->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            abort(403, __('Unauthorized'));
        }

        return Storage::disk('public')->download($file->path, $file->name);
    }

    /**
     * Show/Preview a file in the browser
     */
    public function show(File $file)
    {
        // Verify access
        if ($file->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            abort(403, __('Unauthorized'));
        }

        $path = Storage::disk('public')->path($file->path);

        if (!file_exists($path)) {
            abort(404, __('File not found.'));
        }

        return response()->file($path, [
            'Content-Type' => $file->mime_type,
            'Content-Disposition' => 'inline; filename="' . $file->name . '"'
        ]);
    }
}
