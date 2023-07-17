@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="text-secondary text-center my-4">
            Ciao {{ Auth::user()->name }}
        </h2>
        <div class="row justify-content-center">
            <div class="col">
                @if ($restaurants->count())
                    <div class="card">
                        <div class="card-header">Gestisci i tuoi ristoranti</div>

                        <div class="card-body">
                            <table class="table table-dark table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Ristorante</th>
                                        <th class="d-none d-sm-table-cell" scope="col">Menu/Prodotti</th>
                                        <th class="d-none d-sm-table-cell" scope="col">Ordini</th>
                                        <th class="d-none d-xxl-table-cell" scope="col">Partita IVA</th>
                                        <th class="d-none d-lg-table-cell" scope="col">Email</th>
                                        <th class="d-none d-xl-table-cell" scope="col">Numero di telefono</th>
                                        <th class="text-center" scope="col">Azioni</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($restaurants as $restaurant)
                                        <tr class="align-middle">
                                            {{-- Restaurants --}}
                                            <th scope="row">
                                                <a class="h5"
                                                    href="{{ route('admin.restaurants.show', $restaurant) }}">{{ strCutter($restaurant->name, 30) }}
                                                </a>
                                            </th>
                                            {{-- Menu/Products --}}
                                            <td class="d-none d-sm-table-cell">
                                                <a class="btn fw-medium btn-secondary"
                                                    href="{{ route('admin.menu.index', $restaurant) }}">
                                                    Menu <i class="ms-1 fa-solid fa-book-open"></i>
                                                </a>
                                            </td>
                                            {{-- Orders --}}
                                            <td class="d-none d-sm-table-cell">
                                                <a class="btn fw-medium btn-light"
                                                    href="{{ route('admin.orders.index', $restaurant) }}">
                                                    Ordini <i class="ms-1 fa-solid fa-file-lines"></i>
                                                </a>
                                            </td>
                                            {{-- P. IVA --}}
                                            <td class="d-none d-xxl-table-cell">
                                                {{ $restaurant->p_iva }}
                                            </td>
                                            {{-- Email --}}
                                            <td class="d-none d-lg-table-cell">
                                                {{ strCutter($restaurant->email, 30) }}
                                            </td>
                                            {{-- Phone number --}}
                                            <td class="d-none d-xl-table-cell">
                                                {{ $restaurant->phone_num }}
                                            </td>

                                            {{-- Action Button --}}
                                            <td>
                                                <div
                                                    class="d-flex gap-2 flex-wrap justify-content-center text-center align-items-center">

                                                    <a class="btn btn-secondary bg-gradient"
                                                        href="{{ route('admin.restaurants.show', $restaurant->slug) }}">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </a>
                                                    <a class="btn btn-primary"
                                                        href="{{ route('admin.restaurants.edit', $restaurant->slug) }}">
                                                        <i class="fa-solid fa-pencil"></i>
                                                    </a>
                                                    <form class="m-0 p-0 d-inline-block"
                                                        action="{{ route('admin.restaurants.destroy', $restaurant->slug) }}"
                                                        method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button class="btn btn-danger delete-button"
                                                            data-item-title="{{ $restaurant->name }}" type="submit">
                                                            <i class="fa-solid fa-eraser"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <hr>
                    @include('partials.no-restaurants')
                @endif
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col">
                @include('partials.chart')
            </div>
        </div>

    </div>
@endsection
