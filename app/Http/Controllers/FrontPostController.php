<?php

namespace App\Http\Controllers;

use App\Models\Post;

class FrontPostController extends Controller
{
  public function show(Post $post)
  {
    $post->load('user', 'comments.replies.user', 'comments.user');
    $totalComments = $post->comments->count();
    $otherPosts = Post::whereNot('id', $post->id)->inRandomOrder()->take(5)->get();
    return view('front.posts.show', compact('post', 'totalComments', 'otherPosts'));
  }
}
