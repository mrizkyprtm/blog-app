<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
  public function index()
  {
    $posts = Post::with('user')->where('user_id', '=', auth()->id())->latest()->get();
    return view('back.posts.index', compact('posts'));
  }

  public function create()
  {
    return view('back.posts.create');
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'title' => 'required|max:255',
      'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5012',
      'body' => 'required'
    ]);

    if ($request->hasFile('thumbnail')) {
      $path =  'thumbnails';
      $filename = time() . '_' . $request->file('thumbnail')->getClientOriginalName();
      $thumbnailPath = $request->file('thumbnail')->storeAs($path, $filename, 'public');
      $validated['thumbnail'] = $thumbnailPath;
    }

    auth()->user()->posts()->create($validated);
    return to_route('back.posts.index')->with('success', 'Post created.');
  }

  public function show(Post $post)
  {
    //
  }

  public function edit(Post $post)
  {
    return view('back.posts.edit', compact('post'));
  }

  public function update(Request $request, Post $post)
  {
    $validated = $request->validate([
      'title' => 'required|max:255',
      'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5012',
      'body' => 'required'
    ]);

    if ($request->hasFile('thumbnail')) {
      // Hapus thumbnail lama jika ada
      if ($post->thumbnail && Storage::disk('public')->exists($post->thumbnail)) {
        Storage::disk('public')->delete($post->thumbnail);
      }

      $path =  'thumbnails';
      $filename = time() . '_' . $request->file('thumbnail')->getClientOriginalName();
      $thumbnailPath = $request->file('thumbnail')->storeAs($path, $filename, 'public');
      $validated['thumbnail'] = $thumbnailPath;
    }

    $post->update($validated);
    return to_route('back.posts.index')->with('success', 'Post updated.');
  }

  public function destroy(Post $post)
  {
    // Hapus thumbnail dari storage
    if ($post->thumbnail && Storage::disk('public')->exists($post->thumbnail)) {
      Storage::disk('public')->delete($post->thumbnail);
    }

    $post->delete();
    return back()->with('success', 'Post deleted.');
  }
}
