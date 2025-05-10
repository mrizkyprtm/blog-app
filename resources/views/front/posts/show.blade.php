@extends('front.layouts.main')

@section('content')
  <section class="mx-auto flex max-w-6xl flex-col justify-between gap-y-4 py-12 lg:flex-row lg:px-4">
    <article class="card bg-base-100 w-full lg:w-[68%]">
      <div class="card-body">
        <div class="">
          <h1 class="card-title text-3xl font-bold">{{ $post->title }}</h1>
          <div class="my-6 flex items-center">
            <div class="size-10 overflow-hidden rounded-full">
              <img src="https://placehold.co/50x50?text=Profile" alt="">
            </div>
            <div class="ml-4">
              <p class="font-semibold">{{ $post->user->name }}</p>
              <p><span class="text-sm text-black/50">{{ $post->created_at->translatedFormat('D, d M Y') . ' | ' . $post->created_at->diffForHumans() }}</span></p>
            </div>
          </div>
        </div>
        <div class="aspect-16/9 mb-4 overflow-hidden rounded-md">
          <img class="h-full w-full object-cover transition-transform hover:scale-105" src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}">
        </div>
        <div class="mt-2 space-y-4 leading-relaxed">{!! $post->body !!}</div>

        <div class="mt-12 rounded">
          <h4 class="mb-2 text-lg font-bold">Tinggalkan Komentar:</h4>
          @auth
            <form class="mb-4" action="" method="post">
              @csrf
              <textarea class="textarea mt-1 w-full" id="body" name="body" placeholder="Tambahkan komentar..." required></textarea>
              <button class="btn btn-primary mt-2" type="submit">Submit</button>
            </form>
          @endauth
          @guest
            <div class="my-3 flex items-center justify-center rounded-md bg-gray-100 px-4 py-8 font-medium">
              <p class="text-center">
                Anda harus terdaftar sebagai pengguna untuk menambahkan komentar. Silahkan
                <a class="text-blue-600 underline" href="{{ route('login') }}">Login</a> atau <a class="text-blue-600 underline" href="{{ route('register') }}">Register</a>.
              </p>
            </div>
          @endguest
          <hr class="mb-4 border-gray-200">
        </div>
      </div>
    </article>
    <aside class="relative w-full lg:w-[30%]">
      <div class="top-22 card bg-base-100 sticky p-4">
        <div class="rounded-lg bg-neutral-200 p-3">
          <h4 class="text-lg font-semibold">Berita Lainnya</h4>
        </div>

        <div class="mt-4 divide-y divide-neutral-200">
          @foreach ($otherPosts as $other)
            <div>
              <a href="{{ route('posts.show', $other) }}">
                <div class="line-clamp-3 rounded-md px-2 py-3 font-semibold transition-colors hover:text-blue-700">
                  {{ $other->title }}
                </div>
              </a>
            </div>
          @endforeach
        </div>
      </div>
    </aside>
  </section>
@endsection
