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
            <a class="h-fit rounded-md bg-blue-400 px-3 py-1.5 text-sm font-semibold text-white hover:bg-blue-500" href="#">Create Post</a>
          </div>
          <div class="overflow-x-auto border border-gray-300">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">No.</th>
                  <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Thumbnail</th>
                  <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Title</th>
                  <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Created At</th>
                  <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Actions</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200 bg-white">
                @forelse ($posts as $post)
                  <tr class="">
                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">{{ $loop->iteration }}</td>
                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">{{ $post->thumbnail }}</td>
                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600">{{ $post->title }}</td>
                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600">{{ $post->created_at->format('d M Y') }}</td>
                    <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                      <button class="mr-2 text-indigo-600 hover:text-indigo-900">Edit</button>
                      <button class="text-red-600 hover:text-red-900">Delete</button>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td class="cols-span-5 text-center">No Post Found.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
