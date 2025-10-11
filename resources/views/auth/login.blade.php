@extends('layout.app')

@section('content')
<div class="container my-3">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow">
                <h4 class="card-header text-center text-white" style="background-color: #5C3422">{{ __('Sign In') }}</h4>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>

                            <div class="">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-form-label">{{ __('Password') }}</label>

                            <div class="">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="d-flex align-items-center flex-column">
                                <button type="submit" class="btn text-white px-5" style="background-color: #5C3422">
                                    {{ __('Sign In') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link text-dark mt-2 w-100 text-end" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
