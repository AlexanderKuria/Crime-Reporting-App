<div class="row">
    <div class="col-sm-12 col-md-2 text-muted">Reported By</div>
    <div class="col-sm-12 col-md-4">{{ $crime->user->name }}</div>
    <div class="col-sm-12 col-md-2 text-muted">On</div>
    <div class="col-sm-12 col-md-4">{{ $crime->created_on }}</div>
    <div class="col-sm-12 col-md-2 text-muted">Reason</div>
    <div class="col-sm-12 col-md-4">{{ $crime->for }}</div>
    <div class="col-12"><hr></div>
    <div class="col-12 text-muted">Details</div>
    <div class="col-12">{{ $crime->details }}</div>
    @if($crime->police)
        <div class="col-12">
            <hr>
        </div>
        <div class="col-12">
            <h4>Assigned Officer</h4>
        </div>
        <div class="col-sm-12 col-md-2 text-muted">Assigned Officer</div>
        <div class="col-sm-12 col-md-4">
            @if($crime->police->id == Auth::user()->id)
                <span class="text-primary font-weight-bold">Me</span>
            @else
                {{ $crime->police->name }}
            @endif
        </div>
        <div class="col-sm-12 col-md-2 text-muted">Officer Email</div>
        <div class="col-sm-12 col-md-4">{{ $crime->police->email }}</div>
    @endif
    @if($crime->police)
        @if($crime->police->id == Auth::user()->id)
            <div class="col-12">
                <hr>
            </div>
            <div class="col-12">
                <h4>Progress Details</h4>
                <div class="col-12 text-right">
                    <a href="{{ route('add.progress', $crime->id) }}" class="btn btn-sm btn-outline-primary">Add Progress</a>
                </div>
            </div>
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
        @endif
    @endif
</div>
