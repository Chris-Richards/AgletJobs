<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Job;
use App\Tag;

class JobController extends Controller
{
    
    public function latest()
    {
        $jobs = Job::where('type', '=', 2)->latest()->limit(6)->get();

        return $jobs;
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
                        ->latest()
                        ->paginate(15);
        } else {
            $jobs = Job::where('location', '=', $loc)
                        // ->whereJsonContains('tags', ["1"])
                        ->latest()
                        ->paginate(15);
        }

        // return $jobs;

        $featured = Job::where('location', '=', $loc)
                    ->where('type', '=', 2)
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

        $job = new Job();
        $job->user_id = Auth::id();
        $job->title = $request->input('title');
        $job->company_name = $request->input('company_name');
        $job->company = $request->input('company');
        $job->role = $request->input('role');
        $job->other = $request->input('other');
        $job->apply_url = $request->input('url');
        $job->location = $request->input('location');
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
            'price' => 'price_1M4xxbLzaPfDS5cOCWq3QHAW',
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

}
