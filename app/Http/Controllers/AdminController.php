<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Job;
use App\View;
use App\Location;
use App\User;

class AdminController extends Controller
{
    
    public function getAnalytics()
    {
        $jobsCount = Job::count();
        $viewCount = View::count();
        $userCount = User::count();

        $arr = [
            'jobs' => $jobsCount,
            'views' => $viewCount,
            'users' => $userCount,
        ];

        return $arr;
    }

}
