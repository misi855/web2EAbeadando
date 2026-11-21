<!DOCTYPE html>
@extends('layouts.balaton')

@section('title', 'Adatbázis')

@section('content')
        <h1>Balatoni hajók</h1>

        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead>
                    <tr>
                        <th scope="col">Hajó neve</th>
                        <th scope="col">Típus</th>
                        <th scope="col">Tulajdonos</th>
                        <th scope="col">Város</th>
                        <th scope="col">Korábbi hajónevek</th>
                        <th scope="col">Üzemel</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($hajok as $hajo)
                        <tr>
                            <td>{{ $hajo->nev }}</td>
                            <td>{{ $hajo->tipus }}</td>
                            <td>{{ $hajo->tulajdonos?->nev ?? 'Ismeretlen' }}</td>
                            <td>{{ $hajo->tulajdonos?->varos ?? '–' }}</td>
                            <td>{{ $hajo->korabbiNevek->pluck('nev')->join(', ') ?: '–' }}</td>
                            <td>{{ $hajo->uzemel ? 'Igen' : 'Nem' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="6">Nincs megjeleníthető hajó.</td></tr>
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