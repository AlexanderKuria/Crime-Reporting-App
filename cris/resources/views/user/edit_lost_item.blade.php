@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">

                <form action="{{ route('item.update', $item->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="item" class="font-weight-bold">Item Name</label>
                        <input type="text" class="form-control" id="item"
                               placeholder="national id" name="item"
                               value="@if(old('item')){{ old('item') }}@else{{ $item->item }}@endif"
                        >
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
                                  placeholder="name and details"
                        >@if(old('description')){{ old('description') }}@else{{ $item->description }}@endif</textarea>
                        @error('description')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button class="btn btn-lg btn-dark">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
