@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h3 class="font-weight-bold card-title">Lost and Found Item Details</h3>
                <div class="row">
                    <div class="col-12 text-right d-print-none">
                        <a href="#" class="btn btn-sm btn-dark" onclick="window.print()">Print</a>
                    </div>
                    <div class="col mt-2">
                    </div>
                </div>
                <div class="row d-print-none">
                    <div class="col-12 text-right">
                        @can('update', $item)
                        <a href="{{ route('item.edit', $item->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                        @endcan
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12 col-md-2 text-muted">Item:</div>
                    <div class="col-sm-12 col-md-4">{{ $item->item }}</div>
                    <div class="col-sm-12 col-md-2 text-muted">Reported By:</div>
                    <div class="col-sm-12 col-md-4 text-muted">
                        @if(Auth::user()->id == $item->user_id)
                            <span class="text-primary">Me</span>
                        @else
                            {{$item->user->name}}
                        @endif
                    </div>
                    <div class="col-sm-12 col-md-2 text-muted">Collected:</div>
                    <div class="col-sm-12 col-md-4">
                        @if($item->collected == 'yes')
                            <span class="text-success">{{ __('Yes') }}</span>
                        @else
                            <span class="text-danger">{{ __('No') }}</span>
                        @endif
                    </div>
                    <div class="col-12 text-muted">Details</div>
                    <div class="col-12">{{ $item->description }}</div>
                    @if($item->image != 'no_image.jpg')
                    <div class="col-12">
                        <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->item }}" class="img-fluid">
                        <p class="text-muted font-italic">How it looks like:</p>
                    </div>
                    @endif
                </div>

            </div>
            @can('update', $item)
            <div class="card-footer">
                <span>Item is <span class="font-weight-bold">
                        @if ($item->collected == 'no')
                            {{ __('Not collected') }}
                        @else
                            {{ __('Collected') }}
                        @endif
                    </span> change to: </span>
                <a href="{{ route('item.state', $item->id) }}" class="btn btn-outline-dark btn-sm">
                    @if($item->collected == 'yes')
                        {{ __('Not Collected') }}
                    @else
                        {{ __('Collected') }}
                    @endif
                </a>
            </div>
            @endcan
        </div>
    </div>
@endsection
