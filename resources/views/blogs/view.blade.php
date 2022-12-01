@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4>{{ $blog->title }}</h4>
                    <span style="color: #888; font-weight: 600;">Posted {{ \Carbon\Carbon::parse($blog->created_at)->format('d/m/Y')}}</span>
                    <hr>
                    {!! $blog->body !!}
                </div>
                <div class="card-footer">
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
