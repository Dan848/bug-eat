@extends('layouts.admin')

@section('title')
    Ordine N°{{ $order->id }}
@endsection

@section('content')
    <div>Ciao</div>
    {{ $order->id }}
@endsection
