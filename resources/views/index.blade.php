@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center" style="margin-bottom:24px;">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <center>
                        <h4>Browse By Location</h4>
                    </center>
                    <hr>
                    <div class="input-group mb-3">
                        <select id="location" class="form-select form-select-lg">
                        @foreach($locations as $loc)
                        <option value="{{ $loc->id }}">{{ $loc->city }}, {{ $loc->state }}</option>
                        @endforeach
                    </select>
                        <button onclick="SearchLocation()" class="btn btn-danger" type="button" id="button-addon2">Search</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <hr>
        <center>
            <h3 style="padding-bottom: 12px;">Featured Job Ads</h3>
        </center>
        <hr>
            @foreach($jobs as $job)
            <div class="col-md-6">
                <div class="card @if($job->type == 2)featured @endif">
                    <div class="card-body">
                        @if($job->type == 2)
                        <span class="badge bg-danger" style="float:right;">Featured</span>
                        @endif
                        <a class="job-title" href="/job/{{ $job->id }}"><span class="">{{ $job->title }}</span></a><br>
                        <span class="job-company"><strong>{{ $job->user()->first()->company_name }}</strong></span><br>
                        <span class="job-loc"><strong>{{ $job->location()->city }}, {{ $job->location()->state }}</strong></span>
                        <p class="job-desc">{{ \Illuminate\Support\Str::limit($job->company, 200, $end='...') }}</p>
                    </div>
                    <div class="card-footer">
                        <strong><span style="float:right;">Posted {{ $job->created_at->diffForHumans() }}</span></strong>
                    </div>
                </div>
            </div>
            @endforeach
    </div>

    {{-- <div class="row">
        <hr style="margin-top:12px;">
        <center>
            <h3 style="padding-bottom: 12px;">Frequently Asked Questions</h3>
        </center>
        <hr>

        <div class="col-md-6">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    Accordion Item #2
                  </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Accordion Item #2
                  </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Accordion Item #3
                  </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div> --}}
</div>
@endsection
