@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="fs-4 text-secondary my-4">
            Ciao {{ Auth::user()->name }}
        </h2>
        <div class="row justify-content-center">
            <div class="col">
                @if ($restaurants->count())
                    <div class="card">
                        <div class="card-header">Gestisci i tuoi ristoranti</div>

                        <div class="card-body">
                            @foreach ($restaurants as $restaurant)
                                <div>
                                    <a
                                        href="{{ route('admin.restaurants.show', $restaurant->slug) }}">{{ $restaurant->name }}</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <hr>

                    @include('partials.no-restaurants')
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-12 my-5">
                <h3>Ordini per mese</h3>
                <canvas id="myOrders"></canvas>
            </div>
            <div class="col-6 my-5">
                <h3>Incassi mensili</h3>
                <canvas id="myEarns"></canvas>
            </div>
            <div class="col-4 my-5">
                <h3>Ordini totali per ristorante</h3>
                <canvas id="myRestaurants"></canvas>
            </div>
        </div>

    </div>
@endsection
