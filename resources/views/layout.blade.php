<!DOCTYPE html>
<html>
    <head>
        <title>Movie App</title>
        <script src="{{ asset('../resources/js/app.js') }}" defer></script>
        <!-- Styles -->
        <link href="{{ asset('../resources/css/app.scss') }}" rel="stylesheet">
    </head>
    <body>

        <header>
            <nav>
                <ul>
                    <li><a href="{{ route('movies.index') }}">Movies</a></li>
                    <!-- Aquí puedes agregar más enlaces de navegación -->
                </ul>
            </nav>
        </header>
        <main>
            @yield('content')
        </main>
    </body>
</html>
