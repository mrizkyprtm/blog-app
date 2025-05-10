<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class FrontPostController extends Controller
{
  public function show(Post $post)
  {
    $post->load('user');
    $otherPosts = Post::whereNot('id', $post->id)->inRandomOrder()->take(5)->get();
    return view('front.posts.show', compact('post', 'otherPosts'));
  }
}
