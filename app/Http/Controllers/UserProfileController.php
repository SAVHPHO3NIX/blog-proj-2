<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;

class UserProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $followersCount = $user->followers()->count();
        $followingCount = $user->following()->count();
        $postsCount = $user->posts()->count();
        $commentsCount = $user->comments()->count();

        return view('profile.show', compact('user', 'followersCount', 'followingCount', 'postsCount', 'commentsCount'));
    }


    public function edit()
    {
        return view('profile.edit-user-profile', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'bio' => 'nullable|string',
            'profile_photo' => 'nullable|image|max:1024',
        ]);

        $user = Auth::user();

        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $user->profile_photo_path = $path;
        }

        $user->bio = $request->input('bio');
        $user->save();

        return redirect()->route('userprofile.show')->with('success', 'Profile updated successfully.');
    }

    public function index()
    {
        $users = User::where('id', '!=', auth()->id())->get();

        return view('profiles.index', compact('users'));
    }

    public function follow(User $user)
    {
        auth()->user()->following()->attach($user);

        return back()->with('success', 'You are now following ' . $user->name);
    }

    public function unfollow(User $user)
    {
        auth()->user()->following()->detach($user);

        return back()->with('success', 'You have unfollowed ' . $user->name);
    }
}
