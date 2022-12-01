@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3>Admin Dashboard</h3>
                    <span>Logged in as {{ Auth::user()->name }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h3>Enquiries</h3>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Subject</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contacts as $c)
                            <tr>
                                <th scope="row">{{ $c->name }}</th>
                                <td>{{ $c->email }}</td>
                                <td>{{ $c->subject }}</td>
                                <td>
                                    <button class="btn btn-danger">View</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h3>Total Users</h3>
                    <span style="font-size:24px;">{{ $totals['users'] }}</span>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h3>Total Jobs</h3>
                    <span style="font-size:24px;">{{ $totals['jobs'] }}</span>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h3>Total Views</h3>
                    <span style="font-size:24px;">{{ $totals['views'] }}</span>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h3>Total Applications</h3>
                    <span style="font-size:24px;">{{ $totals['applications'] }}</span>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h3>Total Employees</h3>
                    <span style="font-size:24px;">{{ $totals['employees'] }}</span>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h3>Total Employers</h3>
                    <span style="font-size:24px;">{{ $totals['employers'] }}</span>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h3>Recent Users</h3>
                    <table class="table table-striped">
                        <tbody>
                        @foreach($recent as $r)
                        <tr>
                            <td>{{ $r->name }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
















