@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="margin-bottom:24px;">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3>Candidates Search Database</h3>
                    <span>Use this database to search for candidates and recruit inhouse.</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4>Filters</h4>
                    <hr>
                    <div class="mb-3">
                        <label class="form-label">By Location</label>
                        <select id="location" class="form-select form-select-lg">
                            @foreach($locations as $loc)
                            @if($loc->id == $current)
                            <option selected value="{{ $loc->id }}">{{ $loc->city }}, {{ $loc->state }}</option>
                            @else
                            <option value="{{ $loc->id }}">{{ $loc->city }}, {{ $loc->state }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <hr>
                    <button onclick="FilterLocation()" class="btn btn-danger" type="button" id="button-addon2">Search</button>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="row">
                @if(Auth::user()->employer()->first()->active == 1)
                    @forelse($employees as $e)
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4>{{ $e->user()->first()->name }}</h4>
                                <h6>
                                {{ $e->location()->city }},
                                {{ $e->location()->state }},
                                {{ $e->location()->postcode }}
                                </h6>
                                <hr>
                                @if($e->skills)
                                @foreach($e->skills as $s)
                                <span class="badge bg-danger">{{ $s }}</span>
                                @endforeach
                                @endif
                                <hr>
                                <a target="_blank" href="{{ Storage::disk('digitalocean')->url($e->resume_url . "/" . $e->resume_url) }}">
                                    <button class="btn btn-danger">View Resume</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                        <span>No visible candidates available</span>
                    @endforelse
                @else
                <div class="card">
                    <div class="card-body">
                        <h4>Purchase access</h4>
                        <span>A fee of $70 AUD is required to access our candidates database for 1 month. Please complete payment below.</span>
                        <hr>
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
                        return_url: 'https://aglet.com.au/candidates/subscribe',
                            // return_url: 'http://localhost:8000/candidates/subscribe',
                        },
                        });
                        if (error) {
                        // This point will only be reached if there is an immediate error when
                        // confirming the payment. Show error to your customer (for example, payment
                        // details incomplete)
                        const messageContainer = document.querySelector('#error-message');
                        messageContainer.textContent = error.message;
                        } else {
                        }
                        });
                        </script>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection