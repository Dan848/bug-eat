@extends('layouts.admin')

@section('content')
    <div class="container">
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
    @foreach ($orders as $order)
        <div class="ordini" data-item-date="{{ $order->month }}" data-item-count="{{ $order->total }}"
            data-item-price="{{ $order->price }}">

        </div>
    @endforeach
@endsection
