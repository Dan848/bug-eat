@extends('layouts.admin')

@section('content')
    @if ($orders->count())
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
                data-item-price="{{ $order->price }}" data-item-restaurant="{{ $order->restaurant_name }}">

            </div>
        @endforeach
    @else
        <div class="container-fluid px-4">
            <h1 class="mt-4 text-center">Ordini</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Ordini</li>
            </ol>
        </div>
        <div class="container-fluid px-4">
            <hr>
        </div>
        @include('partials.no-orders')
    @endif
@endsection
