@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('crime.update', $crime->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="location" class="col-12 font-weight-bold">Location of Crime:</label>
                        <input type="text"  class="form-control col-12" id="location" name="location"
                               placeholder="Gashororo"
                               value="@if(old('location')){{ old('location') }}@else{{ $crime->location }}@endif"
                        >
                        @error('location')
                        <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="reason" class="col-12 font-weight-bold">What Reason:</label>
                        <input type="text" class="form-control col-12" id="reason" name="reason"
                               placeholder="stolen wallet"
                               value="@if(old('reason')){{old('reason')}}@else{{ $crime->for }} @endif"
                        >
                        @error('reason')
                        <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="details" class="col-12 font-weight-bold">Full Details:</label>
                        <textarea name="details" id="details" cols="30" rows="10" class="form-control col-12"
                                  placeholder="full detailed information"
                            >@if(old('details')){{ old('details') }}@else{{ $crime->details }}@endif</textarea>
                        @error('details')
                        <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-lg btn-dark">Report Crime</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
