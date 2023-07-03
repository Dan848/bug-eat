@extends('layouts.admin')

@section('title')
    Nuovo Ristorante
@endsection

@section('content')
    <div class="container mb-5">
        <h2 class="mt-5 mb-4 text-center">
            Nuovo Ristorante
        </h2>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.restaurants.index') }}">Ristoranti</a></li>
            <li class="breadcrumb-item active">Nuovo Ristorante</li>
        </ol>
    </div>

    <div class="container p-4 bg-dark rounded-2 mb-4">
        <div class="row">
            <div class="col">
                <form class="container form-crud" method="POST" action="{{ route('admin.restaurants.store') }}"
                    enctype="multipart/form-data" id="create_form">
                    @csrf
                    {{-- Errors Section --}}
                    <div class="alert alert-danger mt-2 d-none" id="message_box"></div>
                    @if ($errors->any())
                        <div class="alert alert-danger mt-2">
                            @error('name')
                                <p>*{{ $message }}</p>
                            @enderror
                            @error('email')
                                <p>*{{ $message }}</p>
                            @enderror
                            @error('phone_num')
                                <p>*{{ $message }}</p>
                            @enderror
                            @error('address')
                                <p>*{{ $message }}</p>
                            @enderror
                            @error('p_iva')
                                <p>*{{ $message }}</p>
                            @enderror
                            @error('types[]')
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
                    <!-- EMAIL/PHONE_NUM -->
                    <div class="row">
                        <!-- EMAIL -->
                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input id="email" name="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                    max="255" required>
                                <label for="email">Email</label>
                            </div>
                        </div>
                        <!-- PHONE NUMBER -->
                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input id="phone_num" name="phone_num" type="text"
                                    class="form-control @error('phone_num') is-invalid @enderror" required
                                    value="{{ old('phone_num') }}" min="9" max="20">
                                <label class="mb-5" for="image">Telefono</label>
                            </div>
                        </div>
                    </div>
                    <!--ADDRESS/P_IVA -->
                    <div class="row">
                        <!-- ADDRESS -->
                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input id="address" name="address" type="text"
                                    class="form-control @error('address') is-invalid @enderror"
                                    value="{{ old('address') }}" max="255" required>
                                <label for="address">Indirizzo</label>
                            </div>
                        </div>
                        <!-- P.IVA -->
                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input id="p_iva" name="p_iva" type="text"
                                    class="form-control @error('p_iva') is-invalid @enderror" value="{{ old('p_iva') }}"
                                    required size="11">
                                <label class="mb-5" for="p_iva">Partita Iva</label>
                            </div>
                        </div>
                    </div>
                    <!-- IMAGE -->
                    <div class="display-grid mb-3 mt-4">
                        <h6 class="g-col text-center pb-3">Seleziona un immagine:</h6>
                    </div>
                    <div class="row justify-content-center g-5">
                        <!-- Upload Yours -->

                        <!-- Select -->
                        @foreach ($types as $type)
                            <div class="col-6 col-md-2">
                                <label class="image-radio">
                                    <input type="radio" value="{{ $type->image }}" class="" name="image"
                                        id="image-{{ $type->id }}" autocomplete="off">
                                    <img src="{{ $type->image }}" alt="{{ $type->name }}">
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <!-- TYPE -->
                    <div class="text-center mb-3 mt-4">
                        <h6>Tipologia:</h6>
                    </div>
                    <div class="row container-fluid justify-content-start align-items-center flex-wrap">
                        @foreach ($types as $type)
                            <div class="form-check col-6 col-md-4 col-lg-3">
                                <input type="checkbox" id="types[]" name="types[]" value="{{ $type->id }}"
                                    class="form-check-input" {{ in_array($type->id, old('type', [])) ? 'checked' : '' }}>
                                <label for="" class="form-check-label">{{ $type->name }}</label>
                            </div>
                        @endforeach
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
