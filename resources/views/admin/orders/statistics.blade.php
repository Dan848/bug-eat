@extends('layouts.admin')

@section('content')
    @if ($orders->count())
        <div class="container px-3">
            <div class="row justify-content-center mt-5">
                <h1 class="text-center">Statistiche Ordini</h1>
                <h6 class="text-center">Ultimo anno</h6>
                <div class="col-12 col-lg-10 my-5">
                    <h3 class="text-center">Ordini per mese</h3>
                    <canvas id="myOrders"></canvas>
                </div>
                <div class="col-12 col-sm-12 col-md-8 my-5">
                    <h3 class="text-center">Incassi mensili</h3>
                    <canvas id="myEarns"></canvas>
                </div>
                <div class="col-10 col-sm-8 col-md-4 my-5">
                    <h3 class="text-center mb-4">Ordini totali per ristorante</h3>
                    <canvas id="myRestaurants"></canvas>
                </div>
            </div>
            {{-- SEND DATA TO JS --}}
            @foreach ($orders as $order)
                <div class="orders" data-item-date="{{ $order->month }}" data-item-count="{{ $order->total }}"
                    data-item-price="{{ $order->price }}" data-item-restaurant="{{ $order->restaurant_name }}">
                </div>
            @endforeach
        </div>
    @else
        {{-- Modal No Orders --}}
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
