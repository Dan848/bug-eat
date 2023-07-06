@extends('layouts.admin')

@section('title')
    Modifica {{ $restaurant->name }}
@endsection

@section('content')
    <div class="container mb-5">
        <h2 class="mt-5 mb-4 text-center text-break">
            Modifica {{ $restaurant->name }}
        </h2>
        <div class="d-flex justify-content-between">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.restaurants.index') }}">Ristoranti</a></li>
                <li class="breadcrumb-item active">Modifica {{ strCutter($restaurant->name, 40) }}</li>
            </ol>
            <p class="small muteWhite">* Campi obbligatori</p>
        </div>
    </div>

    <div class="container p-4 bg-dark rounded-2 mb-4">
        <div class="row">
            <div class="col">
                <form class="container form-crud" method="POST"
                    action="{{ route('admin.restaurants.update', $restaurant->slug) }}" enctype="multipart/form-data">
                    @method('PUT')
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
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ $restaurant->name }}" maxlength="100" required autofocus>
                                <label for="name">Nome *</label>
                            </div>
                        </div>
                    </div>
                    <!-- EMAIL/PHONE_NUM -->
                    <div class="row">
                        <!-- EMAIL -->
                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input id="email" name="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ $restaurant->email }}" maxlength="255" required>
                                <label for="email">Email *</label>
                            </div>
                        </div>
                        <!-- PHONE NUMBER -->
                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input id="phone_num" name="phone_num" type="text"
                                    class="form-control @error('phone_num') is-invalid @enderror" required
                                    value="{{ $restaurant->phone_num }}" minlength="9" maxlength="16">
                                <label class="mb-5" for="image">Telefono *</label>
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
                                    value="{{ $restaurant->address }}" maxlength="255" required>
                                <label for="address">Indirizzo *</label>
                            </div>
                        </div>
                        <!-- P.IVA -->
                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input id="p_iva" name="p_iva" type="text"
                                    class="form-control @error('p_iva') is-invalid @enderror"
                                    value="{{ $restaurant->p_iva }}" required minlength="11" maxlength="">
                                <label class="mb-5" for="p_iva">Partita Iva *</label>
                            </div>
                        </div>
                    </div>
                    <!-- IMAGE -->
                    <div class="d-flex mb-0 mt-4">
                        <div class="col-4"></div>
                        <h6 class="col-4 text-center">Immagine *</h6>
                        <!-- Switch -->
                        <div class="col-4 d-flex justify-content-end form-check form-switch">
                            <input name="imageSwitch" id="imageSwitch" class="form-check-input" type="checkbox"
                                role="switch">
                            <label class="form-check-label" for="imageSwitch">Carica / Seleziona</label>
                        </div>
                    </div>
                    <div class="row justify-content-center g-5">
                        <!-- Upload File -->
                        <div class="col-12 upload-col">
                            <div class="form-floating mb-3">
                                <input id="image" type="file"
                                    class="form-control @error('image') is-invalid @enderror" name="image"
                                    accept="image/*" size="1" autofocus>
                            </div>
                        </div>
                        <!-- Select Image -->
                        @foreach ($types as $type)
                            <div class="mt-5 d-none col-6 col-md-2 radio-col">
                                <label class="image-radio mt-5">
                                    <input type="radio" value="{{ $type->image }}" class="radio-btn" name="image"
                                        id="image-{{ $type->id }}" autocomplete="off">
                                    <img src="{{ $type->image }}" alt="{{ $type->name }}">
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <!-- TYPE -->
                    <div class="text-center mb-3 mt-4">
                        Categorie: *
                    </div>
                    <div class="d-flex container-fluid justify-content-start align-items-center flex-wrap">
                        @foreach ($types as $type)
                            <div class="form-check col-6 col-md-4 col-lg-3">
                                @if ($errors->any())
                                    <input type="checkbox" name="types[]" value="{{ $type->id }}"
                                        class="form-check-input"
                                        {{ in_array($type->id, old('types', [])) ? 'checked' : '' }}>
                                @else
                                    <input type="checkbox" name="types[]" value="{{ $type->id }}"
                                        class="form-check-input"
                                        {{ $restaurant->types->contains($type) ? 'checked' : '' }}>
                                @endif
                                <label for="" class="form-check-label">{{ $type->name }}</label>
                            </div>
                        @endforeach
                    </div>
                    <!-- SAVE & RESET -->
                    <div class="d-flex align-items-center justify-content-center mt-4 mb-0">
                        <button class="btn btn-secondary me-2" type="reset">Reset</button>
                        <button id="btn-sub" class="btn btn-primary ms-2" type="submit">Modifica</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
