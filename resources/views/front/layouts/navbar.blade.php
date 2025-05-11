<header class="sticky top-0 z-30 bg-white shadow-md" x-data="{ open: false }">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="flex h-16 items-center justify-between font-medium">
      <!-- Brand & Menu -->
      <div class="flex items-center">
        <a class="text-xl font-bold text-blue-600" href="{{ route('home') }}">Simple Blog</a>
        <nav class="ml-10 hidden space-x-4 md:flex">
          <a class="text-gray-700 transition hover:text-blue-600" href="{{ route('home') }}">Home</a>
        </nav>
      </div>

      <!-- Auth Menu -->
      <div class="hidden items-center space-x-4 md:flex">
        @auth
          <span class="text-sm text-gray-600">Halo, {{ auth()->user()->name }}</span>
          <a class="inline-block rounded-sm border border-[#19140035] bg-rose-500 px-5 py-1.5 text-sm leading-normal text-white transition hover:border-[#1915014a]" href="{{ url('/dashboard') }}">
            Dashboard
          </a>
        @else
          <a class="text-sm text-gray-700 hover:text-blue-600" href="{{ route('login') }}">Login</a>
          <a class="text-sm text-gray-700 hover:text-blue-600" href="{{ route('register') }}">Daftar</a>
        @endauth
      </div>

      <!-- Mobile Toggle -->
      <div class="md:hidden">
        <button class="rounded-md border border-gray-300 p-2 text-gray-700 focus:outline-none" @click="open = !open">
          <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path :class="{ 'hidden': open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            <path :class="{ 'hidden': !open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Mobile Nav -->
  <div class="space-y-4 bg-white px-4 pb-4 font-medium md:hidden" x-show="open" x-transition>
    <a class="block text-gray-700 hover:text-blue-600" href="{{ route('home') }}">Home</a>

    @auth
      <a class="inline-block rounded-sm border border-[#19140035] bg-rose-500 px-5 py-1.5 text-sm leading-normal text-white transition hover:border-[#1915014a]" href="{{ url('/dashboard') }}">
        Dashboard
      </a>
    @else
      <a class="block text-gray-700 hover:text-blue-600" href="{{ route('login') }}">Login</a>
      <a class="block text-gray-700 hover:text-blue-600" href="{{ route('register') }}">Daftar</a>
    @endauth
  </div>
</header>
