@extends('layouts.admin')

@section('title')
    {{ $restaurant->name }}
@endsection

@section('content')
    <div class="container text-white mt-5">
        <h1 class="text-center text-break">{{ $restaurant->name }}</h1>
        <div class="d-flex justify-content-between align-items-center">
            <ol class="breadcrumb mt-2 mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.restaurants.index') }}">Ristoranti</a></li>
                <li class="breadcrumb-item active">{{ strCutter($restaurant->name, 40) }}</li>
            </ol>
            <div>
                <a class="btn btn-light" href="{{ route('admin.menu.index', $restaurant) }}">
                    Menu <i class="ms-1 fa-solid fa-book-open"></i></i>
                </a>
                <a class="btn btn-primary" href="{{ route('admin.restaurants.edit', $restaurant->slug) }}">
                    <i class="fa-solid fa-pencil"></i>
                </a>
                <form class="mt-2 p-0 d-inline-block" action="{{ route('admin.restaurants.destroy', $restaurant->slug) }}"
                    method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-secondary delete-button" data-item-title="{{ $restaurant->name }}"
                        type="submit">
                        <i class="fa-solid fa-eraser"></i>
                    </button>
                </form>
            </div>
        </div>
        <div class="row bg-dark rounded-5 py-5 px-4 ">
            <div class="box-image justify-content-center d-flex mb-5 mb-lg-0 col-12 col-lg-6">
                <img src="{{ $restaurant->image ? $restaurant->image : $restaurant->types[0]->image }}"
                    alt="{{ $restaurant->name }}" class="object-fit-contain w-75" />
            </div>
            <div class="box-info col-12 col-lg-6">
                {{-- INFOS --}}
                <h2 class="text-secondary d-flex justify-content-center">
                    Info
                </h2>
                <hr />
                {{-- NAME --}}
                <div class="d-flex justify-content-between">
                    <div class="pixel-text">Nome:</div>
                    <div class="text-end text-break fw-bold">{{ strCutter($restaurant->name, 60) }}</div>
                </div>
                <hr />
                {{-- EMAIL --}}
                <div class="d-flex justify-content-between">
                    <div class="pixel-text"> Email:</div>
                    <div class="text-end text-break fw-bold"> {{ $restaurant->email }}</div>
                </div>
                <hr />
                {{-- PHONE NUMBER --}}
                <div class="d-flex justify-content-between">
                    <div class="pixel-text">Telefono:</div>
                    <div class="text-end text-break fw-bold"> {{ $restaurant->phone_num }}</div>
                </div>
                <hr />
                {{-- ADDRESS --}}
                <div class="d-flex justify-content-between">
                    <div class="pixel-text"> Indirizzo:</div>
                    <div class="text-end text-break fw-bold"> {{ $restaurant->address }}</div>
                </div>
                <hr />
                {{-- P. IVA --}}
                <div class="d-flex justify-content-between">
                    <div class="pixel-text"> Partita Iva:</div>
                    <div class="text-end text-break fw-bold"> {{ $restaurant->p_iva }}</div>
                </div>
                <hr />
                {{-- INVENTORY --}}
                <div>
                    <p class="text-center text-secondary">Tipologia/e:</p>
                    @foreach ($restaurant->types as $type)
                        @if (!$loop->last)
                            <a href="{{ route('admin.types.show', $type->slug) }}" class="fst-italic">{{ $type->name }}
                                - </a>
                        @else
                            <a href="{{ route('admin.types.show', $type->slug) }}" class="fst-italic">{{ $type->name }}
                            </a>
                        @endif
                    @endforeach
                </div>
                <hr />
            </div>
        </div>
    </div>
    @include('partials.delete-modal')
@endsection
