<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Job;
use App\User;
use App\Tag;
use App\Application;
use App\Employee;
use App\Employer;
use App\Location;
use App\Payment;

use Carbon\Carbon;

class JobController extends Controller
{
    
    public function latest()
    {
        $jobs = Job::where('type', '=', 1)
            ->where('visible', '=', 1)
            ->latest()
            ->limit(6)
            ->get();

        return $jobs;
    }

    public function visible(Request $request, $id)
    {
        $job = Job::where('id', '=', $id)->first();

        if (Auth::user()->id == $job->user_id) {
            if ($job->visible == 1) {
                $job->visible = 0;
                $job->save();

                return "Job made not visible";
            } else {
                $job->visible = 1;
                $job->save();

                return "Job made visible";
            }
        } else {
            return $job;
        }
    }

    public function search($loc, $tag = null)
    {
        // $jobs = Job::where('location', '=', $loc)
        //             ->where('type', '=', 1)
        //             ->latest()
        //             ->paginate(15);

        $jobs;

        if ($tag !== null) {
            $tag = Tag::where('slug', '=', $tag)->first();

            $jobs = Job::where('location', '=', $loc)
                        ->whereJsonContains('tags', ["".$tag->id.""])
                        ->where('type', '>=', '1')
                        ->where('visible', '=', 1)
                        ->latest()
                        ->paginate(15);
        } else {
            $jobs = Job::where('location', '=', $loc)
                        // ->whereJsonContains('tags', ["1"])
                        ->where('type', '>=', '1')
                        ->where('visible', '=', 1)
                        ->latest()
                        ->paginate(15);
        }

        // return $jobs;

        $featured = Job::where('location', '=', $loc)
                    ->where('type', '=', 2)
                    ->where('visible', '=', 1)
                    ->inRandomOrder()
                    ->take(2)
                    ->get();

        foreach($featured as $f) {
            $jobs->prepend($f);
        }

        foreach($jobs as $job) {
            $tags = [];

            if ($job->tags) {
                foreach($job->tags as $jt) {
                    $tag = Tag::where('id', '=', $jt)->first();
                    array_push($tags, $tag->slug);
                }
            }

            $job->tags = $tags;
        }

        return $jobs;
    }

    public function create(Request $request)
    {   
        $tags = Tag::get();
        $user = User::where('id', '=', Auth::id())->first();

        $job = new Job();
        $job->user_id = Auth::id();
        $job->title = $request->input('title');
        $job->company_name = $request->input('company_name');
        $job->company = $request->input('company');
        $job->role = $request->input('role');
        $job->other = $request->input('other');
        $job->apply_url = $request->input('url');
        $job->location = $request->input('location');

        // if($user->free_jobs > 0) {
        //     $user->free_jobs -= 1;
        //     $user->save();
        //     $job->type = 1;
        // }

        // FREE JOBS FOREVER
        $job->type = 1;


        // $job->entry = $request->input('entry');

        $jobTags = [];

        foreach ($request->post() as $k => $r) {
            if ($k == "location") { continue; }
            foreach ($tags as $tag) {
                if ($r == $tag->id) {
                    array_push($jobTags, $r);
                }
            }
        }

        $job->tags = $jobTags;

        // return $job;

        $job->save();

        return redirect('/job/' . $job->id);
    }

    public function publish($id)
    {
        $job = Job::where('id', '=', $id)->first();
        $job->type = 1;
        $job->save();

        $stripe = new \Stripe\StripeClient(config('app.stripe_secret'));

        // $invoice = $stripe->invoices->create([
        //     'customer' => Auth::user()->stripe,
        //     'description' => "Publish job ad",
        //     'collection_method' => 'send_invoice',
        //     'days_until_due' => 30
        // ]);

        // $invoiceItem = \Stripe\InvoiceItem::create([ 
        //     'customer' => Auth::user()->stripe,
        //     'price' => 2000,
        //     'invoice' => $invoice['id']
        // ]);

        // $invoice->sendInvoice();

        $stripe->invoiceItems->create([
            'customer' => Auth::user()->stripe,
            'price' => 'price_1M4xxFLzaPfDS5cOvETzszXZ',
        ]);

        $invoice = $stripe->invoices->create([
          'customer' => Auth::user()->stripe,
          'collection_method' => 'send_invoice',
          'days_until_due' => 1
        ]);

        $stripe->invoices->pay(
          $invoice['id'],
          ['paid_out_of_band' => true]
        );

        $stripe->invoices->sendInvoice(
          $invoice['id'],
          []
        );

        // $stripe->invoices->pay(
        //     $invoice['id'], 
        //     [
        //         "paid_out_of_band" => true
        //     ]
        // );

        // return $invoice;

        return redirect('/job/' . $job->id);
    }

    public function promote($id)
    {
        $job = Job::where('id', '=', $id)->first();
        $job->type = 2;
        $job->save();

        $stripe = new \Stripe\StripeClient(config('app.stripe_secret'));

        $stripe->invoiceItems->create([
            'customer' => Auth::user()->stripe,
            'price' => 'price_1M4xxbLzaPfDS5cOCWq3QHAW', // LIVE MODE
            // 'price' => 'price_1LRslwLzaPfDS5cOV5zmNhVk', // TEST MODE
        ]);

        $invoice = $stripe->invoices->create([
          'customer' => Auth::user()->stripe,
          'collection_method' => 'send_invoice',
          'days_until_due' => 1
        ]);

        $stripe->invoices->pay(
          $invoice['id'],
          ['paid_out_of_band' => true]
        );

        $stripe->invoices->sendInvoice(
          $invoice['id'],
          []
        );

        return redirect('/job/' . $job->id);
    }

    public function myjobs()
    {
        $jobs = Job::where('user_id', '=', Auth::id())->with('view')->orderBy('created_at', 'DESC')->get();

        return view('myjobs', [
            'jobs' => $jobs,
            'title' => "Job Listings - Aglet"
        ]);
    }

    public function apply(Request $request, $id)
    {
        $employee = Employee::where('user_id', '=', Auth::id())->first();

        $application = new Application();
        $application->user_id = Auth::id();
        $application->employee_id = $employee->id;
        $application->cover_letter = $request->input('cover');
        $application->job_id = $id;
        $application->save();

        return redirect('/job/'.$id.'?result=success');
    }

    public function candidates($f_1 = null, $f_2 = null)
    {
        $employees = collect();
        $current = 0;
        $locations = Location::get();
        $tags = Tag::get();

        $amount = 0;
        $description = "";

        $intent = null;

        $employer = Employer::where('user_id','=',Auth::id())->first();

        if ($employer->active = 1) {
            $time = new Carbon($employer->expiry);
            if ($time->isPast()) {
                $employer->active = 0;
                $employer->expiry = null;
                $employer->save();
            }
        }

        switch ($f_1) {
            case null:
                $employees = Employee::where('visible','=',1)->get();
                break;
            
            default:
                $employees = Employee::where('visible','=',1)
                            ->where('location', '=', $f_1)
                            ->get();

                $current = $f_1;
                break;
        }

        if(Auth::user()->employer()->first()->active == 1) {

        } else {
            $stripe = new \Stripe\StripeClient(config('app.stripe_secret'));

            if (Auth::check()) {
                    $amount = 7000;
                    $description = "Candidates search database (1 month)";

                    $intent = $stripe->paymentIntents->create(
                      [
                        'amount' => $amount,
                        'currency' => 'aud',
                        'customer' => Auth::user()->stripe,
                        'description' => $description,
                        // 'automatic_payment_methods' => ['enabled' => true],
                      ]
                    );
            }
        }

        return view('candidates', [
            'employees' => $employees,
            'title' => 'Candidates Search - Aglet',
            'locations' => $locations,
            'tags' => $tags,
            'current' => $current,
            'intent' => $intent
        ]);
    }

    public function subscribe()
    {
        $employer = Employer::where('user_id', '=', Auth::id())->first();

        $payment = new Payment();
        $payment->user_id = Auth::id();
        $payment->amount = 70.00;
        $payment->description = "Cadidate Database";
        $payment->save();

        $employer->active = 1;
        $employer->expiry = Carbon::now()->addDays(31);
        $employer->save();

        return redirect('/candidates');
    }

}






























