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
use App\User;
use App\Skill;
use App\Application;
use App\Blog;

use App\Http\Controllers\JobController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;

use Barryvdh\DomPDF\Facade\Pdf;

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
            'title' => "Aglet - Home",
            'user' => Auth::user()
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

        $intent = null;

        if (Auth::check()) {
            if (Auth::user()->id == $job->user_id) {
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
            }
        }

        $tags = [];

        if ($job->tags) {
            foreach($job->tags as $jt) {
                $tag = Tag::where('id', '=', $jt)->first();
                array_push($tags, $tag->name);
            }
        }

        $job->tags = $tags;

        $applied = 0;

        if(Application::where('job_id', '=', $id)
            ->where('user_id', '=', Auth::id())
            ->first()) {
            $applied = 1;
        }

        $applications = Application::where('job_id', '=', $id)->get();

        // if(Auth::user()->employee()->first()) {
        //     return Auth::user()->employee()->first();
        // }

        return view('job', [
            'job' => $job,
            'intent' => $intent,
            'title' => $job->title . ' - Aglet',
            'applied' => $applied,
            'applications' => $applications,
        ]);
    }

    public function admin()
    {
        if(Auth::user()->account_type == 3) {
            $admin = new AdminController;
            $totals = $admin->getAnalytics();

            $contacts = Contact::latest()->get();

            $users = User::latest()->limit(10)->get();

            return view('admin.dashboard', [
                'title' => 'Admin Dashboard - Aglet',
                'totals' => $totals,
                'contacts' => $contacts,
                'recent' => $users,
            ]);
        } else {
            return redirect('/');
        }
    }

    public function display()
    {
        // if(Auth::user()->account_type == 3) {
        //     $users = User::count();

        //     return view('admin.display', [
        //         'count' => $users
        //     ]);
        // } else {
        //     return redirect('/');
        // }

        $users = View::count();

            return view('admin.display', [
                'count' => $users
            ]);
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

    public function about()
    {
        $blogs = Blog::latest()->limit(6)->get();

        return view('about', [
            'title' => "Resources - Aglet",
            'blogs' => $blogs
        ]);
    }

    public function blog($id)
    {
        $BlogController = new BlogController();
        
        return $BlogController->view($id);
    }

    public function blogCreate()
    {
        $tags = Tag::get();

        return view('blogs.create', [
            'tags' => $tags,
            'title' => 'Create Blog - Aglet'
        ]);
    }

    public function resumeGenerator()
    {
        return view('resume', [
            'title' => "Free Resume Generator - Aglet Jobs"
        ]);
    }

    public function generateResume(Request $request)
    {
        // return $request->post();

        // return view('layouts.resume');
        // error_reporting(E_ALL ^ E_DEPRECATED);
        // $pdf = PDF::loadView('layouts.resume');

        // return $pdf->stream('sample.pdf');
        $data = [
            'name' => $request->input('name'),
            'number' => $request->input('number'),
            'email' => $request->input('email'),
            'suburb' => $request->input('suburb'),
            'state' => $request->input('state'),
            'summary' => $request->input('summary'),
            'postcode' => $request->input('postcode'),
            'skills' => [],
            'jobs' => [],
            'edu' => [],
            'certs' => [],
            'refs' => [],
        ];

        $skillsJSON = json_decode($request->input('skills'));
        $skills = [];

        if (!empty($skillsJSON)) {
            foreach($skillsJSON as $value) {
                // array_push($skills, $value->value );
                array_push($data['skills'], $value->value);
            }
        }

        $skills1JSON = json_decode($request->input('tickets'));
        $skills1 = [];

        if (!empty($skills1JSON)) {
            foreach($skills1JSON as $value) {
                // array_push($skills, $value->value );
                array_push($data['certs'], $value->value);
            }
        }

        if ($request->input('job-1-title') !== null) {
            $finish = "Present";
            if ($request->input('job-1-finish') !== null) {
                $finish = $request->input('job-1-finish');
            }

            $job_1 = [
                'title' => $request->input('job-1-title'),
                'company' => $request->input('job-1-company'),
                'start' => $request->input('job-1-start'),
                'finish' => $finish,
                'summary' => $request->input('job-1-summary'),
            ];

            array_push($data['jobs'], $job_1);
        }

        if ($request->input('job-2-title') !== null) {
            $job_1 = [
                'title' => $request->input('job-2-title'),
                'company' => $request->input('job-2-company'),
                'start' => $request->input('job-2-start'),
                'finish' => $request->input('job-2-finish'),
                'summary' => $request->input('job-2-summary'),
            ];

            array_push($data['jobs'], $job_1);
        }

        if ($request->input('job-3-title') !== null) {
            $job_1 = [
                'title' => $request->input('job-3-title'),
                'company' => $request->input('job-3-company'),
                'start' => $request->input('job-3-start'),
                'finish' => $request->input('job-3-finish'),
                'summary' => $request->input('job-3-summary'),
            ];

            array_push($data['jobs'], $job_1);
        }

        if ($request->input('edu-1-name') !== null) {
            $job_1 = [
                'name' => $request->input('edu-1-name'),
                'institution' => $request->input('edu-1-institution'),
                'finish' => $request->input('edu-1-finish'),
            ];

            array_push($data['edu'], $job_1);
        }

        if ($request->input('edu-2-name') !== null) {
            $job_1 = [
                'name' => $request->input('edu-2-name'),
                'institution' => $request->input('edu-2-institution'),
                'finish' => $request->input('edu-2-finish'),
            ];

            array_push($data['edu'], $job_1);
        }

        if ($request->input('ref-1-name') !== null) {
            $job_1 = [
                'name' => $request->input('ref-1-name'),
                'position' => $request->input('ref-1-position'),
                'company' => $request->input('ref-1-company'),
                'contact' => $request->input('ref-1-contact'),
            ];

            array_push($data['refs'], $job_1);
        }

        if ($request->input('ref-2-name') !== null) {
            $job_1 = [
                'name' => $request->input('ref-2-name'),
                'position' => $request->input('ref-2-position'),
                'company' => $request->input('ref-2-company'),
                'contact' => $request->input('ref-2-contact'),
            ];

            array_push($data['refs'], $job_1);
        }

        // return collect($data);

        // $pdf = PDF::loadView('layouts.test', ['data' => $data]);
        // return $pdf->stream('resume.pdf');

        $pdf = Pdf::loadView('layouts.resume', ['data' => $data]);
        return $pdf->stream('invoice.pdf');
    }

}

























