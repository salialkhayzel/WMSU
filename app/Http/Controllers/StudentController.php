<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function profile()
    {
        return view('student.profile');
    }

    public function application()
    {
        return view('student.application');
    }

    public function status()
    {
        return view('student.status');
    }

    public function schedule()
    {
        return view('student.schedule');
    }

    public function results()
    {
        return view('student.results');
    }

    public function payment()
    {
        return view('student.payment');
    }
}
