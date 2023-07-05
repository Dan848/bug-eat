@extends('layouts.admin')

@section('title')
    {{ $restaurant->name }}
@endsection

@section('content')
    <div class="container text-white mt-5">
        <h1 class="text-center">{{ $restaurant->name }}</h1>
        <div class="d-flex justify-content-between">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.restaurants.index') }}">Ristoranti</a></li>
                <li class="breadcrumb-item active">{{ $restaurant->name }}</li>
            </ol>
            <div>
                <a class="btn btn-primary" href="{{ route('admin.restaurants.edit', $restaurant->slug) }}">
                    <i class="fa-solid fa-pencil"></i>
                </a>
                <form class="m-0 p-0 d-inline-block" action="{{ route('admin.restaurants.destroy', $restaurant->slug) }}"
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
                <p class="d-flex justify-content-between">
                    <span class="pixel-text">Nome:</span>
                    <span class="fw-bold"> {{ $restaurant->name }}</span>
                </p>
                <hr />
                {{-- EMAIL --}}
                <p class="d-flex justify-content-between">
                    <span class="pixel-text"> Email:</span>
                    <span class="fw-bold"> {{ $restaurant->email }}</span>
                </p>
                <hr />
                {{-- PHONE NUMBER --}}
                <p class="d-flex justify-content-between">
                    <span class="pixel-text">Telefono:</span>
                    <span class="fw-bold"> {{ $restaurant->phone_num }}</span>
                </p>
                <hr />
                {{-- ADDRESS --}}
                <p class="d-flex justify-content-between">
                    <span class="pixel-text"> Indirizzo:</span>
                    <span class="fw-bold"> {{ $restaurant->address }}</span>
                </p>
                <hr />
                {{-- P. IVA --}}
                <p class="d-flex justify-content-between">
                    <span class="pixel-text"> Partita Iva:</span>
                    <span class="fw-bold"> {{ $restaurant->p_iva }}</span>
                </p>
                <hr />
                {{-- INVENTORY --}}
                <div>
                    <p class="text-center text-secondary">Tipologia/e:</p>
                    @foreach ($restaurant->types as $type)
                        @if (!$loop->last)
                            <a href="{{route('admin.types.show' , $type->slug)}}" class="fst-italic">{{ $type->name }} - </a>
                        @else
                             <a href="{{route('admin.types.show' , $type->slug)}}" class="fst-italic">{{ $type->name }} </a>
                        @endif
                    @endforeach
                </div>
                <hr />
            </div>
        </div>
    </div>
    @include('partials.delete-modal')
@endsection
