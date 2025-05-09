<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      Edit Post
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <form action="{{ route('back.posts.update', $post) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="mb-4 md:w-1/2">
              <x-input-label for="title" value="Title" />
              <x-text-input class="mt-1 block w-full" id="title" name="title" type="text" :value="old('title', $post->title)" required autofocus />
              <x-input-error class="mt-2" :messages="$errors->get('title')" />
            </div>
            <div class="mb-4">
              <x-input-label for="thumbnail" value="Current Thumbnail" />
              @if ($post->thumbnail)
                <img class="mb-2 mt-1 max-h-40 rounded shadow" src="{{ asset('storage/' . $post->thumbnail) }}" alt="Thumbnail">
              @else
                <p class="mt-1 text-sm italic text-gray-500">No Thumbnail</p>
              @endif
            </div>
            <div class="mb-4 md:w-1/2">
              <x-input-label for="thumbnail" value="Change Thumbnail (Optional)" />
              <input class="mt-1 block w-full rounded-md border border-gray-300 p-1 shadow-sm file:rounded-md file:bg-gray-200 file:p-1.5 focus:border-indigo-500 focus:ring-indigo-500" id="thumbnail" name="thumbnail" type="file" accept="image/*">
              <x-input-error class="mt-2" :messages="$errors->get('thumbnail')" />
            </div>
            <div class="mb-4">
              <x-input-label for="body" value="Body" />
              <textarea class="mt-1 block w-full" id="body" name="body" rows="10" required>{{ old('body', $post->body) }}</textarea>
              <x-input-error class="mt-2" :messages="$errors->get('body')" />
            </div>
            <x-primary-button type="submit">Submit</x-primary-button>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
