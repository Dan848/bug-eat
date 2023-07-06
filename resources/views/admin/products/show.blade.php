@extends('layouts.admin')

@section('title')
    {{ $product->name }}
@endsection

@section('content')
    <div class="container text-white mt-5">
        <h1 class="text-center text-break">{{ $product->name }}</h1>
        <div class="d-flex justify-content-between align-items-center">
            <ol class="breadcrumb mt-2 mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.menu.index', $product->restaurant) }}">Prodotti</a></li>
                <li class="breadcrumb-item active">{{ strCutter($product->name, 40) }}</li>
            </ol>
            <div>
                <a class="btn btn-primary" href="{{ route('admin.products.edit', $product->slug) }}">
                    <i class="fa-solid fa-pencil"></i>
                </a>
                <form class="mt-2 p-0 d-inline-block" action="{{ route('admin.products.destroy', $product->slug) }}"
                    method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-secondary delete-button" data-item-title="{{ $product->name }}" type="submit">
                        <i class="fa-solid fa-eraser"></i>
                    </button>
                </form>
            </div>
        </div>
        <div class="row bg-dark rounded-5 py-5 px-4 ">
            <div
                class="{{ $product->image ? '' : 'd-none' }} box-image justify-content-center d-flex mb-5 mb-lg-0 col-12 col-lg-6">
                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="object-fit-contain w-75" />
            </div>
            <div class="box-info col-12 {{ $product->image ? 'col-lg-6' : '' }}">
                {{-- INFOS --}}
                <h2 class="text-secondary d-flex justify-content-center">
                    Info
                </h2>
                <hr />
                {{-- NAME --}}
                <div class="d-flex justify-content-between">
                    <div class="pixel-text">Nome:</div>
                    <div class="text-end text-break fw-bold">{{ strCutter($product->name, 60) }}</div>
                </div>
                <hr />
                {{-- PRICE --}}
                <div class="d-flex justify-content-between">
                    <div class="pixel-text"> Prezzo:</div>
                    <div class="text-end text-break fw-bold"> € {{ $product->price }}</div>
                </div>
                <hr />
                {{-- VISIBLE --}}
                <div class="d-flex justify-content-between">
                    <div class="pixel-text"> Visibile:</div>
                    <div class="text-end text-break fw-bold"> {{ $product->visible ? 'Si' : 'No' }}</div>
                </div>
                <hr />
                {{-- VISIBLE --}}
                <div class="d-flex justify-content-between">
                    <div class="pixel-text"> Ristorante:</div>
                    <div class="text-end text-break fw-bold"> {{ $product->restaurant->name }}</div>
                </div>
                <hr />
                {{-- DESCRIPTION --}}
                <div>
                    <div class="text-center text-secondary">Descrizione:</div>
                    <p>{{ $product->description ? "$product->description" : 'Nessuna descrizione' }}</p>
                </div>
                <hr />
            </div>
        </div>
    </div>
    @include('partials.delete-modal')
@endsection
