<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  public function __invoke(Request $request)
  {
    $query = Post::with('user');

    if ($request->filled('search')) {
      $query->where('title', 'like', '%' . $request->search . '%');
    }

    if ($request->filled('author')) {
      $query->where('user_id', $request->author);
    }

    if ($request->filled('order') && in_array($request->order, ['asc', 'desc'])) {
      $query->orderBy('created_at', $request->order);
    } else {
      $query->latest();
    }

    $posts = $query->latest()->paginate(10)->withQueryString();
    $authors = User::orderBy('name')->get();
    // $posts = Post::with('user')->latest()->get();
    return view('front.home', compact('posts', 'authors'));
  }
}
