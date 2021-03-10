@extends('layouts.app')

@section('content')
<div class="container middle-center-form">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.profile.update', $admin->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name" class="font-weight-bold">Name</label>
                    <input type="text" name="name" class="form-control" id="name" 
                        value="@if(old('name')){{ old('name')}}@else{{ $admin->name }}@endif">
                    @error('name')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" value="{{ $admin->email }}" readonly class="readonly">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Update Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection