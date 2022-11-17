@extends('layouts.app')

@section('content')

<div class="container">
    <center style="margin-bottom: 24px;">
            <a href="/search/{{ $currentID }}" style="display: inline-block;">
                <span class="badge bg-danger">Remove Filter</span>
            </a>
        @foreach($tags as $tag)
            <a href="/search/{{ $currentID }}/{{ $tag->slug }}" style="display: inline-block;">
                <span class="badge bg-primary">{{ $tag->name }}</span>
            </a>
        @endforeach
    </center>
    <div class="row justify-content-center" style="margin-bottom:24px;">
        <div class="col-md-6">
            <div class="card" style="margin-bottom:24px;">
                <div class="card-body">
                    <center>
                        <h4>Browse By Location</h4>
                    </center>
                    <hr>
                    <div class="input-group mb-3">
                        <select id="location" class="form-select form-select-lg">
                        @foreach($locations as $loc)
                            @if($loc->id == $current)
                                <option selected value="{{ $loc->id }}">{{ $loc->city }}, {{ $loc->state }}</option>
                            @else
                                <option value="{{ $loc->id }}">{{ $loc->city }}, {{ $loc->state }}</option>
                            @endif
                        @endforeach
                    </select>
                        <button onclick="SearchLocation()" class="btn btn-danger" type="button" id="button-addon2">Search</button>
                    </div>
                    Showing {{ $jobs->total() }} Jobs
                </div>
            </div>

            @foreach($jobs as $job)
                @if(!$job)
                    @continue
                @endif
                {{-- @if($currentTag != null)
                <?php $display = 0; ?>
                    @foreach($job->tags as $tag)
                        @if($tag == $currentTag)
                            <?php $display = 1; ?>
                        @endif
                    @endforeach

                    @if($display == 0)
                        @continue
                    @endif
                @endif --}}
                <div class="card @if($job->type == 2)featured @endif">
                    <div class="card-body">
                        @if($job->type == 2)
                        <span class="badge bg-danger" style="float:right; margin-left: 4px;">Featured</span>
                        @endif
                        @foreach($job->tags as $tag)
                        <span class="badge bg-primary" style="float:right; margin-left: 4px;">{{ $tag }}</span>
                        @endforeach
                        <a class="job-title" href="/job/{{ $job->id }}"><span class="">{{ $job->title }}</span></a><br>
                        <span class="job-company"><strong>{{ $job->company_name }}</strong></span><br>
                        <span class="job-loc"><strong>{{ $job->location()->city }}, {{ $job->location()->state }}</strong></span>


                        <p class="job-desc">{{ \Illuminate\Support\Str::limit($job->company, 200, $end='...') }}</p>
                    </div>
                    <div class="card-footer">
                        <strong><span style="float:right;">Posted {{ $job->created_at->diffForHumans() }}</span></strong>
                    </div>
                </div>
            @endforeach

            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    {{ $jobs }}
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection
