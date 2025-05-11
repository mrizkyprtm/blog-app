@extends('front.layouts.main')

@section('title', 'Home')
@section('content')
  <section class="bg-white px-4 py-16 text-center">
    <h1 class="mb-4 text-4xl font-extrabold text-gray-800 md:text-5xl">
      Selamat Datang di Blog Kami
    </h1>
    <p class="text-lg text-gray-600">
      Temukan tulisan inspiratif, ide-ide baru, dan cerita menarik dari para penulis kami.
    </p>
  </section>

  <section class="mx-auto max-w-6xl px-4 py-12">
    <form class="mb-6 flex flex-wrap gap-2" method="GET" action="{{ route('home') }}">
      <input class="flex-1 rounded border border-gray-200 p-2" name="search" type="text" value="{{ request('search') }}" placeholder="Cari berdasarkan judul...">

      <select class="w-1/2 rounded border border-gray-200 p-2 md:w-1/4" name="author">
        <option value="">All Authors</option>
        @foreach ($authors as $author)
          <option value="{{ $author->id }}" {{ request('author') == $author->id ? 'selected' : '' }}>
            {{ $author->name }}
          </option>
        @endforeach
      </select>

      <select class="w-1/2 rounded border border-gray-200 p-2 md:w-1/4" name="order">
        <option value="desc" {{ request('order') === 'desc' ? 'selected' : '' }}>Terbaru</option>
        <option value="asc" {{ request('order') === 'asc' ? 'selected' : '' }}>Terlama</option>
      </select>

      <button class="h-fit rounded bg-blue-600 px-4 py-2 text-white lg:w-fit" type="submit">Filter</button>
    </form>
    <h2 class="mb-6 text-2xl font-semibold text-gray-800">Postingan Terbaru</h2>

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
      @forelse ($posts as $post)
        <div class="overflow-hidden rounded-lg bg-white shadow-md transition duration-300 hover:shadow-lg">
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
              <a class="transition hover:text-blue-600" href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
            </h3>
            <p class="mb-4 text-sm text-gray-500">
              Oleh {{ $post->user->name }} • {{ $post->created_at->translatedFormat('d F Y') }}
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
