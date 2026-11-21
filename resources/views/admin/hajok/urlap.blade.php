@extends('layouts.balaton')

@section('title', $hajo->exists ? 'Hajó szerkesztése' : 'Új hajó')

@section('content')
    <h1>{{ $hajo->exists ? 'Hajó szerkesztése' : 'Új hajó' }}</h1>

    <form method="POST" action="{{ $hajo->exists
        ? route('admin.hajok.update', $hajo)
        : route('admin.hajok.store') }}">
        @csrf

        @if ($hajo->exists)
            @method('PUT')
        @endif

        <p>
            <label for="nev">Hajó neve</label><br>
            <input class="form-control" id="nev" name="nev" required maxlength="255"
                   value="{{ old('nev', $hajo->nev) }}">
            @error('nev') <br><span>{{ $message }}</span> @enderror
        </p>

        <p>
            <label for="tipus">Típus</label><br>
            <input class="form-control" id="tipus" name="tipus" required maxlength="255"
                   value="{{ old('tipus', $hajo->tipus) }}">
            @error('tipus') <br><span>{{ $message }}</span> @enderror
        </p>

        <p>
            <label for="tulaz">Tulajdonos</label><br>
            <select class="form-select" id="tulaz" name="tulaz">
                <option value="">Ismeretlen</option>
                @foreach ($tulajdonosok as $tulajdonos)
                    <option value="{{ $tulajdonos->az }}"
                        @selected((string) old('tulaz', $hajo->tulaz) === (string) $tulajdonos->az)>
                        {{ $tulajdonos->nev }}
                    </option>
                @endforeach
            </select>
            @error('tulaz') <br><span>{{ $message }}</span> @enderror
        </p>

        <p>
            <label for="uzemel">Üzemel</label><br>
            <select class="form-select" id="uzemel" name="uzemel" required>
                <option value="1" @selected((int) old('uzemel', $hajo->uzemel) === 1)>Igen</option>
                <option value="0" @selected((int) old('uzemel', $hajo->uzemel) === 0)>Nem</option>
            </select>
            @error('uzemel') <br><span>{{ $message }}</span> @enderror
        </p>

        <button class="btn btn-primary" type="submit">Mentés</button>
        <a href="{{ route('admin.hajok.index') }}">Vissza a listához</a>
    </form>
@endsection