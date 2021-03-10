@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="font-weight-bold card-title">{{ __('Registered Officers') }}</h5>
                <hr>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Name</th>
                                <th>Date Registered</th>
                                <th>Show Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($police as $officer)
                            <tr>
                                <td>{{ $officer->email }}</td>
                                <td>{{ $officer->name }}</td>
                                <td>{{ $officer->created_at }}</td>
                                <td>
                                    <a href="{{ route('police.show', $officer->id) }}"
                                       class="btn btn-sm btn-outline-dark">Open</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $police->links() }}
            </div>
        </div>
    </div>
@endsection
