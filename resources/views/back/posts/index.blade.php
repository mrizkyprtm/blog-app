<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      Posts
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <div class="mb-4 flex justify-between">
            <h2 class="text-xl font-semibold text-gray-800">Posts List</h2>
            <a class="h-fit rounded-md bg-emerald-500 px-3 py-1.5 text-sm font-semibold text-white hover:bg-emerald-600" href="{{ route('back.posts.create') }}">Create Post</a>
          </div>
          <div class="overflow-x-auto border border-gray-300">
            <table class="min-w-full table-auto divide-y divide-gray-200" id="post-table">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">No.</th>
                  <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Thumbnail</th>
                  <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Title</th>
                  <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Category</th>
                  <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Created At</th>
                  <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Actions</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200 bg-white">
                @forelse ($posts as $post)
                  <tr class="">
                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">{{ $loop->iteration }}</td>
                    <td class="whitespace-nowrap px-6 py-4">
                      <img class="max-h-40" src="{{ asset('storage/' . $post->thumbnail) }}" alt="">
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $post->title }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">
                      <div class="rounded-full border border-red-400 bg-red-600/20 px-2.5 py-1 text-center text-xs text-red-500">
                        {{ $post->category?->name }}
                      </div>
                    </td>
                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">{{ $post->created_at->format('d M Y, H:i') }}</td>
                    <td class="whitespace-nowrap px-6 py-4 text-right text-xs font-medium">
                      <div class="flex flex-wrap items-center justify-center gap-2">
                        <a href="{{ route('posts.show', $post) }}">
                          <div class="btn bg-amber-400 text-xs">
                            Show
                          </div>
                        </a>
                        <a href="{{ route('back.posts.edit', $post) }}">
                          <div class="btn bg-blue-500 text-xs text-white">
                            Edit
                          </div>
                        </a>
                        <form class="inline" action="{{ route('back.posts.destroy', $post) }}" method="post">
                          @csrf
                          @method('delete')
                          <button class="btn bg-red-500 text-xs text-white">Delete</button>
                        </form>
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td class="whitespace-nowrap px-6 py-4 text-center text-sm text-gray-700" colspan="6">No Post Found.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
          <div class="mt-4">
            {{ $posts->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
