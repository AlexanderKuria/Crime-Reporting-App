@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-12 mt-4 mb-4">
        <p>Welcome <span class="text-muted">{{ Auth::user()->name }}</span>, you're logged in as officer.</p>
    </div>
    <div class="col-12">
        <div class="card-deck mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">New Cases</h5>
                    <hr/>
                    <h2 class="font-weight-bold">Count: {{ $new_cases }}</h2>
                </div>
                <div class="card-footer">
                    <a href="{{ route('crimes.new') }}" class="btn btn-outline-primary btn-block">view</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">My cases</h5>
                    <hr/>
                    <h2 class="font-weight-bold">
                        <span>Count:</span>
                        <span>
                            {{ Auth::user()->assignedCrimes()->where(['status' =>'assigned'])->count() }}
                        </span>
                    </h2>
                </div>
                <div class="card-footer">
                    <a href="{{ route('crime.myCases') }}" class="btn btn-outline-dark btn-block">view</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">My Closed cases</h5>
                    <hr/>
                    <h2 class="font-weight-bold">
                        <span>Count:</span>
                        <span>
                            {{ Auth::user()->assignedCrimes()->where(['status' =>'closed'])->count() }}
                        </span>
                    </h2>
                </div>
                <div class="card-footer">
                    <a href="{{ route('crime.closed') }}" class="btn btn-outline-success btn-block">view</a>
                </div>
            </div>
        </div>
        <div class="card-deck">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">All Lost and Found</h5>
                    <hr/>
                    <h2 class="font-weight-bold">Count: {{ $reported_lost }}</h2>
                </div>
                <div class="card-footer">
                    <a href="{{ route('all_reported') }}" class="btn btn-success btn-block">view</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">No Owner</h5>
                    <hr/>
                    <h2 class="font-weight-bold">Count: {{ $no_owner }} </h2>
                </div>
                <div class="card-footer">
                    <a href="{{ route('allNotCollected') }}" class="btn btn-danger btn-block">view</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Collected</h5>
                    <hr/>
                    <h2 class="font-weight-bold">Count: {{ $collected }} </h2>
                </div>
                <div class="card-footer">
                    <a href="{{ route('allCollected') }}" class="btn btn-warning btn-block">view</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
