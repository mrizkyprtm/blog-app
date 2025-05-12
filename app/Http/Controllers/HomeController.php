<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  public function __invoke(Request $request)
  {
    $posts = Post::with(['user', 'category'])->latest()->take(3)->get();
    return view('front.home', compact('posts'));
  }
}
