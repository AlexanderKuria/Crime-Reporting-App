@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <p>You're logged in with <span class="text-muted">{{ Auth::user()->email }}</span></p>
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">{{ __('Where do you want to go? ') }}</h3>
                    <hr>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="card-deck">
                        <a href="{{ route('crime.create') }}" class="card card-link">
                            <div class="card-body row">
                                <div class="col-3">
                                    <img src="{{ asset('fontawesome/svgs/solid/bell.svg') }}" alt="Report Crime">
                                </div>
                                <div class="col-9">
                                    <h4>Report Crime</h4>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('crime.index') }}" class="card card-link">
                            <div class="card-body row">
                                <div class="col-3">
                                    <img src="{{ asset('fontawesome/svgs/solid/check-double.svg') }}" alt="My Reported Crimes">
                                </div>
                                <div class="col-9">
                                    <h4>My Reported Crime(s)</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="mb-2"></div>
                    <div class="card-deck">
                        <a href="{{ route('item.create') }}" class="card card-link">
                            <div class="card-body row">
                                <div class="col-3">
                                    <img src="{{ asset('fontawesome/svgs/solid/street-view.svg') }}" alt="Report Lost and Found">
                                </div>
                                <div class="col-9">
                                    <h4>Report Lost and Found</h4>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('item.index') }}" class="card card-link">
                            <div class="card-body row">
                                <div class="col-3">
                                    <img src="{{ asset('fontawesome/svgs/solid/hiking.svg') }}" alt="Lost and Found I've Reported">
                                </div>
                                <div class="col-9">
                                    <h4>What I reported Lost and Found</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="mb-2"></div>
                    <div class="card-deck">
                        <a href="{{ route('items.allReported') }}" class="card card-link">
                            <div class="card-body row">
                                <div class="col-3">
                                    <img src="{{ asset('fontawesome/svgs/solid/user-check.svg') }}" alt="All Lost and Found">
                                </div>
                                <div class="col-9">
                                    <h4>All Lost and Found</h4>
                                </div>
                            </div>
                        </a>
                        <form class="card card-link"  action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="btn card-body row">
                                    <div class="col-3">
                                        <img src="{{ asset('fontawesome/svgs/solid/sign-out-alt.svg') }}" alt="Logout">
                                    </div>
                                    <div class="col-9">
                                        <h4>Logout</h4>
                                    </div>
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
