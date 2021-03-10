@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('item.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="item" class="font-weight-bold">Item Name</label>
                        <input type="text" class="form-control" id="item" placeholder="national id" name="item">
                        @error('item')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description" class="font-weight-bold">Description</label>
                        <textarea name="description" id="description"
                                  cols="30" rows="10" class="form-control"
                                  placeholder="name and details"></textarea>
                        @error('description')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image" class="font-weight-bold">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                        @error('image')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-lg btn-dark">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
