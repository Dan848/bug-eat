@extends('layouts.app')
@section('content')
    <div class="w-100 vh-100 px-5 d-flex justify-content-center align-items-center">
        <div class="d-flex align-items-center">
            <div class="display-1 fw-bolder d-inline align-middle m-0 p-0">
                Welcome to
                <span class="text-bg-primary px-3 rounded-start-3">Bug</span><span
                    class="text-bg-secondary px-3 rounded-end-3">Eat</span>
                {{-- <span class="text-primary">PRO</span><span class="text-secondary">JECT</span> --}}

            </div>
            {{-- <div class="img-box ms-2">
                <img class="img-fluid logo" src="" alt="logo" width="100px" height="100px">
            </div> --}}
        </div>
    </div>
    @include('partials.footer-admin')
@endsection
