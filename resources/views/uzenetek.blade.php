@extends('layouts.balaton')

@section('title', 'Üzenetek')

@section('content')
    <h1>Üzenetek</h1>

    <div class="table-responsive">
    <table class="table table-striped table-hover align-middle">
            <thead>
                <tr>
                    <th scope="col">Küldés ideje</th>
                    <th scope="col">Feladó</th>
                    <th scope="col">Üzenet</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($uzenetek as $uzenet)
                    <tr>
                        <td>{{ $uzenet->created_at->copy()->timezone('Europe/Budapest')->format('Y.m.d. H:i') }}</td>
                        <td>{{ $uzenet->nev }}</td>
                        <td style="white-space: pre-wrap; overflow-wrap: anywhere">{{ $uzenet->uzenet }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">Még nem érkezett üzenet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection