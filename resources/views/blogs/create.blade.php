@extends('layouts.app')

@section('content')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <center><h3>Create Job Post</h3></center><hr>
                        <form method="POST" action="/admin/blog/create">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Blog Title</label>
                                <input type="text" class="form-control" name="title" id="title" required>
                            </div>
                            <div class="mb-3">
                                <label for="company" class="form-label">Blog Body</label>
                                {{-- <textarea class="form-control" name="company" id="company" required></textarea> --}}
                                <textarea id="summernote" name="body"></textarea>
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
                            <button type="submit" class="btn btn-danger">Post Blog</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#summernote').summernote();
});
</script>
@endsection
