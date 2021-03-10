@extends('layouts.app')

@section('content')
    <div class="container">
        <card>
            <div class="card-body">
                <form action="{{ route('add.progress.submit', $crime->id) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" id="title">
                        @error('title')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="details">Details</label>
                        <textarea name="details" id="details" cols="30" rows="10" class="form-control"></textarea>
                        @error('details')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group justify-content-between">
                        <button type="submit" class="btn btn-dark btn-lg">Add</button>
                    </div>
                </form>
            </div>
        </card>
    </div>
@endsection
