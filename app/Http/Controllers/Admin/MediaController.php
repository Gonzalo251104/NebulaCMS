<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index()
    {
        $files = collect(Storage::disk('public')->files('editor'))
            ->filter(fn ($path) => preg_match('/\.(jpg|jpeg|png|webp|gif)$/i', $path))
            ->sortDesc()
            ->values();

        return view('admin.media.index', [
            'files' => $files,
        ]);
    }

    public function destroy()
    {
        $path = request('path');
        $path = ltrim((string) $path, '/');

        if (!str_starts_with($path, 'editor/')) {
            abort(403);
        }

        Storage::disk('public')->delete($path);

        return redirect()->route('admin.media.index')
            ->with('success', 'Imagen eliminada');
    }
}