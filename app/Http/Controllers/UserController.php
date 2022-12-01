<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Employer;
use App\Employee;
use App\User;
use App\Skill;

class UserController extends Controller
{
    
    public function update(Request $request, $type)
    {
        switch ($type) {
            case 'employer':

                $employer = new Employer();
                $employer->user_id = Auth::id();
                $employer->business_name = $request->input('name');
                $employer->business_abn = $request->input('abn');
                $employer->about = $request->input('about');
                $employer->save();

                $user = User::where('id', '=', Auth::id())->first();
                $user->account_type = 2;
                $user->save();

                return redirect('/');

                break;

            case 'employee':

                $skillsJSON = json_decode($request->input('skills'));
                $skills = [];

                if (!empty($skillsJSON)) {
                    foreach($skillsJSON as $value) {
                        array_push($skills, $value->value );

                        Skill::firstOrCreate(['name' => $value->value]);
                    }
                }

                $employee = new Employee();
                $employee->user_id = Auth::id();
                $employee->location = $request->input('location');
                $employee->skills = $skills;

                // return $request->input('resume');
                // dd($request->file('resume'));
                // return $request->post();

                if ($request->file('resume')) {
                    $extension = $request->file('resume')->extension();
                    $mimeType = $request->file('resume')->getMimeType();
                    $name = $request->file('resume')->hashName();
                    $path = Storage::disk('digitalocean')->putFile($name, $request->file('resume'), 'public');

                    $employee->resume_url = $name;
                }

                if ($request->input('visible')) {
                    $employee->visible = 1;
                } else {
                    $employee->visible = 0;
                }

                $employee->save();

                $user = User::where('id', '=', Auth::id())->first();
                $user->account_type = 1;
                $user->save();

                return redirect('/');

                // Storage::disk('digitalocean')->putFile('uploads', request()->file, 'public');

                break;
        }
    }

}
