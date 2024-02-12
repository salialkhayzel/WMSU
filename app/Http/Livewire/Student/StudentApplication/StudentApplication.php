<?php

namespace App\Http\Livewire\Student\StudentApplication;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class StudentApplication extends Component
{
    public $user_detais;
    public $title;

    public function booted(Request $request){
        $this->user_details = $request->session()->all();
        if(!isset($this->user_details['user_id'])){
            return redirect('/login');
        }else{
            $user_status = DB::table('users as u')
            ->select('u.user_status_id','us.user_status_details')
            ->join('user_status as us', 'u.user_status_id', '=', 'us.user_status_id')
            ->where('user_id','=', $this->user_details['user_id'])
            ->first();
        }

        if(isset($user_status->user_status_details) && $user_status->user_status_details == 'deleted' ){
            return redirect('/deleted');
        }

        if(isset($user_status->user_status_details) && $user_status->user_status_details == 'inactive' ){
            return redirect('/inactive');
        }
    }
    public function hydrate(){
        self::update_data();
    }
    public function update_data(){

        $this->exam_schedules = DB::table('exam_schedules')
            ->select('*')
            ->get()
            ->toArray();

    }
    public function check_profile(){
        $valid = false;
        if(strlen($this->user_details['user_citizenship']) < 1 ){
            $valid = true;
        }
        if(strlen($this->user_details['user_addr_brgy']) < 1 ){
            $valid = true;
        }
        if(strlen($this->user_details['user_addr_city_mun']) < 1 ){
            $valid = true;
        }
        if(strlen($this->user_details['user_addr_province']) < 1 ){
            $valid = true;
        }
        if(intval($this->user_details['user_addr_zip_code']) < 1 ){
            $valid = true;
        }
        if(intval($this->user_details['user_phone']) < 1 ){
            $valid = true;
       }
       if($valid){
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'success',
                'title'             									=> 'Incomplete Profile data, please modile and fill the missing data!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '/student/profile'
            ]);
            return;
       }
    }
    public function mount(Request $request){
        $this->user_details = $request->session()->all();
        $this->title = 'application';
        self::update_data();

        if(DB::table('test_applications')
            ->where('t_a_test_type_id', '=', 
                ((array) DB::table('test_types')
                    ->where('test_type_details', '=', 'College Entrance Test')
                    ->select('test_type_id as t_a_test_type_id')
                    ->first())['t_a_test_type_id'])
            
            ->where('t_a_applicant_user_id','=',$this->user_details['user_id'])
            ->where('t_a_isactive','=',1)
            ->first()
            ){
                // $this->dispatchBrowserEvent('swal:redirect',[
                //     'position'          									=> 'center',
                //     'icon'              									=> 'success',
                //     'title'             									=> 'Successfully signed up!',
                //     'showConfirmButton' 									=> 'true',
                //     'timer'             									=> '1500',
                //     'link'              									=> 'student/status'
                // ]);

            return redirect('/student/status');
        }
    }
    public function render()
    {
        return view('livewire.student.student-application.student-application',[
        'user_details' => $this->user_details
        ])
        ->layout('layouts.student',[
            'title'=>$this->title]);
    }
}
