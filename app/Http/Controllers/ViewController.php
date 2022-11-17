<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;

use App\Location;
use App\Job;
use App\View;
use App\Tag;
use App\Contact;

use App\Http\Controllers\JobController;
use App\Http\Controllers\AdminController;

class ViewController extends Controller
{
    
    public function index()
    {
        $stripe = new \Stripe\StripeClient(config('app.stripe_secret'));

        $JobController = new JobController();

        $jobs = $JobController->latest();

        $locations = Location::get();

        return view('index', [
            'jobs' => $JobController->latest(),
            'locations' => $locations,
            'title' => "Aglet - Home"
        ]);
    }

    public function search($city, $tag = null)
    {
        $JobController = new JobController();

        $jobs = $JobController->search($city, $tag);

        // return $jobs;

        // $jobs = Job::simplePaginate(15);

        // return $jobs;

        $locations = Location::get();
        $tags = Tag::get();

        $location = Location::where('id', '=', $city)->first();

        $jobsREV = new Collection;

        // $tempJobs = $jobs->getCollection();

        if ($tag == null) {
            // return $jobs;
        } else {
            foreach ($jobs as $key => $value) {
                $tagMatch = 0;
                foreach ($value->tags as $vTag) {
                    if ($vTag === $tag) {
                        $tagMatch = 1;
                        // $jobsREV->push($value);
                        // unset($jobs[$key]);
                    }
                }

                if ($value->type == 2) {
                    $tagMatch = 1;
                }

                if ($tagMatch == 0) {
                    unset($jobs[$key]);
                }
            }
        }

        // return $jobs->paginate(15);

        // return $jobs;

        // return $jobs;

        // return $jobsREV;

        // $jobsREV = $jobs->unique();
        // return $jobs;

        return view('search', [
            'jobs' => $jobs,
            'locations' => $locations,
            'current' => $city,
            'currentID' => $location->id,
            'currentTag' => $tag,
            'tags' => $tags,
            'title' => "Jobs in " . $location->city . " - Aglet",
        ]);
    }

    public function create()
    {
        $locations = Location::get();
        $tags = Tag::get();

        return view('create', [
            'locations' => $locations,
            'tags' => $tags,
            'title' => "Create job posting - Aglet"
        ]);
    }

    public function job($id, Request $request)
    {
        $stripe = new \Stripe\StripeClient(config('app.stripe_secret'));

        $job = Job::where('id', '=', $id)->first();

        $ip = $request->ip();

        $view = View::where([
            ['ip', '=', $ip],
            ['job_id', '=', $job->id]
        ]);

        if($view->exists()) {
            $view = $view->first();
            $view->count += 1;
            $view->save();
        } else {
            $view = new View();
            $view->ip = $ip;
            $view->job_id = $job->id;
            $view->save();
        }

        $amount = 0;
        $description = "";

        if($job->type == 1)
        {
            $amount = 2500;
            $description = "Job Ad Promotion";
        } else {
            $amount = 500;
            $description = "Job Ad Publish";
        }

        $intent = $stripe->paymentIntents->create(
          [
            'amount' => $amount,
            'currency' => 'aud',
            'customer' => Auth::user()->stripe,
            'description' => $description,
            'automatic_payment_methods' => ['enabled' => true],
          ]
        );

        $tags = [];

        if ($job->tags) {
            foreach($job->tags as $jt) {
                $tag = Tag::where('id', '=', $jt)->first();
                array_push($tags, $tag->name);
            }
        }

        $job->tags = $tags;

        return view('job', [
            'job' => $job,
            'intent' => $intent,
            'title' => $job->title . ' - Aglet'
        ]);
    }

    public function admin()
    {
        if(Auth::user()->account_type == 2) {
            $admin = new AdminController;
            $totals = $admin->getAnalytics();

            return view('admin.dashboard', [
                'title' => 'Admin Dashboard - Aglet',
                'totals' => $totals,
            ]);
        } else {
            return redirect('/');
        }
    }

    public function contactUs()
    {
        return view('contact-us', [
            'title' => "Contact Us - Aglet"
        ]);
    }

    public function contactForm(Request $request)
    {
        $contact = new Contact;
        $contact->name = $request->input('name');
        $contact->subject = $request->input('subject');
        $contact->email = $request->input('email');
        $contact->body = $request->input('body');
        $contact->save();

        return redirect('/contact-us?contact=success');
    }

}
