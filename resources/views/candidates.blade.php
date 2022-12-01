@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="margin-bottom:24px;">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3>Candidates Search Database</h3>
                    <span>Use this database to search for candidates and recruit inhouse.</span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            @forelse($employees as $e)
                <div class="card">
                    <div class="card-body">
                        <h4>{{ $e->user()->first()->name }}</h4>
                        <h6>
                            {{ $e->location()->city }},
                            {{ $e->location()->state }},
                            {{ $e->location()->postcode }}
                        </h6>
                        <hr>
                        @if($e->skills)
                            @foreach($e->skills as $s)
                                <span class="badge bg-danger">{{ $s }}</span>
                            @endforeach
                        @endif
                        <hr>
                        <a target="_blank" href="{{ Storage::disk('digitalocean')->url($e->resume_url . "/" . $e->resume_url) }}">
                            <button class="btn btn-danger">View Resume</button>
                        </a>
                    </div>
                </div>
            @empty
                <span>No visible candidates available</span>
            @endforelse
        </div>
    </div>
</div>
@endsection
