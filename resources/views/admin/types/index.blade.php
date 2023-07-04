@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4 text-center">Tipi</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Tipo</li>
        </ol>
        <div class="card text-bg-dark mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div><i class="fa-solid fa-store me-2"></i></i>Tipi</div>
            </div>
            <div class="card-body">
                <table class="table table-dark table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="d-none d-lg-table-cell" scope="col">Immagine</th>
                            <th class="col text-end">Nome</th>
                            <th class="col text-end">N° Ristoranti associati</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($types as $type)
                            <tr class="align-middle text-end">
                                {{-- Image --}}
                                <td class="d-none d-lg-table-cell">
                                    <img src="{{ $type->image }}" class="d-block img-preview" alt="{{ $type->name }}"
                                        width="30">
                                </td>
                                {{-- Name --}}
                                <td scope="row text-end">
                                    {{ $type->name }}
                                </td>
                                {{-- Numero ristoranti --}}
                                <td scope="row">
                                    {{ $type->restaurants->where('user_id', Auth::id())->count() }}
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
