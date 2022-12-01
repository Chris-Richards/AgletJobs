@extends('layouts.app')

@section('content')

<link href="https://unpkg.com/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
<script src="https://unpkg.com/@yaireo/tagify"></script>
<script src="https://unpkg.com/@yaireo/tagify@3.1.0/dist/tagify.polyfills.min.js"></script>

@auth
    @if($user->account_type == 0)
        <div class="modal fade" id="myToast" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="float:right;"></button> --}}
                        <center>
                            <h4>It's time to setup your profile</h4>
                            <span>Please select your account type below and fill out the required details.</span>
                        </center>
                        <hr>
                        <ul class="nav nav-pills nav-justified mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Job Seeker</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Employer</button>
                            </li>
                        </ul>
                        <hr>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                                <form action="/profile/update/employee" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Skills (Press Enter/Return to save a skill)</label>
                                        <input name="skills" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="location" class="form-label">Hire Location</label>
                                        <select id="location" name="location" class="form-select">
                                            @foreach($locations as $loc)
                                            <option value="{{ $loc->id }}">{{ $loc->city }}, {{ $loc->state }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Upload Resume</label>
                                        <input type="file" name="resume" class="form-control" required>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" name="visible" type="checkbox" value="" id="flexCheckChecked" checked>
                                        <label class="form-check-label" for="flexCheckChecked">
                                        Visible Profile
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-danger">Save</button>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                                <form action="/profile/update/employer" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Business Name</label>
                                        <input class="form-control" type="text" name="name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Business ABN/ACN</label>
                                        <input class="form-control" type="text" name="abn" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Short Business Description (this is visible on job listings)</label>
                                        <textarea class="form-control" name="about" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-danger">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#myToast').modal('show');

                var input = document.querySelector('input[name=skills]');

                // initialize Tagify on the above input node reference
                new Tagify(input, {
                    whitelist : [],
                    dropdown : {
                        classname     : "color-blue",
                        enabled       : 0,              // show the dropdown immediately on focus
                        maxItems      : 6,
                        position      : "text",         // place the dropdown near the typed text
                        closeOnSelect : false,          // keep the dropdown open after selecting a suggestion
                        highlightFirst: true
                    }
                });
                input.addEventListener('change', onChange)

                function onChange(e){
                  // outputs a String
                  console.log(e.target.value)
                }
              });
        </script>
    @else

    @endif
@endauth

<div class="container">
    <div class="row justify-content-center" style="margin-bottom:24px;">
        <div class="col-md-5">
            {{-- @guest
            <div class="alert alert-primary" role="alert">
                <span>Sign up to receive new job alerts!</span>
            </div>
            @endguest --}}

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
                        <span class="job-company"><strong>{{ $job->company_name }}</strong></span><br>
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
