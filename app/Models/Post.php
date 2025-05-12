<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  use Sluggable;

  protected $fillable = [
    'category_id',
    'user_id',
    'title',
    'slug',
    'thumbnail',
    'body'
  ];

  public function category()
  {
    return $this->belongsTo(Category::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function comments()
  {
    return $this->hasMany(Comment::class)->orderBy('created_at', 'desc');
  }

  public function sluggable(): array
  {
    return [
      'slug' => [
        'source' => 'title'
      ]
    ];
  }

  #[Scope]
  protected function searchBy(Builder $query, string $column): void
  {
    $query->where($column, 'like', '%' . request('search') . '%');
  }

  #[Scope]
  public function filter(Builder $query): void
  {
    if ($slug = request('category')) {
      $query->whereHas('category', fn($q) => $q->where('slug', $slug));
    }

    if ($username = request('author')) {
      $query->whereHas('user', fn($q) => $q->where('username', $username));
    }
  }

  #[Scope]
  public function orderByDate($query): void
  {
    $order = request('order');
    if (in_array($order, ['asc', 'desc'])) {
      $query->orderBy('created_at', $order);
    } else {
      $query->latest();
    }
  }
}
