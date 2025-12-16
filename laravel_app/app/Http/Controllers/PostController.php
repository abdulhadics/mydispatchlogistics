<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = \App\Models\Post::all();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'author' => 'required',
        ]);

        \App\Models\Post::create($request->all());

        return redirect()->route('posts.index')
            ->with('success', 'Post created successfully.');
    }

    public function edit(\App\Models\Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, \App\Models\Post $post)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'author' => 'required',
        ]);

        $post->update($request->all());

        return redirect()->route('posts.index')
            ->with('success', 'Post updated successfully');
    }

    public function destroy(\App\Models\Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Post deleted successfully');
    }
}
