@include('layouts.header')

@include('layouts.includes.navbar')
@include('layouts.includes.sidebar')

<main class="main" id="main">
    @yield('content')
</main>

@include('layouts.footer')
