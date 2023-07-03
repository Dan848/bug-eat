@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4 text-center">Tipo</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Tipo</li>
        </ol>
        <div class="card text-bg-dark mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div><i class="fa-solid fa-people-group me-1"></i>Tipo</div>
                <a class="btn btn-primary fw-medium d-flex align-items-center" href="{{ route('admin.types.create') }}">
                    <i class="fa-regular fa-plus me-1 text-secondary fs-5 vertical-center fw-bolder"></i>Aggiungi
                </a>
            </div>
            <div class="card-body">
                <table class="table table-dark table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="d-none d-lg-table-cell"scope="col">Immagine</th>
                            <th class="col">Nome</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th class="col">N° Ristoranti associati</th>

                            <th class="text-center" scope="col">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($types as $type)
                            <tr class="align-middle">
                                {{-- Image --}}
                                <td class="d-none d-lg-table-cell">
                                    <img src="{{ $type->image }}" class="d-block img-preview" alt="{{ $type->name }}"
                                        width="30">
                                </td>
                                {{-- Name --}}
                                <th scope="row">
                                    <a class="h5"
                                        href="{{ route('admin.types.show', $type->slug) }}">{{ $type->name }}
                                    </a>
                                </th>
                                <th></th>
                                <th></th>
                                <th></th>
                                {{-- Numero ristoranti --}}
                                <th scope="row">
                                    {{ $type->restaurants->where('user_id', Auth::id())->count() }}
                                </th>

                                {{-- Action Button --}}
                                <td>
                                    <div
                                        class="d-flex gap-2 flex-wrap justify-content-center text-center align-items-center">

                                        <a class="btn btn-success bg-gradient"
                                            href="{{ route('admin.types.show', $type->slug) }}"> <i
                                                class="fa-solid fa-eye"></i>
                                        </a>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('partials.delete-modal')
@endsection
