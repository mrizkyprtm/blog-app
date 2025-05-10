<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
  public function store(Request $request, Post $post)
  {
    $validated = $request->validate([
      'body' => 'required|string',
      'parent_id' => 'nullable|exists:comments,id'
    ]);

    $post->comments()->create([
      'body' => $validated['body'],
      'user_id' => auth()->id(),
      'parent_id' => $validated['parent_id'] ?? null,
    ]);

    return back()->with('success', 'Comment added.');
  }

  public function destroy(Comment $comment)
  {
    $comment->delete();
    return back();
  }
}
