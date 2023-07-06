@extends('layouts.admin')

@section('content')
    @if ($restaurants->count())
        <div class="container-fluid px-4">
            <h1 class="mt-4 text-center">Ristoranti</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Ristoranti</li>
            </ol>
            <div class="card text-bg-dark mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div><i class="fa-solid fa-utensils me-2"></i>Ristoranti</div>
                    <a class="btn btn-primary fw-medium d-flex align-items-center"
                        href="{{ route('admin.restaurants.create') }}">
                        <i class="fa-regular fa-plus me-1 text-secondary fs-5 vertical-center fw-bolder"></i>Aggiungi
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-dark table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th class="d-none d-lg-table-cell" scope="col">Immagine</th>
                                <th class="d-none d-sm-table-cell" scope="col">Indirizzo</th>
                                <th class="d-none d-md-table-cell" scope="col">Partita IVA</th>
                                <th class="d-none d-lg-table-cell" scope="col">Email</th>
                                <th class="d-none d-sm-table-cell" scope="col">Numero di telefono</th>
                                <th class="text-center" scope="col">Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($restaurants as $restaurant)
                                <tr class="align-middle">
                                    {{-- Name --}}
                                    <th scope="row">
                                        <a class="h5"
                                            href="{{ route('admin.restaurants.show', $restaurant) }}">{{ strCutter($restaurant->name, 30) }}
                                        </a>
                                    </th>
                                    {{-- Image --}}
                                    <td class="d-none d-lg-table-cell">
                                        <img src="{{ $restaurant->image ? $restaurant->image : $restaurant->types[0]->image }}"
                                            class="d-block img-preview" alt="{{ $restaurant->name }}" width="50">
                                    </td>
                                    {{-- Address --}}
                                    <td class="d-none d-sm-table-cell">
                                        {{ strCutter($restaurant->address, 30) }}
                                    </td>
                                    {{-- P. IVA --}}
                                    <td class="d-none d-md-table-cell">
                                        {{ $restaurant->p_iva }}
                                    </td>
                                    {{-- Email --}}
                                    <td class="d-none d-lg-table-cell">
                                        {{ strCutter($restaurant->email, 30) }}
                                    </td>
                                    {{-- Phone number --}}
                                    <td class="d-none d-sm-table-cell">
                                        {{ $restaurant->phone_num }}
                                    </td>

                                    {{-- Action Button --}}
                                    <td>
                                        <div
                                            class="d-flex gap-2 flex-wrap justify-content-center text-center align-items-center">

                                            <a class="btn btn-success bg-gradient"
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
                                                <button class="btn btn-secondary delete-button"
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
    @include('partials.delete-modal')
@endsection
