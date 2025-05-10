<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{
  public function __invoke()
  {
    $posts = Post::with('user')->latest()->paginate(6);
    return view('front.home', compact('posts'));
  }
}
