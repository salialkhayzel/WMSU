<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Mail;

class Dashboard extends Component
{

    public $mail = true;
    
    public $user_detais;
    public $title;

    public $total_applicants = [];
    public $total_appointments = [];
    public $total_test_takers = [];
    public $total_accounts = [];
    public $recent_applicants = [];
    public $status_of_applicants = [];
    public $total_appointments_this_week = [];

    public function booted(Request $request){
        $user_details = $request->session()->all();
        if(!isset($user_details['user_id'])){
            header("Location: /login");
            die();
        }else{
            $user_status = DB::table('users as u')
            ->select('u.user_status_id','us.user_status_details')
            ->join('user_status as us', 'u.user_status_id', '=', 'us.user_status_id')
            ->where('user_id','=', $user_details['user_id'])
            ->first();
        }

        if(isset($user_status->user_status_details) && $user_status->user_status_details == 'deleted' ){
            header("Location: /deleted");
            die();
        }

        if(isset($user_status->user_status_details) && $user_status->user_status_details == 'inactive' ){
            header("Location: /deleted");
            die();
        }
    }

    public function update_data(){
        $this->total_appointments = DB::table('appointments as a')
            ->select(
                DB::raw('count(*) as count'),
                'status_id',
                'status_details'
            )
            ->join('status as s','s.status_id','a.appointment_status_id')
            ->groupBy('appointment_status_id')
            ->get()
            ->toArray();
            $year = DB::table('users')
                ->select(DB::raw('YEAR(NOW()) as year'))
                ->limit(1)
                ->first()->year;

            $this->total_applicants = DB::table('test_applications as ta')
                ->select(
                    DB::raw('count(*) as count'),
                    'test_type_id',
                    'test_type_details',
                    'test_type_name')
                ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
                ->where(DB::raw('YEAR(ta.date_created)'),'=',$year)
                ->groupBy('test_type_id')
                ->get()
                ->toArray();

            $this->total_test_takers = DB::table('test_applications as ta')
                ->select(
                    DB::raw('count(*) as count'),
                    'test_type_id',
                    'test_type_details',
                    'test_type_name')
                ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
                ->groupBy('test_type_id')
                ->get()
                ->toArray();
            $this->total_accounts = DB::table('users as u')
                ->select(DB::raw('count(*) as count'),
                'us.user_status_id',
                'us.user_status_details')
                ->join('user_status as us', 'u.user_status_id', '=', 'us.user_status_id')
                ->groupBy('us.user_status_id')
                ->get()
                ->toArray();
            $this->recent_applicants = DB::table('test_applications as ta')
                ->select(
                    'user_firstname',
                    'user_middlename',
                    'user_lastname',
                    'tt.test_type_details',
                    'tt.test_type_name',
                    'ta.date_created')
                ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
                ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
                ->orderBy('ta.date_created','desc')
                ->limit('5')
                ->get()
                ->toArray();
            $this->total_appointments_this_week = DB::table('appointments as a')
                ->select(
                    DB::raw('count(*) as count'),
                    DB::raw('DATE(a.appointment_datetime) as date'),
                    )
                ->groupBy(DB::raw('DATE(a.appointment_datetime)'))
                ->orderBy('a.appointment_datetime','desc')
                ->where('appointment_status_id','=',DB::table('status')->select('status_id')->where('status_details','=','Complete')->first()->status_id)
                ->limit(7)
                ->get()
                ->toArray();
            $this->total_appointments_this_week = array_reverse( $this->total_appointments_this_week);
            $this->status_of_applicants = DB::table('test_applications as ta')
                ->select(
                    DB::raw('count(*) as count'),
                    'test_status_id',
                    'test_status_details',)
                ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
                ->groupBy('test_status_id')
                ->get()
                ->toArray();

    }
    public function mount(Request $request){
        $this->user_details = $request->session()->all();
        $this->title = 'dashboard';
        self::update_data();
    }
    public function render()
    {
        return view('livewire.admin.dashboard',[
            'user_details' => $this->user_details
            ])
            ->layout('layouts.admin',[
                'title'=>$this->title]);
    }
}
