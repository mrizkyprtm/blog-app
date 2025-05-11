<x-guest-layout>
  <!-- Session Status -->
  <x-auth-session-status class="mb-4" :status="session('status')" />

  <div class="space-y-4 p-6 md:space-y-6">
    <h1 class="text-xl font-bold leading-tight tracking-tight text-zinc-900 md:text-2xl">
      Masuk ke Akun Anda
    </h1>
    <form class="space-y-4 md:space-y-6" action="{{ route('login') }}" method="post">
      @csrf
      <div>
        <label class="mb-2 block text-sm font-medium text-zinc-900" for="email">Email</label>
        <input class="block w-full rounded-lg border border-zinc-300 bg-zinc-50 p-2.5 text-zinc-900 focus:border-blue-600 focus:ring-blue-600 sm:text-sm" id="email" name="email" type="email" placeholder="name@gmail.com" required autofocus>
        <x-input-error class="mt-2" :messages="$errors->get('email')" />
      </div>
      <div>
        <label class="mb-2 block text-sm font-medium text-zinc-900" for="password">Kata Sandi</label>
        <div class="relative">
          <input class="block w-full rounded-lg border border-zinc-300 bg-zinc-50 p-2.5 text-zinc-900 focus:border-blue-600 focus:ring-blue-600 sm:text-sm" id="password" name="password" type="password" placeholder="••••••••" required>
          <button class="absolute inset-y-0 right-2 top-1/2 -translate-y-1/2 transform cursor-pointer text-zinc-600" id="togglePassword" name="togglePassword" type="button">
            <svg class="h-5 w-5" id="x-lucide-eye" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
              <circle cx="12" cy="12" r="3" />
            </svg> <svg class="hidden h-5 w-5" id="x-lucide-eye-off" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M10.733 5.076a10.744 10.744 0 0 1 11.205 6.575 1 1 0 0 1 0 .696 10.747 10.747 0 0 1-1.444 2.49" />
              <path d="M14.084 14.158a3 3 0 0 1-4.242-4.242" />
              <path d="M17.479 17.499a10.75 10.75 0 0 1-15.417-5.151 1 1 0 0 1 0-.696 10.75 10.75 0 0 1 4.446-5.143" />
              <path d="m2 2 20 20" />
            </svg> </button>
        </div>
        <x-input-error class="mt-2" :messages="$errors->get('password')" />
      </div>

      <button class="w-full rounded-lg bg-blue-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="submit">Masuk</button>
      <p class="text-sm font-light text-zinc-500 dark:text-zinc-400">
        Belum Punya Akun? <a class="font-medium text-blue-600 hover:underline dark:text-blue-500" href="{{ route('register') }}">Daftar Akun</a>
      </p>
    </form>
  </div>

  @push('scripts')
    <script>
      const passwordInput = document.getElementById("password");
      const togglePasswordButton = document.getElementById("togglePassword");
      const eyeIcon = togglePasswordButton.querySelector("#x-lucide-eye");
      const eyeOffIcon = togglePasswordButton.querySelector("#x-lucide-eye-off");

      togglePasswordButton.addEventListener("click", function() {
        if (passwordInput.getAttribute("type") === "password") {
          passwordInput.setAttribute("type", "text");
          eyeIcon.style.display = "none";
          eyeOffIcon.style.display = "block";
        } else {
          passwordInput.setAttribute("type", "password");
          eyeIcon.style.display = "block";
          eyeOffIcon.style.display = "none";
        }
      });
    </script>
  @endpush

</x-guest-layout>
