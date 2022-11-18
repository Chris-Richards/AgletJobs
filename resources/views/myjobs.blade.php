@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row" style="margin-bottom:24px; position: relative;">
        <span>Showing {{ $jobs->count() }} jobs</span><br><br>
            @foreach($jobs as $job)

            <div class="modal fade" id="myToast-{{ $job->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  {{-- <div class="modal-header"> --}}
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                  {{-- </div> --}}
                  <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="float:right;"></button>
                    <center>
                        <span>The link to this job has been copied!</span>
                    </center>
                  </div>
                  {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                  </div> --}}
                </div>
              </div>
            </div>

            {{-- <div class="toast" id="myToast-{{ $job->id }}">
                    <div class="toast-body">
                        The link to this job post has been copied to your clipboard
                    </div>
                </div> --}}
            <div class="col-md-4">
                <div class="card @if($job->type == 2)featured @endif" style="margin-bottom: 24px;">
                    <div class="card-header">
                        <div class="form-check form-switch" style="float: right;">
                            <label class="form-check-label" for="flexSwitchCheckChecked">Visible</label>
                            <input class="form-check-input visible-check" type="checkbox" id="{{ $job->id }}" @if($job->visible == 1) checked @endif>
                        </div>
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
                        <button class="btn btn-danger shareBtn" id="share-{{ $job->id }}" job-id="{{ $job->id }}" type="button" data-bs-toggle="modal" data-bs-target="#myToast-{{ $job->id }}">Share</button>
                        <strong><span style="float:right;">Posted {{ $job->created_at->diffForHumans() }}</span></strong>
                    </div>
                </div>
            </div>
            @endforeach
    </div>
</div>
@endsection
