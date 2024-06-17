<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $comment = new Comment([
            'content' => $request->input('content'),
            'user_id' => Auth::id(),
            'post_id' => $post->id,
        ]);

        $comment->save();

        return redirect()->back()->with('success', 'Comment added successfully.');
    }

    public function edit(Comment $comment)
    {
        if ($comment->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        if (Auth::id() !== $comment->user_id) {
            return redirect()->back()->with('error', 'You are not authorized to update this comment.');
        }

        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $comment->update([
            'content' => $request->input('content'),
        ]);

        return redirect()->route('dashboard')->with('success', 'Comment updated successfully.');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');

        return redirect()->back()->with('error', 'You are not authorized to delete this comment.');
    }

    public function like(Comment $comment)
    {
        $comment->likes()->create(['user_id' => auth()->id()]);
        return back();
    }

    public function unlike(Comment $comment)
    {
        $comment->likes()->where('user_id', auth()->id())->delete();
        return back();
    }

    public function userComments()
    {
        $user = Auth::user();
        $comments = Comment::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        return view('comments.user_comments', compact('comments'));
    }
}
