@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-details font-weight-bold">Crime Details</h4>
                <hr>
                <div class="row d-print-none">
                    <div class="col-12 text-right">
                        <a href="#" class="btn btn-sm btn-dark" onclick="window.print()">Print</a>
                    </div>
                    <div class="col mt-2">
                    </div>
                </div>
                <div class="row d-print-none">
                    @can('update', $crime)
                    <div class="col-12">
                        <a href="{{ route('crime.edit', $crime->id) }}"
                           class="btn btn-sm btn-primary float-right">Edit</a>
                    </div>
                    @endcan
                </div>
                <hr>
                <div class="row">
                    <div class="col-12 row">
                        <div class="col-sm-12 col-md-2 text-muted">What Reason</div>
                        <div class="col-sm-12 col-md-4">{{ $crime->for }}</div>
                        <div class="col-sm-12 col-md-2 text-muted">Date Reported</div>
                        <div class="col-sm-12 col-md-4">{{ $crime->created_at }}</div>
                        <div class="col-sm-12 col-md-2 text-muted">Crime Status</div>
                        <div class="col-sm-12 col-md-4">
                            @if ($crime->status == 'closed')
                                {{__('Case Completed and is Closed')}}
                            @elseif($crime->status == 'assigned')
                                {{ __('Case is open(Ongoing)') }}
                            @else
                                {{__('Case is not yet processed')}}
                            @endif
                        </div>
                        <div class="col-sm-12 col-md-2 text-muted">Assigned To:</div>
                        <div class="col-sm-12 col-md-4">
                            @if ( $crime->police )
                                {{$crime->police->name}}({{ $crime->police->email }})
                            @else
                                {{ _('No Officer Assigned') }}
                            @endif
                        </div>
                    </div>
                    <div class="col-12 row">
                        <div class="col-12 text-muted">Details:</div>
                        <div class="col-12">{{ $crime->details }}</div>
                    </div>
                    <div class="col-12">
                        @if($crime->progresses()->count() > 0)
                            @foreach($crime->progresses as $progress)
                                <div class="col-sm-12 col-md-2 text-muted">For:</div>
                                <div class="col-sm-12 col-md-10">{{ $progress->title }}</div>
                                <div class="col-sm-12 col-md-2 text-muted">Date Recorded:</div>
                                <div class="col-sm-12 col-md-10">{{ $progress->created_at }}</div>
                                <div class="col-12 text-muted">Details:</div>
                                <div class="col-12">{{ $progress->details }}</div>
                            @endforeach
                        @else
                            <div class="col-12">
                                <h4 class="text-muted">No progress recorded yet.</h4>
                            </div>
                        @endif
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
