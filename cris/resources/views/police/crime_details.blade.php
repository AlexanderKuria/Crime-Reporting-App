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
                @include('police.crime_details_layout')
                <hr>
                @can('updateState', $crime)
                <a href="{{ route('case.close', $crime->id) }}" class="btn btn-sm btn-dark">Close Case</a>
                @endcan
            </div>
            @if($crime->status == 'unassigned')
            <div class="card-footer">
                @include('police.assign_case_layout')
            </div>
            @endif
        </div>
    </div>
@endsection
