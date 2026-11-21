@extends('layouts.balaton')

@section('title', 'Kapcsolat')

@section('content')
    <h1>Kapcsolat</h1>

    @if (session('siker'))
        <p role="status">{{ session('siker') }}</p>
    @endif

    <form method="POST" action="{{ route('kapcsolat.store') }}">
        @csrf

        <p>
            <label for="nev">Név</label><br>
            <input class="form-control" id="nev" name="nev" value="{{ old('nev') }}" required maxlength="100">
            @error('nev')
                <br><span>{{ $message }}</span>
            @enderror
        </p>

        <p>
            <label for="email">E-mail-cím</label><br>
            <input class="form-control" id="email" name="email" type="email"
                   value="{{ old('email') }}" required maxlength="255">
            @error('email')
                <br><span>{{ $message }}</span>
            @enderror
        </p>

        <p>
            <label for="uzenet">Üzenet</label><br>
            <textarea class="form-control" id="uzenet" name="uzenet" rows="6"
                      required maxlength="3000">{{ old('uzenet') }}</textarea>
            @error('uzenet')
                <br><span>{{ $message }}</span>
            @enderror
        </p>

        <button class="btn btn-primary" type="submit">Üzenet küldése</button>
    </form>
@endsection