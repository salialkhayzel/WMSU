<?php

namespace App\Http\Livewire\Student\StudentAppointment;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class StudentAppointment extends Component
{
    public $user_detais;
    public $title;

    public $appointment_filter;
    public $appointment_data;
    public $appointment = [
        'appointment_id' => NULL,
        'appointment_user_id' =>NULL,
        'appointment_status_id' =>NULL ,
        'appointment_preferred_date' =>NULL ,
        'appointment_preferred_time' =>NULL,
        'appointment_purpose' =>NULL,
        'appointment_message' =>NULL,
        'appointment_datetime' =>NULL
    ];

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

    public function update_data(){
        $this->appointment_data = DB::table('appointments as a')
            ->join('status as s','s.status_id','a.appointment_status_id')
            ->where('appointment_user_id','=',$this->user_details['user_id'])
            ->orderBy('a.date_created','desc')
            ->get()
            ->toArray();
    //    dd($this->appointment_data);
    }
    public function hydrate(){
        
        self::update_data();
    }
    
    public function mount(Request $request){
        $this->user_details = $request->session()->all();
        $this->title = 'application';
        self::update_data();
        $this->appointment_filter =[
            '#' => true ,
            'Date' =>true ,	
            'Time' => false,
            'Schedule' => true,
            'Purpose' => true,
            'Message' => true,
            'Status' => true,
            'Action' => true
        ];
        
    }
    public function render(){
        return view('livewire.student.student-appointment.student-appointment',[
            'user_details' => $this->user_details
            ])
            ->layout('layouts.student',[
                'title'=>$this->title]);
    }

    public function add_appointment_modal(){
        if(DB::table('appointments as a')
            ->where('appointment_status_id','=',DB::table('status')->select('status_id')->where('status_details','=','Pending')->first()->status_id)
            ->where('appointment_user_id','=',$this->user_details['user_id'])
            ->first() || DB::table('appointments as a')
            ->where('appointment_status_id','=',DB::table('status')->select('status_id')->where('status_details','=','Accepted')->first()->status_id)
            ->where('appointment_user_id','=',$this->user_details['user_id'])
            ->first() ){
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'You have an active appointment!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }else{
            $this->appointment = [
                'appointment_id' => NULL,
                'appointment_user_id' =>NULL,
                'appointment_status_id' =>NULL ,
                'appointment_preferred_date' =>NULL ,
                'appointment_preferred_time' =>NULL,
                'appointment_purpose' =>NULL,
                'appointment_message' =>NULL,
                'appointment_datetime' =>NULL
            ];
            $this->dispatchBrowserEvent('openModal','addApppointmentModal');
        }
    }
    public function add_apointment(){
        $curdate = DB::select(DB::raw('SELECT DATE(NOW()) as curdate'));
        $current_date=date_create($curdate[0]->curdate);
        $appointment_date=date_create($this->appointment['appointment_preferred_date']);
        $diff=date_diff($appointment_date,$current_date);
       
        if(intval($diff->format("%R%a"))>0){
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Appointment date should be a today or future date!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
            return;
        }
        if(strlen($this->appointment['appointment_purpose'])<=0){
            return;
        }
        if(DB::table('appointments')
            ->insert([
                'appointment_id' => NULL,
                'appointment_user_id' =>$this->user_details['user_id'],
                'appointment_status_id' =>  DB::table('status')->select('status_id')->where('status_details','=','Pending')->first()->status_id,
                'appointment_preferred_date' => $this->appointment['appointment_preferred_date'] ,
                'appointment_preferred_time' =>NULL,
                'appointment_purpose' =>$this->appointment['appointment_purpose'],
                'appointment_message' =>$this->appointment['appointment_message'],
                'appointment_datetime' =>NULL
                ])){

            DB::table('notifications')
            ->insert([
                'notification_id' =>NULL ,
                'notification_user_target' => $this->user_details['user_id'] ,
                'notification_user_creator' => $this->user_details['user_id'],
                'notification_icon_id' => 12 ,
                'notification_title' => 'New Appointment Scheduled!' ,
                'notification_content'  => 'Your appointment has been successfully scheduled!' ,
                'notification_link' => '/student/appointment'
            ]);
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'success',
                'title'             									=> 'Appointment schedule is added!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
            self::update_data();
            $this->dispatchBrowserEvent('openModal','addApppointmentModal');
        }
    }   
    public function reschedule_appointment($appointment_id){
        if($appointment = DB::table('appointments as a')
        ->join('status as s','s.status_id','a.appointment_status_id')
        ->where('appointment_id','=',$appointment_id)
        ->where('appointment_user_id','=',$this->user_details['user_id'])
        ->first()){
            $this->appointment = [
                'appointment_id' =>  $appointment->appointment_id,
                'appointment_user_id' =>$appointment->appointment_user_id,
                'appointment_status_id' =>$appointment->appointment_status_id ,
                'appointment_preferred_date' =>$appointment->appointment_preferred_date ,
                'appointment_preferred_time' =>$appointment->appointment_preferred_time,
                'appointment_purpose' =>$appointment->appointment_purpose,
                'appointment_message' =>$appointment->appointment_message,
                'appointment_datetime' =>$appointment->appointment_datetime
            ];
            $this->dispatchBrowserEvent('openModal','rescheduleApppointmentModal');
        }
    }
    public function save_reschedule_appointment($appointment_id){
        $curdate = DB::select(DB::raw('SELECT DATE(NOW()) as curdate'));
        $current_date=date_create($curdate[0]->curdate);
        $appointment_date=date_create($this->appointment['appointment_preferred_date']);
        $diff=date_diff($appointment_date,$current_date);
        if(intval($diff->format("%R%a"))>0){
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Appointment date should be a today or future date!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
            return;
        }
        if(strlen($this->appointment['appointment_purpose'])<=0){
            return;
        }
        if(DB::table('appointments')
        ->where('appointment_id','=',$appointment_id)
        // ->where('appointment_status_id','=',DB::table('status')->select('status_id')->where('status_details','=','Pending')->first()->status_id)
        ->where( 'appointment_user_id','=',$this->user_details['user_id'])
        ->update([
            'appointment_preferred_date' => $this->appointment['appointment_preferred_date'] ,
            'appointment_preferred_time' =>NULL,
            'appointment_status_id'=>DB::table('status')->select('status_id')->where('status_details','=','Pending')->first()->status_id,
            'appointment_purpose' =>$this->appointment['appointment_purpose'],
            'appointment_message' =>$this->appointment['appointment_message'],
            'appointment_datetime' =>NULL
        ])){
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'success',
                'title'             									=> 'Appointment is successfully updated!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
            DB::table('notifications')
            ->insert([
                'notification_id' =>NULL ,
                'notification_user_target' => $this->user_details['user_id'] ,
                'notification_user_creator' => $this->user_details['user_id'],
                'notification_icon_id' => 15 ,
                'notification_title' => 'Appointment has been re-scheduled!' ,
                'notification_content'  => 'Your appointment has been successfully re-scheduled!' ,
                'notification_link' => '/student/appointment'
            ]);
            self::update_data();
            $this->dispatchBrowserEvent('openModal','rescheduleApppointmentModal');
        }
    }
    public function cancel_appointment($appointment_id){
        $appointment = DB::table('appointments as a')
        ->join('status as s','s.status_id','a.appointment_status_id')
        ->where('appointment_id','=',$appointment_id)
        ->where('appointment_user_id','=',$this->user_details['user_id'])
        ->first();
        $this->appointment = [
            'appointment_id' =>  $appointment->appointment_id,
            'appointment_user_id' =>$appointment->appointment_user_id,
            'appointment_status_id' =>$appointment->appointment_status_id ,
            'appointment_preferred_date' =>$appointment->appointment_preferred_date ,
            'appointment_preferred_time' =>$appointment->appointment_preferred_time,
            'appointment_purpose' =>$appointment->appointment_purpose,
            'appointment_message' =>$appointment->appointment_message,
            'appointment_datetime' =>$appointment->appointment_datetime
        ];
        $this->dispatchBrowserEvent('openModal','CancelApppointmentModal');
    }

    public function confirm_cancel_appointment($appointment_id){
        if(DB::table('appointments as a')
            ->where('appointment_id','=',$appointment_id)
            ->where('appointment_user_id','=',$this->user_details['user_id'])
            ->update(['appointment_status_id'=>DB::table('status')->select('status_id')->where('status_details','=','Cancelled')->first()->status_id])){
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'success',
                'title'             									=> 'Appointment is successfully cancelled!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
            DB::table('notifications')
            ->insert([
                'notification_id' =>NULL ,
                'notification_user_target' => $this->user_details['user_id'] ,
                'notification_user_creator' => $this->user_details['user_id'],
                'notification_icon_id' => 13 ,
                'notification_title' => 'Appointment has been cancelled!' ,
                'notification_content'  => 'Your appointment has been successfully cancelled!' ,
                'notification_link' => '/student/appointment'
            ]);
            self::update_data();
            $this->dispatchBrowserEvent('openModal','CancelApppointmentModal');
        }
    }
    public function appointment_filterView(){
        $this->dispatchBrowserEvent('swal:redirect',[
            'position'          									=> 'center',
            'icon'              									=> 'success',
            'title'             									=> 'Successfully changed filter!',
            'showConfirmButton' 									=> 'true',
            'timer'             									=> '1000',
            'link'              									=> '#'
        ]);
    }
}
