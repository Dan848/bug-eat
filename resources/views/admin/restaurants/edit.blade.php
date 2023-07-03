@extends('layouts.admin')

@section('title')
    Modifica {{$restaurant->name}}
@endsection

@section('content')
    <div class="container mb-5">
        <h2 class="mt-5 mb-4 text-center">
            Modifica {{$restaurant->name}}
        </h2>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.restaurants.update') }}">Ristoranti</a></li>
            <li class="breadcrumb-item active">Modifica {{$restaurant->name}}</li>
        </ol>
    </div>

    <div class="container p-4 bg-dark rounded-2 mb-4">
        <div class="row">
            <div class="col">
                <form class="container form-crud" method="POST" action="{{ route('admin.restaurants.store') }}"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    {{-- Errors Section --}}
                    @if ($errors->any())
                        <div class="alert alert-danger mt-2">
                            @error('name')
                                <p>*{{ $message }}</p>
                            @enderror
                            @error('email')
                                <p>*{{ $message }}</p>
                            @enderror
                            @error('p_iva')
                                <p>*{{ $message }}</p>
                            @enderror
                            @error('phone_num')
                                <p>*{{ $message }}</p>
                            @enderror
                            @error('image')
                                <p>*{{ $message }}</p>
                            @enderror
                            @error('address')
                                <p>*{{ $message }}</p>
                            @enderror
                        </div>
                    @endif
                    <!-- NAME/IMAGE -->
                    <div class="row">
                        <!-- NAME -->
                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autofocus>
                                <label for="name">Nome</label>
                            </div>
                        </div>
                        <!-- PHONE NUMBER -->
                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input id="phone_num" type="number"
                                    class="form-control @error('phone_num') is-invalid @enderror"
                                    name="phone_num" autofocus min="9" max="20">
                                <label class="mb-5" for="image">Telefono</label>
                            </div>
                        </div>
                    </div>
                    <!-- EMAIL/P.IVA -->
                    <div class="row">
                        <!-- EMAIL -->
                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autofocus>
                                <label for="email">Email</label>
                            </div>
                        </div>
                        <!-- P.IVA -->
                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input id="p_iva" type="number"
                                    class="form-control @error('p_iva') is-invalid @enderror" name="p_iva"
                                    value="{{ old('p_iva') }}" autofocus size="11">
                                <label class="mb-5" for="p_iva">Partita Iva</label>
                            </div>
                        </div>
                    </div>
                    <!--ADDRESS -->
                    <div class="row">
                        <!-- ADDRESS -->
                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input id="address" type="text"
                                    class="form-control @error('address') is-invalid @enderror" name="address"
                                    value="{{ old('address') }}" required autofocus>
                                <label for="address">Indirizzo</label>
                            </div>
                        </div>
                    </div>
                    <!-- TYPE -->
                    <div class="text-center mb-3 mt-4">
                        Categorie:
                    </div>
                    <div class="d-flex container-fluid justify-content-start align-items-center flex-wrap">
                        @foreach ($types as $type)
                            <div class="form-check col-6 col-md-4 col-lg-3">
                                <input type="checkbox" id="type[]" name="type[]" value="{{ $type->id }}"
                                    class="form-check-input" {{ in_array($type->id, old('type', [])) ? 'checked' : '' }}>
                                <label for="" class="form-check-label">{{ $type->name }}</label>
                            </div>
                        @endforeach
                    </div>
                    <!-- SAVE & RESET -->
                    <div class="d-flex align-items-center justify-content-center mt-4 mb-0">
                        <button class="btn btn-secondary me-2" type="reset">Reset</button>
                        <button class="btn btn-primary ms-2" type="submit">Modifica</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
