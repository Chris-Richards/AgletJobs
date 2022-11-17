@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="margin-bottom:24px;">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <center><h3>Create Job Post</h3></center><hr>
                    <form method="POST" action="/job/create">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Job Title</label>
                            <input type="text" class="form-control" name="title" id="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="company_name" class="form-label">Company Name</label>
                            <input type="text" class="form-control" name="company_name" id="company_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="company" class="form-label">About The Company</label>
                            <textarea class="form-control" name="company" id="company" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">About The Role</label>
                            <textarea class="form-control" name="role" id="role" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="other" class="form-label">Other Information</label>
                            <textarea class="form-control" name="other" id="other"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="url" class="form-label">Email To Apply</label>
                            <input type="text" class="form-control" name="url" id="url" required />
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Hire Location</label>
                            <select id="location" name="location" class="form-select">
                                @foreach($locations as $loc)
                                <option value="{{ $loc->id }}">{{ $loc->city }}, {{ $loc->state }}</option>
                                @endforeach
                            </select>
                        </div>
                        <label for="tags" class="form-label">Relevant Categories</label>
                        <div class="form-check mb-3">
                            {{-- <input class="form-check-input" type="checkbox" value="1" name="entry" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Entry Level Role
                            </label><br> --}}
                            @foreach($tags as $tag)
                                <input class="form-check-input" type="checkbox" value="{{ $tag->id }}" name="{{ $tag->id }}">
                                <label class="form-check-label">
                                    {{ $tag->name }}
                                </label><br>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-danger">Save Job</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
