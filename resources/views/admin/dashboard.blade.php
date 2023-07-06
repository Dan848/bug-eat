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
                                    <a href="">{{ $restaurant->name }}</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="container mb-5">
                        <h1 class="mt-5 mb-4 text-center">
                            Ooops!
                        </h1>
                        <div class="d-flex flex-column align-items-center justify-content-between">
                            <h4>Pare che tu non abbia ancora un ristorante</h4>
                            <a href="{{ route('admin.restaurants.create') }}" class="btn btn-primary"><i
                                    class="fa-solid fa-plus me-2"></i>Crea il tuo ristorante</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
