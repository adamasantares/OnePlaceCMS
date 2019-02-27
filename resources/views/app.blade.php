<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('manage.partials.head')
    </head>
    <body class="sidebar-mini sidebar-collapse" style="position: relative; height: auto;">
        <div id="app" class="wrapper">
            <main-app/>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
