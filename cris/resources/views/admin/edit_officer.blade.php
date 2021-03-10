@extends('layouts.app')

@section('content')
    <div class="container middle-center-form">
        <form method="POST" action="{{ route('police.update', $officer->id) }}">
            @csrf
            @method('put')

            <div class="form-group">
                <label for="name">{{ __('Full Name') }}</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                       name="name"
                       value="@if(old('name')){{ old('name') }}@else{{ $officer->name }}@endif"
                       required autocomplete="name" autofocus>

                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">{{ __('E-Mail Address') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                       name="email"
                       value="@if(old('email')){{ old('email') }}@else{{ $officer->email }}@endif"
                       required autocomplete="email">

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="text-muted small">*Leave password blank if you don't want to change.</div>
            <div class="form-group">

                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                       name="password" autocomplete="new-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                        autocomplete="new-password">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-lg btn-block btn-dark">
                    {{ __('Update Officer') }}
                </button>
            </div>
        </form>
@endsection
