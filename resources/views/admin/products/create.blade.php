@extends('layouts.admin')

@section('title')
    Nuovo Prodotto
@endsection

@section('content')
    <div class="container mb-5">
        <h2 class="mt-5 mb-4 text-center">
            Nuovo Prodotto
        </h2>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Prodotti</a></li>
            <li class="breadcrumb-item active">Nuovo Prodotto</li>
        </ol>
    </div>

    <div class="container p-4 bg-dark rounded-2 mb-4">
        <div class="row">
            <div class="col">
                <form class="container form-crud" method="POST" action="{{ route('admin.products.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    {{-- Errors Section --}}
                    @if ($errors->any())
                        <div class="alert alert-danger mt-2">
                            @error('name')
                                <p>*{{ $message }}</p>
                            @enderror
                            @error('price')
                                <p>*{{ $message }}</p>
                            @enderror
                        </div>
                    @endif
                    <!-- NAME -->
                    <div class="row">
                        <!-- NAME -->
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <input id="name" name="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                    max="100" required autofocus>
                                <label for="name">Nome</label>
                            </div>
                        </div>
                    </div>
                    <!-- IMAGE/PRICE -->
                    <div class="row">
                        <!-- PRICE -->
                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input id="price" name="price" type="number"
                                    class="form-control @error('price') is-invalid @enderror" max="255" required>
                                <label for="email">Prezzo</label>
                            </div>
                        </div>
                        <!-- IMAGE -->
                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input id="image" type="file"
                                    class="form-control @error('image') is-invalid @enderror" name="image" autofocus>
                                <label class="mb-5" for="image">Immagine</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- DESCRIPTIONS -->
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <textarea id="type" name="description" class="form-control" id="description" rows="5">{{ old('description') }}</textarea>
                                <label for="description">Descrizione</label>
                            </div>
                        </div>
                    </div>
                    <!-- VISIBLE/RESTAURANTS -->
                    <div class="row">
                        <!-- VISIBLE -->
                        <div class="col-12 col-md-6">
                            <div class="display-grid mb-3">
                                <h6 class="g-col">Imposta se il prodotto è disponibile</h6>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">No/Si</label>
                                </div>
                            </div>
                        </div>
                        <!-- RESTAURANTS -->
                        <div class="col-12 col-md-6">
                            <select class="form-select" aria-label="Default select example">
                                <option selected value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                    <!-- SAVE & RESET -->
                    <div class="d-flex align-items-center justify-content-center mt-4 mb-0">
                        <button class="btn btn-secondary me-2" type="reset">Reset</button>
                        <button class="btn btn-primary ms-2" type="submit">Crea</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
