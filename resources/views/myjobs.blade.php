@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row" style="margin-bottom:24px;">
        <span>Showing {{ $jobs->count() }} jobs</span><br><br>
            @foreach($jobs as $job)
            <div class="toast" id="myToast-{{ $job->id }}">
                    <div class="toast-body">
                        The link to this job post has been copied to your clipboard
                    </div>
                </div>
            <div class="col-md-4">
                <div class="card @if($job->type == 2)featured @endif" style="margin-bottom: 24px;">
                    <div class="card-header">
                        <strong>{{ $job->title }}</strong>
                        @if($job->type == 2)
                         - <span class="badge bg-danger">Featured</span>
                        @endif
                        <br>
                        <span class="job-loc"><strong>{{ $job->location()->city }}, {{ $job->location()->state }}</strong></span>
                        <br>
                        <span class="job-loc"><strong>Views {{ $job->view()->sum('count') }}</strong></span>
                    </div>
                    <div class="card-footer">
                        <a href="/job/{{ $job->id }}" style="text-decoration: none;">
                            <button class="btn btn-danger">View Job</button>
                        </a>
                        <button class="btn btn-danger shareBtn" id="share-{{ $job->id }}" job-id="{{ $job->id }}" onclick="ShareJob(this)">Share</button>
                        <strong><span style="float:right;">Posted {{ $job->created_at->diffForHumans() }}</span></strong>
                    </div>
                </div>
            </div>
            @endforeach
    </div>
</div>
@endsection
