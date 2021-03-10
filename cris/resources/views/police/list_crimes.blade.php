@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 text-right d-print-none">
                        <a href="#" class="btn btn-sm btn-dark" onclick="window.print()">Print</a>
                    </div>
                    <div class="col mt-2">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Date Reported</th>
                                <th>Reported By</th>
                                <th>Where</th>
                                <th>Reason</th>
                                <th>Open</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($crimes as $crime)
                            <tr>
                                <td>{{ $crime->created_at }}</td>
                                <td>{{ $crime->user->name }}</td>
                                <td>{{ $crime->location }}</td>
                                <td>{{ $crime->for }}</td>
                                <td>
                                    <a href="{{ route('crime.details', $crime) }}" class="btn btn-sm btn-outline-dark">Open</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-print-none">
                {{ $crimes->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
