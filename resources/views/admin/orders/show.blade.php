@extends('layouts.admin')

@section('title')
    Ordine N°{{ $order->id }}
@endsection

@section('content')
    <div class="container text-white mt-5">
        <div class="d-flex justify-content-between align-items-center">
            <ol class="breadcrumb mt-2 mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a
                        href="{{ route('admin.sales.index', $order->products->first()->restaurant) }}">Ordini</a></li>
                <li class="breadcrumb-item active">N° {{ $order->id }}</li>
            </ol>
        </div>
        <div class="row justify-content-center bg-dark rounded-5 py-5 px-4 ">

            <div class="box-info col-sm-12 col-md-10 col-lg-8">
                {{-- INFOS --}}
                <h2 class="text-secondary d-flex justify-content-center">
                    Riepilogo Ordine N° {{ $order->id }}
                </h2>
                <hr />
                {{-- NUMBER ORDER --}}
                <div class="d-flex justify-content-between">
                    <div class="pixel-text">N° Ordine:</div>
                    <div class="text-end text-break fw-bold">{{ $order->id }}</div>
                </div>
                <hr />
                {{-- RESTAURANT NAME --}}
                <div class="d-flex justify-content-between">
                    <div class="pixel-text">Ristorante:</div>
                    <div class="text-end text-break fw-bold">{{ $order->products->first()->restaurant->name }}</div>
                </div>
                <hr />
                {{-- USER EMAIL --}}
                <div class="d-flex justify-content-between">
                    <div class="pixel-text"> Email Utente:</div>
                    <div class="text-end text-break fw-bold"> {{ $order->user_email }}</div>
                </div>
                <hr />
                {{-- ADDRESS USER --}}
                <div class="d-flex justify-content-between">
                    <div class="pixel-text"> Indirizzo Utente:</div>
                    <div class="text-end text-break fw-bold"> {{ $order->shipment_address }}</div>
                </div>
                <hr />
                {{-- DATE ORDER --}}
                <div class="d-flex justify-content-between">
                    <div class="pixel-text"> Data:</div>
                    <div class="text-end text-break fw-bold"> {{ $order->date_time }}</div>
                </div>
                <hr />
                <div class="text-center">
                    Prodotti
                </div>
            </div>
            <div class="box-info col-sm-12 col-md-10 col-lg-8">

                <hr />
                {{-- NUMBER ORDER --}}
                @foreach ($order->products as $product)
                    <div class="row d-flex justify-content-between">
                        <div class="col-6 pixel-text">{{ $product->name }}</div>
                        <div class="col-3 text-end fw-bold">x {{ $product->pivot->quantity }}</div>
                        <div class="col-3 text-end fw-bold">{{ $product->price }} €</div>
                    </div>
                    <hr />
                @endforeach
                <div class="d-flex justify-content-between">
                    <div class="pixel-text fw-bolder text-uppercase"> Totale:</div>
                    <div class="text-end text-break fw-bold"> {{ $order->total_price }} €</div>
                </div>
                <hr />
            </div>
        </div>
    </div>
@endsection
