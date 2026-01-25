<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mews\Purifier\Facades\Purifier;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'   => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'status'  => 'required|in:draft,published',
        ]);

        $data['user_id'] = Auth::id();

        $data['content'] = Purifier::clean($data['content']);

        Post::create($data);

        return redirect()->route('posts.index')
            ->with('success', 'Post creado correctamente');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title'   => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'status'  => 'required|in:draft,published',
        ]);

        $data['content'] = Purifier::clean($data['content']);

        $post->update($data);

        return redirect()->route('posts.index')
            ->with('success', 'Post actualizado correctamente');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Post eliminado');
    }
}
