<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  public function __invoke(Request $request)
  {
    $query = Post::with('user', 'category');

    if ($request->filled('search')) {
      $query->where('title', 'like', '%' . $request->search . '%');
    }

    if ($request->filled('category')) {
      $category = Category::where('slug', $request->category)->first('id');
      $query->where('category_id', $category->id);
    }

    if ($request->filled('order') && in_array($request->order, ['asc', 'desc'])) {
      $query->orderBy('created_at', $request->order);
    } else {
      $query->latest();
    }

    $posts = $query->latest()->paginate(6)->withQueryString();
    $categories = Category::orderBy('name')->get();
    return view('front.home', compact('posts', 'categories'));
  }
}
