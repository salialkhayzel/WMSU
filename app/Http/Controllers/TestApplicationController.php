<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestApplicationController extends Controller
{
    public function Cet()
    {
        return view('test-application.Cet');
    }
    public function Cetshiftee()
    {
        return view('test-application.Cet-shiftee');
    }
    public function Cettransferee()
    {
        return view('test-application.Cet-transferee');
    }
    
    public function Cetgraduate()
    {
        return view('test-application.Cet-graduate');
    }


    public function Nat()
    {
        return view('test-application.Nat');
    }
    
    public function Eat()
    {
        return view('test-application.Eat');
    }

    public function Gsat()
    {
        return view('test-application.Gsat');
    }

    public function Lsat()
    {
        return view('test-application.Lsat');
    }

    public function Ksat()
    {
        return view('test-application.Ksat');
    }

    public function Hrmat()
    {
        return view('test-application.Hrmat');
    }

    public function Jrat()
    {
        return view('test-application.Jrat');
    }
}
