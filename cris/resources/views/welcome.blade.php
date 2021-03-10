@extends('layouts.unauthenticated')

@section('navigation')
<nav class="navbar navbar-dark fixed-top navbar-expand-md bg-dark" role="navigation">
    <div class="container">
        <a href="/" class="navbar-brand">C.R.I.S</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#mainNav">
            <i class="navbar-toggler-icon"></i>
        </button>
        <div id="mainNav" class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ route('police.login') }}" class="nav-link">Police</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.login') }}" class="nav-link">Admin</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link">Login</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="nav-link">Create Account</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
@endsection

@section('content')
    <div class="container">
        <div class="card mt-4">
            <div class="card-body">
                <h4 class="card-title">What you're supposed to do:</h4>
                <hr>
                <div class="card-text">
                    <p>First before everything else you're required to create account:</p>
                    <p class="font-weight-bold">You are required:</p>
                    <ol class="font-weight-bold">
                        <li>Have a valid email address, one that is not registered</li>
                        <li>Phone number that is also not registered to user</li>
                        <li>Provide other details such as full name</li>
                    </ol>
                    <hr>
                    <div class="card-deck">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title font-weight-bold">Report Crime</h5>
                                <hr>
                                <div class="card-text">
                                    <p>You can report a crime that you have witnessed or experienced.</p>
                                    <p>All the follow up and progress of the case will be shared to you.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title font-weight-bold">Lost and Found</h5>
                                <hr>
                                <div class="card-text">
                                    <p>If get to find lost Item you can report it for the owner to find it.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
