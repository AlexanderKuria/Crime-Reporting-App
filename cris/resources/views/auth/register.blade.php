@extends('layouts.unauthenticated')

@section('content')
<div class="container">
    <form method="POST" class="registrationForm" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label for="name">{{ __('Full Name') }}</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                   name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">{{ __('E-Mail Address') }}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                   name="email" value="{{ old('email') }}" required autocomplete="email"pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" >

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="phone">{{ __('Phone Number') }}</label>
            <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror"
                   name="phone" value="{{ old('phone') }}" required autocomplete="phone"required pattern="[07][0-9]{9}" minlength="10" maxlength="10" id="mobno" onfocusout="f1()"/>
                   

            @error('phone')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                   name="password" required autocomplete="new-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password-confirm">{{ __('Confirm Password') }}</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                   required autocomplete="new-password">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-lg btn-block btn-success">
                {{ __('Create Account') }}
            </button>
        </div>
        <div class="form-group">
            <div class="text-right">
                <span>Already have account?</span>
                <a href="{{ route('login') }}" class="btn btn-link">Sign In</a>
            </div>
        </div>
    </form>
@endsection
