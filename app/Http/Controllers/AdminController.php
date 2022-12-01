<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Job;
use App\View;
use App\Location;
use App\User;
use App\Application;
use App\Employee;
use App\Employer;

class AdminController extends Controller
{
    
    public function getAnalytics()
    {
        $jobsCount = Job::count();
        $viewCount = View::count();
        $userCount = User::count();
        $applicationCount = Application::count();
        $employeeCount = Employee::count();
        $employerCount = Employer::count();

        $arr = [
            'jobs' => $jobsCount,
            'views' => $viewCount,
            'users' => $userCount,
            'applications' => $applicationCount,
            'employees' => $employeeCount,
            'employers' => $employerCount,
        ];

        return $arr;
    }

    public function ajax()
    {
        $userCount = User::count();
        return $userCount;
    }

}
