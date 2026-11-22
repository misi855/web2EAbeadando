@extends('layouts.balaton')

@section('title', 'Főoldal')

@section('content')
    <div class="row align-items-center g-4 py-3">
        <div class="col-lg-5">
            <h1 class="display-4 fw-bold">Balatoni hajók</h1>

            <p class="lead">
                Böngéssz a Balaton egykori és ma is üzemelő hajói között.
                Nézd meg, milyen típusúak, ki a tulajdonosuk,
                és milyen neveken közlekedtek korábban.
            </p>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('adatbazis') }}" class="btn btn-primary">
                    Hajók böngészése
                </a>
                <a href="{{ route('diagram') }}" class="btn btn-outline-primary">
                    Hajótípusok diagramja
                </a>
            </div>
        </div>

        <div class="col-lg-7">
            <figure class="mb-0">
                <img src="{{ asset('images/siofoki-kikoto.jpg') }}"
                     alt="A siófoki kikötő a Balatonon"
                     class="img-fluid w-100 rounded-3 shadow-sm">

                <figcaption class="small text-body-secondary mt-2">
                    Fotó:
                    <a href="https://commons.wikimedia.org/wiki/File:Balaton_Hungary_2005_033.jpg">
                        Norbert Aepli, Wikimedia Commons
                    </a>
                    · <a href="https://creativecommons.org/licenses/by/2.5/">CC BY 2.5</a>
                </figcaption>
            </figure>
        </div>
    </div>
@endsection