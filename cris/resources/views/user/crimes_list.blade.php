@extends('layouts.app')

@section('content')
    <div class="card container">
        <div class="card-body">
            <div class="row">
                <div class="col-12 text-right d-print-none">
                    <a href="#" class="btn btn-sm btn-dark" onclick="window.print()">Print</a>
                </div>
                <div class="col mt-2">
                </div>
            </div>
            <div class="row d-print-none">
                <div class="col-12">
                    <a href="{{ route('crime.create') }}"
                       class="btn btn-sm btn-outline-success text-right">Create</a>
                </div>
                <div class="col-12 mt-2">
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>For</th>
                            <th>Date Reported</th>
                            <th>Officer-In-charge</th>
                            <th>Open</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($crimes as $crime)
                        <tr>
                            <td>{{ $crime->for }}</td>
                            <td>{{ $crime->created_at }}</td>
                            <td>
                                @if ($crime->police)
                                    {{ $crime->police->name }}
                                @else
                                    {{ __('Not Processed') }}
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('crime.show', $crime->id) }}"
                                   class="btn btn-sm btn-outline-dark">Open</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-print-none">
                {{ $crimes->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
