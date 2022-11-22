@extends('layouts.app')

@section('head_content')
    <meta name="title" content="{{ $job->title }} - Aglet Jobs">
@overwrite

@section('content')

<div class="container">
    <div class="row justify-content-center" style="margin-bottom:24px;">
        <div class="col-md-6">
            @if($job->user_id == Auth::id() && $job->type == 1)
            <div class="card featured">
                <div class="card-body">
                    <h5 style="text-align: center;">Your job ad is not featured! Promote it to reach more potential candidates!</h5>
                    <hr>
                    <button class="btn btn-danger" style="float: right;" data-bs-toggle="modal" data-bs-target="#promoteModal">Learn More</button>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="promoteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Promote Job Ad</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <h6>We know some jobs require very unique employees. This is why we provide a featured service. Below is what promoting a job ad on Aglet gives you.</h6>
                    <ul>
                        <li>All featured jobs are highlighted and placed at the top of search results in order to stand out to potential candidates.</li>
                        <li>Featured jobs are promoted on the front page of our website & promoted within our networks via Facebook, Instagram, ect.</li>
                        <li><span class="badge bg-danger">Featured</span> tag on the job ad.</li>
                    </ul>
                    <hr>
                    <span>NOTE: AgletJobs does not store or hold your financial details whatsoever, we use Stripe to process payments. Learn more about stripe <a href="https://stripe.com">here</a></span><hr>
                    <form id="payment-form">
                      <div id="payment-element">
                        <!-- Elements will create form elements here -->
                      </div>

                      <div class="text-center" id="publish-spinner" style="display:none;">
                      <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                      </div>
                    </div>
                      
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button style="margin-top:14px;" class="btn btn-danger btn-block mb-3" id="submit">Complete Payment ${{$intent->amount / 100}}</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>

            <script src="https://js.stripe.com/v3/"></script>
            <script type="text/javascript">
            const stripe = Stripe('pk_live_51LJ98QLzaPfDS5cOwp3urEJH9vumaADwlsJbf1bK8fJmql4eCcrNA9aRvfNO7cvR5C4Wjn7hMlm0jsoxAwDc31Hg00me3gmDmM');
            // const stripe = Stripe('pk_test_51LJ98QLzaPfDS5cOGQgruHCJnLXV2vYEyaYHi2TJgxNxxTDhLHSaeQNeBi2Iqpd3ftsxNdjJ03aFtNxgGaucfAg900iiND3UKE');

            const options = {
              clientSecret: '{{ $intent->client_secret }}',
              // Fully customizable with appearance API.
              appearance: {/*...*/},
            };

            // Set up Stripe.js and Elements to use in checkout form, passing the client secret obtained in step 2
            const elements = stripe.elements(options);

            // Create and mount the Payment Element
            const paymentElement = elements.create('payment');
            paymentElement.mount('#payment-element');

            const form = document.getElementById('payment-form');

            form.addEventListener('submit', async (event) => {
                $("#submit").prop('value', 'Loading..')
                $("#submit").attr('disabled', 'true')
                $("#publish-spinner").css('display', 'block');
                $("#payment-element").css('display', 'none');
              event.preventDefault();

              const {error} = await stripe.confirmPayment({
                //`Elements` instance that was used to create the Payment Element
                elements,
                confirmParams: {
                  return_url: 'https://aglet.com.au/job/{{ $job->id }}/promote',
                  // return_url: 'http://localhost:8000/job/{{ $job->id }}/promote',
                },
              });

              if (error) {
                // This point will only be reached if there is an immediate error when
                // confirming the payment. Show error to your customer (for example, payment
                // details incomplete)
                const messageContainer = document.querySelector('#error-message');
                messageContainer.textContent = error.message;
              } else {
                // $.post("/job/{{ $job->id }}/publish",
                //   function(data, status){

                //   });
              }
            });
            </script>
            @endif

            <div class="card @if($job->type == 2)featured @endif">
                <div class="card-header">
                    <strong>{{ $job->title }}</strong><br>
                    @if($job->type == 2)
                    <span class="badge bg-danger">Featured</span>
                    @endif

                    @foreach($job->tags as $tag)
                        <span class="badge bg-primary">{{ $tag }}</span>
                    @endforeach
                </div>
                <div class="card-body">
                    <span><strong>{{ $job->company_name }}</strong></span><br>
                    <span><strong>{{ $job->location()->postcode }}, {{ $job->location()->city }}, {{ $job->location()->state }}</strong></span><hr>

                    <span><strong>About Us</strong></span><br>
                    <span>{!! nl2br(e($job->company)) !!}</span><br><br>
                    <span><strong>The Role</strong></span><br>
                    <span>{!! nl2br(e($job->role)) !!}</span><br><br>
                    <span>{!! nl2br(e($job->other)) !!}</span><br><br>
                    <span>Quote job reference a-{{ $job->id }} when applying</span>
                </div>
                <div class="card-footer">
                    {{-- <a href="{{ $job->apply_url }}" style="text-decoration: none;">
                        <button class="btn btn-danger">Apply Now</button>
                    </a> --}}
                    @if(filter_var($job->apply_url, FILTER_VALIDATE_EMAIL))
                        Email <span style="color: #DC3545;">{{ $job->apply_url }}</span> to apply.
                    @else
                        <a target="_blank" href="{{ $job->apply_url }}" style="text-decoration:none: color:white;">
                            <button class="btn btn-danger">Apply Here</button>
                        </a>
                    @endif

                    {{-- @if(Auth::check())
                        Email <span style="color: #DC3545;">{{ $job->apply_url }}</span> to apply.
                    @else
                        <a href="/login">Please login/sign up here to apply</a>
                    @endif --}}
                    <button class="btn btn-danger" id="myBtn" type="button" data-bs-toggle="modal" data-bs-target="#copy-modal">Share</button>
                </div>
            </div>

            <div class="modal fade" id="copy-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  {{-- <div class="modal-header"> --}}
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                  {{-- </div> --}}
                  <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="float:right;"></button>
                    <center>
                        <span>The link to this job has been copied!</span>
                    </center>
                  </div>
                  {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                  </div> --}}
                </div>
              </div>
            </div>

            <div class="toast" id="myToast">
                <div class="toast-body">
                    The link to this job post has been copied to your clipboard
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
