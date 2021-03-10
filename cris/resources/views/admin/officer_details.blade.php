@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="font-weight-bold card-title">Officer Details</h5>
                <hr>
                <div class="row">
                    <div class="col-sm-12 col-md-2 text-muted">Name</div>
                    <div class="col-sm-12 col-md-4">{{ $officer->name }}</div>
                    <div class="col-sm-12 col-md-2 text-muted">Email</div>
                    <div class="col-sm-12 col-md-4">{{ $officer->email }}</div>
                    <div class="col-sm-12 col-md-2 text-muted">Date Registered</div>
                    <div class="col-sm-12 col-md-4">{{ $officer->created_at }}</div>
                    <div class="col-12"></div>
                    <div class="col-sm-12 col-md-2 text-muted">Total cases:</div>
                    <div class="col-sm-12 col-md-4">{{ $officer->assignedCrimes()->count() }}</div>
                </div>
                @if($officer->assignedCrimes()->count() > 0)
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <h5 class="text-muted">Case Details:</h5>
                        </div>
                        <div class="col-sm-12 col-md-2 text-muted">Open Cases</div>
                        <div class="col-sm-12 col-md-4">
                            {{ $officer->assignedCrimes()->where(['status' => 'assigned'])->count() }}
                        </div>
                        <div class="col-sm-12 col-md-2 text-muted">Closed Cases</div>
                        <div class="col-sm-12 col-md-4">
                            {{ $officer->assignedCrimes()->where(['status' => 'closed'])->count() }}
                        </div>
                    </div>
                @endif
            </div>
            <div class="card-footer text-right row">
                <div class="col-6">
                    <a href="{{ route('police.edit', $officer->id) }}" class="btn btn-block btn-sm btn-outline-dark mr-1">Edit</a>
                </div>
                <div class="col-6">
                    <form action="{{ route('police.destroy', $officer->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-block btn-sm btn-outline-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
