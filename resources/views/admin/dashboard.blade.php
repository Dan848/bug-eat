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


    </div>
@endsection
