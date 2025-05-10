<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

  <title>{{ config('app.name') }}</title>

  {{-- Fonts --}}
  <link href="https://fonts.bunny.net" rel="preconnect">
  <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

  {{-- FontAwesome Icon --}}
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">

  {{-- Style --}}
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <link href="{{ asset('build/assets/app-7brdmFnY.css') }}" rel="stylesheet">
  <script src="{{ asset('build/assets/app-Bf4POITK.js') }}"></script>
</head>

<body class="bg-gray-50 font-sans text-gray-900">
  @include('front.layouts.navbar')
  <main class="min-h-screen">
    @yield('content')
  </main>
  @include('front.layouts.footer')

  @stack('scripts')
</body>

</html>
