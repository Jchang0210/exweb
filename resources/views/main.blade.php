<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('partials._head')
    </head>

    <body>
        @include('partials._nav')

        <div class="container" id="app">

            @include('partials._messages')

            @yield('content')

            @include('partials._foolter')

        </div>

        @include('partials._javascript')

        @yield('scripts')

    </body>
</html>
