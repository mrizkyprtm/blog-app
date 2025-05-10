@extends('front.layouts.main')

@section('content')
  <section class="bg-gradient-to-br from-blue-50 to-white px-4 py-16 text-center">
    <h1 class="mb-4 text-4xl font-extrabold text-gray-800 md:text-5xl">
      Selamat Datang di Blog Kami
    </h1>
    <p class="text-lg text-gray-600">
      Temukan tulisan inspiratif, ide-ide baru, dan cerita menarik dari para penulis kami.
    </p>
  </section>

  <section class="mx-auto max-w-6xl px-4 py-12">
    <h2 class="mb-6 text-2xl font-semibold text-gray-800">Postingan Terbaru</h2>

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
      @forelse ($posts as $post)
        <div class="overflow-hidden rounded-2xl bg-white shadow-lg transition duration-300 hover:shadow-2xl">
          @if ($post->thumbnail)
            <img class="h-48 w-full object-cover" src="{{ asset('storage/' . $post->thumbnail) }}" alt="Thumbnail">
          @endif
          <div class="p-5">
            <h3 class="mb-2 text-lg font-bold text-gray-800">
              <a class="transition hover:text-blue-600" href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
            </h3>
            <p class="mb-4 text-sm text-gray-500">
              Oleh {{ $post->user->name }} • {{ $post->created_at->translatedFormat('d F Y') }}
            </p>
            <p class="line-clamp-3 text-sm text-gray-700">
              {{ Str::limit(strip_tags($post->body), 100) }}
            </p>
          </div>
        </div>
      @empty
        <p class="text-gray-500">Belum ada postingan.</p>
      @endforelse
    </div>
  </section>
@endsection
