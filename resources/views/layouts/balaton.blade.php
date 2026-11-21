<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | Balatoni hajók</title>
    <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.3/flatly/bootstrap.min.css">

<style>
    header nav {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 0.75rem 1rem;
    }

    header a { color: white; }
    header a[aria-current="page"] { font-weight: bold; }
    main { min-height: 55vh; }

    main nav {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 1rem;
        margin-top: 1rem;
    }
</style>
</head>
<body>
    <header class="bg-primary">
        <nav class="container py-3" aria-label="Főmenü">
            <a href="{{ route('home') }}" @if (request()->routeIs('home')) aria-current="page" @endif>
                Főoldal
            </a>
            <a href="{{ route('adatbazis') }}" @if (request()->routeIs('adatbazis')) aria-current="page" @endif>
                Adatbázis
            </a>

            <a href="{{ route('kapcsolat') }}" @if (request()->routeIs('kapcsolat')) aria-current="page" @endif>
                 Kapcsolat
            </a>

            <a href="{{ route('diagram') }}" @if (request()->routeIs('diagram')) aria-current="page" @endif>
                 Diagram
            </a>
            @guest
                <a href="{{ route('login') }}">Bejelentkezés</a>
                <a href="{{ route('register') }}">Regisztráció</a>
            @else
                <a href="{{ route('uzenetek') }}" @if (request()->routeIs('uzenetek')) aria-current="page" @endif>
                    Üzenetek
                </a>
                @if ((int) auth()->user()->role === 1)
                    <a href="{{ route('admin.hajok.index') }}"
                        @if (request()->routeIs('admin.hajok.*')) aria-current="page" @endif>
                            CRUD
                     </a>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-light">Kijelentkezés</button>
                </form>
            @endguest
        </nav>
    </header>

    <main class="container py-4">
        @yield('content')
    </main>

    <footer class="border-top bg-light">
        <div class="container py-3">Készítő : Kun Mihály (VFHZPB)</div>
    </footer>
</body>
</html>