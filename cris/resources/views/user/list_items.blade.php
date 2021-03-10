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
                                <th>Item Name</th>
                                <th>By</th>
                                <th>Phone</th>
                                <th>Date Reported</th>
                                <th>Open Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            <tr>
                                <td>{{ $item->item }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->user->phone }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <a href="{{ route('item.show', $item->id) }}"
                                       class="btn btn-sm btn-outline-dark">Open</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-print-none">
                {{ $items->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
