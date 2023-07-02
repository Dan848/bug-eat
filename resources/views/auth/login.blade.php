@extends('layouts.app')

@section('content')

    <body class="">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card text-bg-dark shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header">
                                        <h3 class="text-center font-weight-light my-4">{{ __('Login') }}</h3>
                                    </div>
                                    <div class="card-body">
                                        <!-- FORM -->
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <!-- EMAIL -->
                                            <div class="form-floating mb-3">
                                                <input id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                                    value="{{ old('email') }}" required autocomplete="email" autofocus>
                                                <label for="inputEmail">{{ __('E-Mail Address') }}</label>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <!-- PASSWORD -->
                                            <div class="form-floating mb-3">
                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" required autocomplete="current-password">
                                                <label for="inputPassword">{{ __('Password') }}</label>
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <!-- REMEMBER -->
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="inputRememberPassword">{{ __('Remember Me') }}</label>
                                            </div>
                                            <!-- FORGOT PASSWORD & LOGIN -->
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                @if (Route::has('password.request'))
                                                    <a class="small text-secondary"
                                                        href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                                                @endif
                                                <button class="btn btn-primary" type="submit">{{ __('Login') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <a class="small text-secondary"
                                            href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                @include('partials.footer-admin')
            </div>
        </div>
    </body>
@endsection
