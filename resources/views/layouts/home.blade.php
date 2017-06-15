<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('layouts/partials/_head')
</head>
<body>
<div id="app">
    <section class="hero is-primary is-large">
        <div class="head-hero">
            @include('layouts/partials/_navigation')
        </div>
        @yield('content')
    </section>
</div>
@include('layouts/partials/_scripts')
</body>
</html>
