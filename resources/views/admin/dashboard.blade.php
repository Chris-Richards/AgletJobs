@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12" style="margin-bottom: 24px;">
            <div class="card">
                <div class="card-body">
                    <h3>Admin Dashboard</h3>
                    <span>Logged in as {{ Auth::user()->name }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h3>Total Users</h3>
                    <span>{{ $totals['users'] }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h3>Total Jobs</h3>
                    <span>{{ $totals['jobs'] }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h3>Total Views</h3>
                    <span>{{ $totals['views'] }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
