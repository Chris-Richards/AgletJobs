@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3>Aglet Jobs</h3>
                    <span>Alget Jobs provides the all round services catered to job seekers, employers and recruiters. Our platform makes is as easy as possible to fulfil your needs in the industry.</span>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <h3>FAQ</h3>
            <hr>
            <div class="accordion card" id="accordionExample">
                <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    What is FIFO?
                  </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    "FIFO" is an acronym used to refer to fly-in-fly-out jobs, usually these jobs are in the mining industry. Some other acronyms include "DIDO" drive-in-drive-out and "BIBO" bus-in-bus-out.
                  </div>
                </div>
              </div>
              {{-- <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    How do I make a resume?
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
                    Do I need a cover letter?
                  </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                  </div>
                </div>
              </div> --}}
            </div>
        </div>

        <div class="col-md-6">
            <h3>Blog Posts</h3>
            <hr>
            @foreach($blogs as $b)
                <div class="card">
                    <div class="card-body">
                        <h5>{{ $b->title }}</h5>
                        <hr>
                        <span>{{ Str::limit(strip_tags($b->body), 140) }}</span>
                        <hr>
                        <a href="/blog/{{ $b->id }}" style="float:right;">
                            <button class="btn btn-danger">Read More</button>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
