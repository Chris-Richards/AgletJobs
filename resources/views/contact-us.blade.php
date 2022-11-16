@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="margin-bottom:24px;">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <center><h3>Contact Us</h3></center><hr>

                    <form method="POST" action="/contact-us">
                        <div class="mb-3">
                            <label for="title" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label">Subject</label>
                            <input type="text" class="form-control" name="subject" required>
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label">Message</label>
                            <textarea class="form-control" name="message" rows="8"></textarea>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-danger btn-block">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
