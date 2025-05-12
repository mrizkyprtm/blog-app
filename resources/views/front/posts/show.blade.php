@extends('front.layouts.main')

@section('title', $post->title)
@section('content')
  <section class="mx-auto flex max-w-6xl flex-col justify-between gap-y-4 py-12 lg:flex-row lg:px-4">
    <article class="card w-full max-sm:px-3 lg:w-[68%]">
      <div class="card-body">
        <a href="{{ route('posts.category', $post->category->slug) }}">
          <div class="mb-2 w-fit rounded-lg bg-emerald-500/20 px-4 py-2 text-sm font-semibold text-emerald-500">
            {{ $post->category->name }}
          </div>
        </a>
        <div class="">
          <h1 class="card-title text-3xl font-bold">{{ $post->title }}</h1>
          <div class="my-6 flex items-center">
            <div class="size-10 overflow-hidden rounded-full">
              <img src="https://placehold.co/50x50?text=Profile" alt="">
            </div>
            <div class="ml-4">
              <a href="{{ route('posts.author', $post->user->username) }}">
                <p class="font-semibold">{{ $post->user->name }}</p>
              </a>
              <p><span class="text-sm text-black/50">{{ $post->created_at->translatedFormat('D, d M Y') . ' | ' . $post->created_at->diffForHumans() }}</span></p>
            </div>
          </div>
        </div>
        <div class="aspect-16/9 mb-4 overflow-hidden rounded-md">
          <img class="h-full w-full object-cover transition-transform hover:scale-105" src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}">
        </div>
        <div class="prose prose-base mt-2 max-w-none">{!! $post->body !!}</div>

        <div class="mt-12 rounded">
          <h4 class="mb-4 text-lg font-bold">Tinggalkan Komentar:</h4>
          @auth
            <form action="{{ route('comments.store', $post) }}" method="post">
              @csrf
              <div class="overflow-hidden rounded-lg border border-neutral-200 bg-neutral-50">
                <textarea class="min-h-24 w-full resize-none border-none bg-transparent p-4 text-sm focus:ring-0" id="body" name="body" placeholder="Tambahkan komentar..." required>{{ old('body') }}</textarea>
                <div class="flex justify-end border-t border-neutral-200 p-2">
                  <button class="btn btn-primary" type="submit">Submit</button>
                </div>
              </div>
            </form>
          @endauth
          @guest
            <div class="my-3 flex items-center justify-center rounded-md bg-gray-100 px-4 py-8 font-medium">
              <p class="text-center">
                Anda harus terdaftar sebagai pengguna untuk dapat menambahkan komentar. Silahkan
                <a class="text-blue-600 underline" href="{{ route('login') }}">Login</a> atau <a class="text-blue-600 underline" href="{{ route('register') }}">Register</a>.
              </p>
            </div>
          @endguest

          <hr class="border-1 my-6 border-neutral-200">
          <h3 class="mb-2 flex items-center gap-2 font-bold">
            Comments
            <span class="w-fit rounded-full border border-blue-500 bg-blue-500 px-2 py-1 text-xs font-semibold leading-none text-white">
              {{ $totalComments }}
            </span>
          </h3>
          @foreach ($post->comments->whereNull('parent_id') as $comment)
            <div class="py-2 text-sm font-normal">
              <div class="flex items-start">
                <div class="w-full">
                  <div class="pl-2">
                    <p class="mb-1.5 font-semibold leading-5">{{ $comment->user->name }} <span class="ml-1 text-xs font-normal text-gray-500">• {{ $comment->created_at->longRelativeDiffForHumans() }}</span></p>
                    <p class="mb-1.5">{{ $comment->body }}</p>
                  </div>
                  @auth
                    <div class="mb-1 flex gap-1 pl-2 font-medium">
                      <button class="cursor-pointer rounded-md px-2 py-1 text-xs text-gray-500 transition-colors hover:bg-gray-100" title="Balas komentar" onclick="toggleReplyForm({{ $comment->id }})">
                        <i class="fa-solid fa-reply mr-0.5 text-xs"></i>
                        Balas
                      </button>
                      @can('delete', $comment)
                        <form action="{{ route('comments.destroy', $comment->id) }}" method="post">
                          @csrf
                          @method('delete')
                          <button class="flex cursor-pointer items-center justify-center gap-1.5 rounded-md px-2 py-1 text-xs font-semibold text-red-500 transition-colors hover:bg-gray-100" type="submit">
                            <i class="fa-solid fa-trash"></i>
                            Hapus
                          </button>
                        </form>
                      @endcan
                    </div>
                  @endauth

                  <form class="mb-1 hidden w-full pl-2" id="reply-form-{{ $comment->id }}" method="post" action="{{ route('comments.store', $post) }}">
                    @csrf
                    <input name="parent_id" type="hidden" value="{{ $comment->id }}">
                    <textarea class="mt-1 w-full rounded border-black/15 p-2 text-sm" name="body" required placeholder="Tulis Balasan..."></textarea>
                    <button class="mt-1 rounded bg-gray-200 px-2 py-1 text-sm" type="submit">Balas</button>
                  </form>

                  <div class="ml-2 border-l-2 border-gray-300">
                    @foreach ($comment->replies as $reply)
                      <div class="flex items-start py-2 pl-3">
                        <div class="ml-2">
                          <p class="mb-1 font-semibold leading-5">{{ $reply->user->name }}
                            <span class="ml-1 text-xs font-normal text-gray-500">• {{ $reply->created_at->longRelativeDiffForHumans() }}</span>
                          </p>
                          <p>{{ $reply->body }}</p>
                          @auth
                            @can('delete', $reply)
                              <form class="mt-2" action="{{ route('comments.destroy', $reply->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="flex cursor-pointer items-center justify-center gap-1.5 rounded-md px-2 py-1 text-xs font-semibold text-red-500 transition-colors hover:bg-gray-100" type="submit">
                                  <i class="fa-solid fa-trash"></i>
                                  Hapus
                                </button>
                              </form>
                            @endcan
                          @endauth
                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          @endforeach
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
                <div class="flex gap-2 rounded-md py-3">
                  <img class="h-18 aspect-video shrink-0 rounded-md object-cover" src="{{ asset('storage/' . $other->thumbnail) }}" alt="">
                  <div class="flex-1">
                    <p class="line-clamp-2 text-wrap text-sm font-semibold transition-colors hover:text-blue-700">{{ $other->title }}</p>
                    <p class="mt-1 text-xs">{{ $other->created_at->translatedFormat('D, d M Y') }} • <a class="hover:underline" href="{{ route('posts.category', $other->category->slug) }}">{{ $other->category->name }}</a></p>
                  </div>
                </div>
              </a>
            </div>
          @endforeach
        </div>
      </div>
    </aside>
  </section>
@endsection

@push('scripts')
  <script>
    let activeReplyFormId = null;

    function toggleReplyForm(commentId) {
      // Tutup form sebelumnya jika berbeda
      if (activeReplyFormId && activeReplyFormId !== commentId) {
        const prevForm = document.getElementById('reply-form-' + activeReplyFormId);
        if (prevForm) prevForm.classList.add('hidden');
      }

      const currentForm = document.getElementById('reply-form-' + commentId);
      if (currentForm) {
        currentForm.classList.toggle('hidden');
        activeReplyFormId = currentForm.classList.contains('hidden') ? null : commentId;
      }
    }
  </script>
@endpush
