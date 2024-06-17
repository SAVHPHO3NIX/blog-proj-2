<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        $user = auth()->user();
        return view('dashboard', compact('posts', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $imagePath = str_replace('public/', '', $imagePath);
        }

        auth()->user()->posts()->create([
            'content' => $request->content,
            'image' => $imagePath,
        ]);

        return back()->with('success', 'Post created successfully.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('success', 'Post deleted successfully.');
    }

    public function like(Post $post)
    {
        $post->likes()->create(['user_id' => auth()->id()]);
        return back();
    }


    public function unlike(Post $post)
    {
        $post->likes()->where('user_id', auth()->id())->delete();
        return back();
    }

    public function yourPosts()
    {
        $user = auth()->user();
        $posts = $user->posts()->latest()->get();
        return view('your-posts', compact('posts', 'user'));
    }

    public function edit(Post $post)
    {

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $post->update([
            'content' => $request->input('content'),
        ]);

        return redirect()->route('dashboard')->with('success', 'Post updated successfully.');
    }
}
