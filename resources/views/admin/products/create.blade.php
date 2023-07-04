@extends('layouts.admin')

@section('title')
    Nuovo Prodotto
@endsection

@section('content')
    <div class="container mb-5">
        <h2 class="mt-5 mb-4 text-center">
            Nuovo Prodotto
        </h2>
        <div class="d-flex justify-content-between">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Prodotti</a></li>
                <li class="breadcrumb-item active">Nuovo Prodotto</li>
            </ol>
            <p class="small muteWhite">* Campi obbligatori</p>
        </div>
    </div>

    <div class="container p-4 bg-dark rounded-2 mb-4">
        <div class="row">
            <div class="col">
                <form class="container form-crud" method="POST" action="{{ route('admin.products.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    {{-- Errors Section --}}
                    <div class="alert alert-danger mt-2 d-none" id="message_box"></div>
                    @if ($errors->any())
                        <div class="alert alert-danger mt-2">
                            @error('name')
                                <p>*{{ $message }}</p>
                            @enderror
                            @error('price')
                                <p>*{{ $message }}</p>
                            @enderror
                            @error('visible')
                                <p>*{{ $message }}</p>
                            @enderror
                            @error('image')
                                <p>*{{ $message }}</p>
                            @enderror
                            @error('description')
                                <p>*{{ $message }}</p>
                            @enderror
                            @error('restaurant_id')
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
                                    maxlength="100" required autofocus>
                                <label for="name">Nome *</label>
                            </div>
                        </div>
                    </div>
                    <!-- IMAGE/PRICE -->
                    <div class="row">
                        <!-- PRICE -->
                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input id="price" name="price" type="number"
                                    class="form-control @error('price') is-invalid @enderror" step="0.01" min="0"
                                    value="{{ old('price') }}" required>
                                <label for="price">Prezzo *</label>
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
                        <!-- DESCRIPTION -->
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
                        <div class="col-12 col-md-6 mb-3 text-center">
                            <h6>Visibile *</h6>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="visible" id="visible-true"
                                    value="1">
                                <label class="visible-true" for="inlineRadio1">Si</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="visible" id="visible-false"
                                    value="0">
                                <label class="form-check-label" for="visible-false">No</label>
                            </div>
                        </div>
                        <!-- RESTAURANTS -->
                        <div class="col-12 col-md-6 mb-3 text-center">
                            <h6>Ristorante *</h6>
                            <select name="restaurant_id" id="restaurant_id" class="form-select"
                                aria-label="Default select example">
                                <option value="">Ristorante a cui aggiungere il prodotto</option>
                                @foreach ($restaurants as $restaurant)
                                    <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
                                @endforeach
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
