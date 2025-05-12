@extends('front.layouts.main')

@section('title', 'Home')
@section('content')
  <section class="bg-gradient bg-gradient-to-b from-white to-gray-50 px-4 py-24 text-center">
    <h1 class="mb-4 text-4xl font-extrabold text-gray-800 md:text-5xl">
      Selamat Datang di Blog Kami
    </h1>
    <p class="text-lg text-gray-600">
      Media berita terkini menyampaikan informasi berita terbaru Indonesia dan Global yang terpopuler dan terpercaya.
    </p>
  </section>

  <section class="mx-auto max-w-6xl px-4 py-12">
    <div class="flex justify-between">
      <h2 class="mb-6 text-2xl font-semibold text-gray-800">Postingan Terbaru</h2>
      <a class="h-fit underline underline-offset-2 hover:text-blue-600" href="{{ route('posts.index') }}">Lihat Postingan Lainnya</a>
    </div>

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
      @forelse ($posts as $post)
        <div class="group/posts overflow-hidden rounded-lg bg-white shadow-md transition duration-300 hover:shadow-lg">
          @if ($post->thumbnail)
            <div class="relative h-48 overflow-hidden">
              <img class="w-full object-cover transition group-hover/posts:scale-105" src="{{ asset('storage/' . $post->thumbnail) }}" alt="Thumbnail">
              <div class="absolute left-2 top-2 z-20 rounded-lg bg-emerald-500 px-2 py-1.5 text-sm font-semibold text-white">
                {{ $post->category->name }}
              </div>
            </div>
          @endif
          <div class="p-5">
            <h3 class="mb-2 text-lg font-bold text-gray-800">
              <a class="transition group-hover/posts:text-blue-600" href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
            </h3>
            <p class="mb-4 text-sm text-gray-500">
              Oleh <a class="underline" href="{{ route('posts.index', $post->user->username) }}">{{ $post->user->name }}</a> • {{ $post->created_at->translatedFormat('d F Y') }}
            </p>
            <p class="line-clamp-3 text-sm text-gray-700">
              {{ Str::limit(strip_tags($post->body), 120) }}
            </p>
          </div>
        </div>
      @empty
        <p class="text-gray-500">Postingan tidak ada.</p>
      @endforelse
    </div>
  </section>
@endsection
