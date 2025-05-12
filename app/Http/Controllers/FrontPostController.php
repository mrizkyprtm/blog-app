<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class FrontPostController extends Controller
{
  public function index(Request $request)
  {
    $request->validate([
      'category' => 'nullable|string|exists:categories,slug',
      'order' => 'nullable|in:asc,desc',
      'search' => 'nullable|string'
    ]);

    $query = Post::with('user', 'category');

    $posts = $query
      ->searchBy('title')
      ->filter()
      ->orderByDate()
      ->paginate(6)
      ->withQueryString();
    $categories = Category::orderBy('name')->get();
    return view('front.posts.index', compact('posts', 'categories'));
  }

  public function show(Post $post)
  {
    $post->load('user', 'comments.replies.user', 'comments.user', 'category');
    $totalComments = $post->comments->count();
    $otherPosts = Post::whereNot('id', $post->id)->inRandomOrder()->take(5)->get();
    return view('front.posts.show', compact('post', 'totalComments', 'otherPosts'));
  }
}
