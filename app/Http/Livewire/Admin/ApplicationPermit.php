<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Mail;
use chillerlan\QRCode\{QRCode, QROptions};

class ApplicationPermit extends Component
{
    public $mail = true;
    
    public $hash;
    public $title = 'Permit';
    public $examinee;
    public $page =1;

    
    public $qrcode;
    public $qr_code_link;
    public $scale_size = 20; 

    

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
        $access_role = DB::table('access_roles as ar')
            ->join('modules as m','ar.access_role_module_id','m.module_id')
            ->where('access_role_user_id','=',$user_details['user_id'])
            ->where('module_nav_name','Exam Administrator')
            ->first();

        $this->access_role = [
            'C' => $access_role->access_role_create,
            'R' => $access_role->access_role_read,
            'U' => $access_role->access_role_update,
            'D' => $access_role->access_role_delete
        ];
    }
    public function hydrate(){
        if($this->access_role['C'] || $this->access_role['R'] || $this->access_role['U'] || $this->access_role['D']){
            self::update_data();
        }
    }
    public function update_data(){
       

        $this->view_permit = DB::table('test_applications as ta')
        ->select('*',DB::raw('DATE(ta.date_created) as applied_date'))
        ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
        ->join('users as us', 'us.user_id', '=', 'ta.t_a_applicant_user_id')
        ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'ta.t_a_applicant_user_id')
        ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
        ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
        ->join('cet_types as ct', 'ct.cet_type_id', '=', 'ta.t_a_cet_type_id')
        ->join('test_schedules as tsc', 'tsc.id', '=', 'ta.t_a_test_schedule_id')
        ->join('school_rooms as sr', 'sr.school_room_id', '=', 'ta.t_a_school_room_id')
        ->join('test_centers as tc','tc.id','sr.school_room_test_center_id')
        ->leftjoin('high_schools as hs','hs.id','ta.t_a_school_id')
        
        ->where('test_type_details', '=', 'College Entrance Test')
                
        // ->where('t_a_test_status_id', '=', 
        //     ((array) DB::table('test_types')
        //         ->where('test_type_details', '=', 'College Entrance Test')
        //         ->select('test_type_id as t_a_test_type_id')
        //         ->first())['t_a_test_type_id'])
        
        ->where('t_a_hash','=',$this->hash )
        ->limit(1)
        ->get()
        ->toArray();
            // dd($this->view_permit);

        if(DB::table('attendance')
        ->where('t_a_id','=',$this->view_permit[0]->t_a_id)
        ->first() ){
            DB::table('attendance')
            ->where('t_a_id','=',$this->view_permit[0]->t_a_id)
            ->update([
                    'ispresent' =>1
                ]);
        }else{
            DB::table('attendance')
            ->insert([
                    'id' => NULL,
                    't_a_id' =>$this->view_permit[0]->t_a_id
                ]);
        }
      
        
        $path = 'application-permit/'.$this->view_permit[0]->t_a_hash;
        $this->qr_code_link = ( $_SERVER['SERVER_PORT'] == 80?'http://':'https://'). $_SERVER['SERVER_NAME'] .'/'.$path;
        $options = new QROptions;
        $options->version     = 7;
        $options->imageBase64 = true;
        $options->scale =  $this->scale_size;
        $this->qrcode = (new QRCode($options))->render($this->qr_code_link);
            // dd($this->cet_form );
    }
    public function mount(Request $request,$hash){
        $this->hash = $hash;
        self::update_data();

    }
    public function render()
    {
        return view('livewire.admin.application-permit',[
            ])
            ->layout('layouts.admin',[
                'title'=>$this->title]);
    }
    public function cet_application(){
        if($this->page == 1){
            $this->page = 2;
            $this->dispatchBrowserEvent('moveUp');
        }elseif($this->page == 2){
        }
    }
    public function page($page){
        $this->page = $page;
        $this->dispatchBrowserEvent('moveUp');

        if($this->page == 1){
            // check data
        }
    }
}
