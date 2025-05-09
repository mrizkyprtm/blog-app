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
    //
  }

  public function store(Request $request)
  {
    //
  }

  public function show(Post $post)
  {
    //
  }

  public function edit(Post $post)
  {
    //
  }

  public function update(Request $request, Post $post)
  {
    //
  }

  public function destroy(Post $post)
  {
    //
  }
}
