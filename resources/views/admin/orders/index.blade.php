@extends('layouts.admin')

@section('content')
    @if ($orders->count())
        <div class="container-fluid px-4">
            <h1 class="mt-4 text-center">Ordini</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Ordini</li>
            </ol>
            <div class="card text-bg-dark mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div><i class="fa-solid fa-file-lines me-2"></i>Ordini</div>
                </div>
                <div class="card-body">
                    <table class="table table-dark table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">N° Ordine</th>
                                <th class="d-none d-md-table-cell" scope="col">Ristorante</th>
                                <th class="d-none d-lg-table-cell" scope="col">Indirizzo Utente</th>
                                <th class="d-none d-sm-table-cell" scope="col">Prezzo Totale</th>
                                <th scope="col">Data Ordine</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr class="align-middle">
                                    {{-- Id --}}
                                    <th scope="row">
                                        <a class="h5"
                                            href="{{ route('admin.orders.show', $order) }}">{{ $order->id }}
                                        </a>
                                    </th>
                                    {{-- User Email --}}
                                    <td class="d-none d-md-table-cell">
                                        {{ $order->products->first()->restaurant->name }}
                                    </td>
                                    {{-- Address User --}}
                                    <td class="d-none d-lg-table-cell">
                                        {{ strCutter($order->shipment_address, 30) }}
                                    </td>
                                    {{-- Total Price --}}
                                    <td class="d-none d-sm-table-cell">
                                        {{ $order->total_price }} €
                                    </td>
                                    {{-- Order Date --}}
                                    <th class="row">
                                        {{ $order->date_time }}
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $orders->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        </div>
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
    @include('partials.delete-modal')
@endsection
