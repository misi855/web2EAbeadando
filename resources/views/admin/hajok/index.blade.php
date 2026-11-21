@extends('layouts.balaton')

@section('title', 'Hajók kezelése')

@section('content')
    <h1>Hajók kezelése</h1>
    <p><a href="{{ route('admin.hajok.create') }}">Új hajó hozzáadása</a></p>

    @if (session('siker'))
        <p role="status">{{ session('siker') }}</p>
    @endif

    <div class="table-responsive">
    <table class="table table-striped table-hover align-middle">
            <thead>
                <tr>
                    <th scope="col">Név</th>
                    <th scope="col">Típus</th>
                    <th scope="col">Üzemel</th>
                    <th scope="col">Műveletek</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($hajok as $hajo)
                    <tr>
                        <td>{{ $hajo->nev }}</td>
                        <td>{{ $hajo->tipus }}</td>
                        <td>{{ $hajo->uzemel ? 'Igen' : 'Nem' }}</td>
                        <td>
                            <a href="{{ route('admin.hajok.edit', $hajo) }}">Szerkesztés</a>

                            <form method="POST"
                                  action="{{ route('admin.hajok.destroy', $hajo) }}"
                                  onsubmit="return confirm('Törlöd ezt a hajót és a korábbi neveit?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit">Törlés</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4">Még nincs hajó az adatbázisban.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <nav aria-label="Lapozás">
        @if ($hajok->previousPageUrl())
            <a href="{{ $hajok->previousPageUrl() }}">Előző oldal</a>
        @endif

        <span>{{ $hajok->currentPage() }}. oldal</span>

        @if ($hajok->nextPageUrl())
            <a href="{{ $hajok->nextPageUrl() }}">Következő oldal</a>
        @endif
    </nav>
@endsection