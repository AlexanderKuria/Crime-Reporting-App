@extends('layouts.app')

@section('content')
    <div class="container">
        @if($items->count() > 0)
        @foreach($items as $item)
            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title">Item: <span class="text-muted">{{ $item->item }}</span></h5>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12 col-md-5">
                            <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->$item }}" class="img-fluid">
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <p class="text-muted">Description:</p>
                            <p>{{ $item->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{ $items->links() }}
        @else
            <div class="card mt-4">
                <div class="card-body">
                    <h3 class="text-muted text-center">Sorry no items on this category</h3>
                </div>
            </div>
        @endif
    </div>
@endsection
