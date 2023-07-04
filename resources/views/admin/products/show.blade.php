@extends('layouts.admin')
@section('content')
    <div class="container text-white mt-5">
        <h1 class="text-center">{{ $product->name }}</h1>
        <div class="d-flex justify-content-between">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Prodotti</a></li>
                <li class="breadcrumb-item active">{{ $product->name }}</li>
            </ol>

        </div>
        <div class="row bg-dark justify-content-center rounded-5 py-5 px-4 ">
            <table class="table table-dark table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th class="d-none d-sm-table-cell" scope="col">Prezzo</th>
                        <th class="d-none d-sm-table-cell" scope="col">Descrizione</th>
                        <th class="d-none d-lg-table-cell" scope="col">Visibile</th>
                        <th class="text-center" scope="col">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="align-middle">
                        <th>
                            {{ $product->name }}
                        </th>
                        <td>
                            € {{ $product->price }}
                        </td>
                        <td>
                            {{ $product->description }}
                        </td>
                        <td>

                            @if ($product->visible)
                                Si
                            @else
                                No
                            @endif

                        </td>
                        <td>
                            <div>
                                <a class="btn btn-primary" href="{{ route('admin.products.edit', $product->slug) }}">
                                    <i class="fa-solid fa-pencil"></i>
                                </a>
                                <form class="m-0 p-0 d-inline-block"
                                    action="{{ route('admin.products.destroy', $product->slug) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-secondary delete-button" data-item-title="{{ $product->name }}"
                                        type="submit">
                                        <i class="fa-solid fa-eraser"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>


        </div>
    </div>
    @include('partials.delete-modal')
@endsection
