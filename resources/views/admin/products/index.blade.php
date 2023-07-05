@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4 text-center">I tuoi Prodotti</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Prodotti</li>
        </ol>
        {{-- SELECT RESTAURANT  --}}
        <div class="card text-bg-dark mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="d-flex ">
                    <div class="d-flex align-items-center text-nowrap me-3">
                        <i class="fa-solid fa-drumstick-bite me-2"></i></i>Prodotti di:
                    </div>
                    <select name="restaurant_id" id="restaurant_id" class="form-select d-inline"
                        aria-label="Default select example">
                        <option value="">I tuoi ristoranti</option>
                        @foreach ($restaurants as $restaurant)
                            <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
                        @endforeach
                    </select>
                </div>

                <a class="btn btn-primary fw-medium d-flex align-items-center" href="{{ route('admin.products.create') }}">
                    <i class="fa-regular fa-plus me-1 text-secondary fs-5 vertical-center fw-bolder"></i>Aggiungi
                </a>
            </div>
            <div class="card-body">
                <table class="table table-dark table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th class="d-none d-sm-table-cell" scope="col">Price</th>
                            <th class="d-none d-lg-table-cell" scope="col">Visibile</th>
                            <th class="text-center" scope="col">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr class="align-middle">
                                {{-- Name --}}
                                <th scope="row">
                                    <a class="h5"
                                        href="{{ route('admin.products.show', $product) }}">{{ strlen($product->name) > 30 ? substr($product->name, 0, 30) . '...' : $product->name }}
                                    </a>
                                </th>
                                {{-- Price --}}
                                <td class="d-none d-sm-table-cell text-nowrap">
                                    € {{ $product->price }}
                                </td>
                                {{-- Visible --}}
                                <td class="d-none d-lg-table-cell">
                                    {{ $product->visible ? 'Si' : 'No' }}
                                </td>

                                {{-- Action Button --}}
                                <td>
                                    <div
                                        class="d-flex gap-2 flex-wrap justify-content-center text-center align-items-center">
                                        <a class="btn btn-success bg-gradient"
                                            href="{{ route('admin.products.show', $product->slug) }}">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a class="btn btn-primary"
                                            href="{{ route('admin.products.edit', $product->slug) }}">
                                            <i class="fa-solid fa-pencil"></i>
                                        </a>
                                        <form class="m-0 p-0 d-inline-block"
                                            action="{{ route('admin.products.destroy', $product->slug) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-secondary delete-button"
                                                data-item-title="{{ $product->name }}" type="submit">
                                                <i class="fa-solid fa-eraser"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $products->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>
    </div>

    @include('partials.delete-modal')
@endsection
