@extends('front.layouts.main')

@section('title', 'Posts')
@section('content')
  <section class="bg-gradient bg-gradient-to-b from-white to-gray-50 px-4 py-24 text-center">
    <h1 class="mb-4 text-4xl font-extrabold text-gray-800 md:text-5xl">
      Blog Posts
    </h1>
  </section>

  <section class="mx-auto max-w-6xl px-4 py-12">
    <form class="mb-6 grid grid-cols-4 grid-rows-3 gap-2 lg:grid-cols-[2fr_repeat(2,_0.7fr)_0.5fr] lg:grid-rows-1">
      @if (request('author'))
        <input name="author" type="hidden" value="{{ request('author') }}">
      @endif
      <input class="col-span-4 w-full rounded border border-gray-200 p-2 lg:col-span-1 lg:row-span-1" name="search" type="text" value="{{ request('search') }}" placeholder="Cari berdasarkan judul...">

      <select class="col-span-2 row-start-2 rounded border border-gray-200 p-2 lg:col-span-1 lg:row-span-1" name="category">
        <option value="">Semua Kategori</option>
        @foreach ($categories as $category)
          <option value="{{ $category->slug }}" @selected(request('category') == $category->slug)>
            {{ $category->name }}
          </option>
        @endforeach
      </select>

      <select class="col-span-2 col-start-3 row-start-2 rounded border border-gray-200 p-2 lg:col-span-1 lg:row-span-1" name="order">
        <option value="desc" {{ request('order') === 'desc' ? 'selected' : '' }}>Terbaru</option>
        <option value="asc" {{ request('order') === 'asc' ? 'selected' : '' }}>Terlama</option>
      </select>

      <button class="col-span-4 row-start-3 h-fit w-full rounded bg-blue-600 px-4 py-2 font-semibold text-white lg:col-span-1 lg:row-span-1" type="submit">Filter</button>
    </form>

    <h2 class="mb-6 text-2xl font-semibold text-gray-800">
      @if (request('search'))
        Hasil pencarian untuk: "{{ request('search') }}"
      @elseif (request('author'))
        Semua Postingan oleh: {{ request('author') }} ({{ $posts->total() }})
      @elseif(request('category'))
        Kategori: {{ request('category') }} ({{ $posts->total() }})
      @else
        Semua Postingan ({{ $posts->total() }})
      @endif

    </h2>
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
      @forelse ($posts as $post)
        <div class="group/posts overflow-hidden rounded-lg bg-white shadow-md transition duration-300 hover:shadow-lg">
          @if ($post->thumbnail)
            <div class="relative h-48 overflow-hidden">
              <img class="w-full object-cover transition group-hover/posts:scale-105" src="{{ asset('storage/' . $post->thumbnail) }}" alt="Thumbnail">
              <a href="{{ route('posts.category', $post->category->slug) }}">
                <div class="absolute left-2 top-2 z-20 rounded-lg bg-emerald-500 px-2 py-1.5 text-sm font-semibold text-white">
                  {{ $post->category->name }}
                </div>
              </a>
            </div>
          @endif
          <div class="p-5">
            <h3 class="mb-2 text-lg font-bold text-gray-800">
              <a class="transition group-hover/posts:text-blue-600" href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
            </h3>
            <p class="mb-4 text-sm text-gray-500">
              Oleh <a class="underline" href="{{ route('posts.author', $post->user->username) }}">{{ $post->user->name }}</a> • {{ $post->created_at->translatedFormat('d F Y') }}
            </p>
            <p class="line-clamp-3 text-sm text-gray-700">
              {{ Str::limit(strip_tags($post->body), 120) }}
            </p>
          </div>
        </div>
      @empty
        <div class="col-span-full flex flex-col items-center justify-center py-6">
          <p class="text-lg text-gray-500">Postingan tidak ada.</p>
        </div>
      @endforelse
    </div>
    <div class="mt-4">
      {{ $posts->links() }}
    </div>
  </section>
@endsection
