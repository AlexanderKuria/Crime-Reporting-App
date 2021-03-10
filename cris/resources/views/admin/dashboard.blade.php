@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-4">
            <div class="col-12">
                <span class="text-muted">Welcome </span>
                <span>{{ Auth::user()->name }}</span>
                <span class="text-muted">, you're logged in as admin.</span>
            </div>
            <div class="col-12">
                <div class="card mt-5">
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        <hr>
                        <div class="card-text">
                            <p>What you can do:</p>
                            <ul>
                                <li>Create Officer account</li>
                                <li>Edit Officer Details</li>
                                <li>
                                    View Number of Cases Assigned to Offer on Category, that is:
                                    <ol>
                                        <li>Assigned: Once that are currently active</li>
                                        <li>Closed: Once that have been processed and closed</li>
                                    </ol>
                                </li>
                            </ul>
                            <p class="font-weight-bold">Note: you cant:</p>
                            <ul>
                                <li>Create officer with similar email to other officer</li>
                                <li>You cant delete officer whose account has been assigned cases.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
