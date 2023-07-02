@extends('layouts.admin')

@section('content')
    <h1>Index Restaurants</h1>
    <div class="text-end">
        <a class="btn btn-success" href="{{ route('admin.restaurants.create') }}">Crea nuovo Progetto</a>
    </div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Image</th>
                <th scope="col">Created</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($restaurants as $restaurant)
                <tr>
                    <th scope="row">{{ $restaurant->id }}</th>
                    <td>{{ $restaurant->title }}</td>
                    <td><img class="img-thumbnail" style="width:100px" src="{{ $restaurant->image }}"
                            alt="{{ $restaurant->title }}">
                    </td>
                    <td>{{ $restaurant->created_at }}</td>
                    <td><a href="{{ route('admin.restaurants.show', $restaurant) }}"><i class="fa-solid fa-eye"></i></a>
                        <a href="{{ route('admin.restaurants.edit', $restaurant) }}"><i class="fa-solid fa-pencil"></i></a>
                        <form action="{{ route('admin.restaurants.destroy', $restaurant) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type='submit' class="delete-button" data-item-title="{{ $restaurant->title }}"> <i
                                    class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
