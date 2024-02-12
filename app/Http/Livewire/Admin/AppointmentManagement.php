<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Mail;

class AppointmentManagement extends Component
{

    public $mail = false;

    public $user_detais;
    public $title;

    public $appointment_data;

    public $unassigned_appointment_data;
    public $unassigned_appointment_data_filter;
    public $unassigned_appointment_selected_all;
    public $unassigned_appointment_selected = [];
    public $unassigned_appointment_datetime;

    public $assigned_appointment_data;
    public $assigned_appointment_data_filter;
    public $assigned_appointment_selected_all;
    public $assigned_appointment_selected = [];
    public $assigned_appointment_datetime;

    public $complete_appointment_data;
    public $complete_appointment_data_filter;



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
    public function hydrate(){
        if($this->access_role['C'] || $this->access_role['R'] || $this->access_role['U'] || $this->access_role['D']){
            self::update_data();

           
        }
    }
    public function update_data(){
        $this->unassigned_appointment_data = DB::table('appointments as a')
            ->select(
            'appointment_id',
            DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
            'user_email',
            'user_id',
            'user_email_verified',
            'user_phone',
            'appointment_purpose',
            'appointment_message',
            'appointment_preferred_date',
            'appointment_preferred_time',
            'appointment_datetime',
            'status_details',
            )
            ->join('users as u','u.user_id','a.appointment_user_id')
            ->join('status as s','s.status_id','a.appointment_status_id')
            ->where('appointment_status_id','=',DB::table('status')->select('status_id')->where('status_details','=','Pending')->first()->status_id)
            ->orderBy('a.date_created','desc')
            ->get()
            ->toArray();
        
            $this->assigned_appointment_data = DB::table('appointments as a')
            ->select(
            'appointment_id',
            DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
            'user_email',
            'user_id',
            'user_email_verified',
            'user_phone',
            'appointment_purpose',
            'appointment_message',
            'appointment_preferred_date',
            'appointment_preferred_time',
            'appointment_datetime',
            'status_details',
            )
            ->join('users as u','u.user_id','a.appointment_user_id')
            ->join('status as s','s.status_id','a.appointment_status_id')
            ->where('appointment_status_id','=',DB::table('status')->select('status_id')->where('status_details','=','Accepted')->first()->status_id)
            ->orderBy('a.date_created','desc')
            ->get()
            ->toArray();

            $this->complete_appointment_data = DB::table('appointments as a')
            ->select(
            'appointment_id',
            DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
            'user_email',
            'user_id',
            'user_email_verified',
            'user_phone',
            'appointment_purpose',
            'appointment_message',
            'appointment_preferred_date',
            'appointment_preferred_time',
            'appointment_datetime',
            'status_details',
            )
            ->join('users as u','u.user_id','a.appointment_user_id')
            ->join('status as s','s.status_id','a.appointment_status_id')
            ->where('appointment_status_id','=',DB::table('status')->select('status_id')->where('status_details','=','Complete')->first()->status_id)
            ->orderBy('a.date_created','desc')
            ->get()
            ->toArray();
           
        // dd($this->complete_appointment_data);
    }
    public function mount(Request $request){
        $this->user_details = $request->session()->all();
        $this->title = 'appointment-management';
        $this->active = 'Unassign Appointments';



        $this->unassigned_appointment_data_filter = [
            'Select all'=> true,
            '#'=> true,
            'Full name' => true, 
            'Email Address'=> false,
            'Phone #'=> true,
            'Preferred Date'=> true,
            'Purpose'=> true,
            'Message'=> false,
            'Status'=> true,
            'Action' => false
        ];

        $this->assigned_appointment_data_filter = [
            'Select all'=> true,
            '#'=> true,
            'Full name' => true, 
            'Email Address'=> false,
            'Phone #'=> true,
            'Appointment Datetime'=> true,
            'Purpose'=> true,
            'Message'=> false,
            'Status'=> true,
            'Action' => true
        ];

        $this->complete_appointment_data_filter = [
            '#'=> true,
            'Full name' => true, 
            'Email Address'=> false,
            'Phone #'=> true,
            'Appointment Datetime'=> true,
            'Purpose'=> true,
            'Status'=> true,
        ];

        
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($this->access_role['C'] || $this->access_role['R'] || $this->access_role['U'] || $this->access_role['D']){
            self::update_data();


            $this->unassigned_appointment_selected = [];
            foreach ($this->unassigned_appointment_data  as $key => $value) {
                array_push($this->unassigned_appointment_selected,[$value->appointment_id=>false]);
            }

            $this->assigned_appointment_selected = [];
            foreach ($this->assigned_appointment_data  as $key => $value) {
                array_push($this->assigned_appointment_selected,[$value->appointment_id=>false]);
            }
            
        }
    }
    public function render()
    {
        return view('livewire.admin.appointment-management',[
            'user_details' => $this->user_details
            ])
            ->layout('layouts.admin',[
                'title'=>$this->title]);
    }

    public function filter_view(){
        $this->dispatchBrowserEvent('swal:redirect',[
            'position'          									=> 'center',
            'icon'              									=> 'success',
            'title'             									=> 'Successfully changed filter!',
            'showConfirmButton' 									=> 'true',
            'timer'             									=> '1000',
            'link'              									=> '#'
        ]);
    }
    public function active_page($active){
        $this->active = $active;

        self::update_data();

        $this->unassigned_appointment_selected = [];
        foreach ($this->unassigned_appointment_data  as $key => $value) {
            array_push($this->unassigned_appointment_selected,[$value->appointment_id=>false]);
        }
        $this->assigned_appointment_selected = [];
        foreach ($this->assigned_appointment_data  as $key => $value) {
            array_push($this->assigned_appointment_selected,[$value->appointment_id=>false]);
        }
    }

    public function unassigned_appointment_select_all(){
        if($this->unassigned_appointment_selected_all){
            $this->unassigned_appointment_selected = [];
            foreach ($this->unassigned_appointment_data  as $key => $value) {
                array_push($this->unassigned_appointment_selected,[$value->appointment_id=>true]);
            }
        }else{
            $this->unassigned_appointment_selected = [];
            foreach ($this->unassigned_appointment_data  as $key => $value) {
                array_push($this->unassigned_appointment_selected,[$value->appointment_id=>false]);
            }
        }
    }
    public function assigned_appointment_select_all(){
        if($this->assigned_appointment_selected_all){
            $this->assigned_appointment_selected = [];
            foreach ($this->assigned_appointment_data  as $key => $value) {
                array_push($this->assigned_appointment_selected,[$value->appointment_id=>true]);
            }
        }else{
            $this->assigned_appointment_selected = [];
            foreach ($this->assigned_appointment_data  as $key => $value) {
                array_push($this->assigned_appointment_selected,[$value->appointment_id=>false]);
            }
        }
    }
    
    public function accept_appointment_modal(){
        $valid = false;
        foreach ($this->unassigned_appointment_data  as $key => $value) {
            if($this->unassigned_appointment_selected[$key][$value->appointment_id]){
                $valid = true;
            }
        }

        // accessrole read
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($valid &&  $this->access_role['U'] ){
            // open modal
            $this->unassigned_appointment_datetime = null;
            $this->dispatchBrowserEvent('openModal','acceptAppointment');
        }else{
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Please select appointment!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }
    }
    public function delete_appointment_modal(){
        $valid = false;
        foreach ($this->unassigned_appointment_data  as $key => $value) {
            if($this->unassigned_appointment_selected[$key][$value->appointment_id]){
                $valid = true;
            }
        }

        // accessrole read
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($valid &&  $this->access_role['U'] ){
            // open modal
            $this->unassigned_appointment_datetime = null;
            $this->dispatchBrowserEvent('openModal','deleteAppointment');
        }else{
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Please select appointment!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }
    }
    public function delete_appointment(){
        $valid = false;
        foreach ($this->unassigned_appointment_data  as $key => $value) {
            if($this->unassigned_appointment_selected[$key][$value->appointment_id]){
                $valid = true;
            }
        }

        // accessrole read
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($valid &&  $this->access_role['U'] ){
            // open modal
            // validate datetime

            foreach ($this->unassigned_appointment_data  as $key => $value) {
                if($this->unassigned_appointment_selected[$key][$value->appointment_id]){
                    $appointment_details = DB::table('appointments')
                    ->where('appointment_id','=',$value->appointment_id )
                    ->get()
                    ->first();
                    DB::table('notifications')
                    ->insert([
                        'notification_id' =>NULL ,
                        'notification_user_target' => $appointment_details->appointment_user_id ,
                        'notification_user_creator' => $this->user_details['user_id'],
                        'notification_icon_id' => 11 ,
                        'notification_title' => 'Appointment declined!' ,
                        'notification_content'  => 'Your appointment has been declined!' ,
                        'notification_link' => '/student/appointment'
                    ]);

                    DB::table('appointments')
                        ->where('appointment_id','=',$value->appointment_id )
                        ->update(['appointment_status_id'=>DB::table('status')->select('status_id')->where('status_details','=','Declined')->first()->status_id]);
                
                    
                    if($this->mail){
                        if(strlen($value->user_email)>0 && $value->user_email_verified ==1){
                            $this->status = 'Declined';
                            $this->reason = NULL;
                            $this->schedule = NULL;
                            $this->email = $value->user_email;
                            Mail::send('mail.appointment-status-email', [
                                'status'=>$this->status,
                                'reason'=>$this->reason,
                                'schedule'=>$this->schedule,
                                'email'=>$this->email], 
                                function($message) {
                            $message->to($this->email, $this->email)->subject
                            ('Appointment Delined');
                            $message->from('xyz@gmail.com','WMSU TESTING AND EVALUATION CENTER');
                        });
                        }
                    }
                }
            }
    
            $this->unassigned_appointment_datetime = null;
            self::update_data();

            $this->unassigned_appointment_selected = [];
            foreach ($this->unassigned_appointment_data  as $key => $value) {
                array_push($this->unassigned_appointment_selected,[$value->appointment_id=>false]);
            }
            $this->dispatchBrowserEvent('openModal','deleteAppointment');
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'success',
                'title'             									=> 'Successfully declined!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }else{
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Please select appointment!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }
    }
    public function delete_appointment_assgned(){
        $valid = false;
        foreach ($this->assigned_appointment_data  as $key => $value) {
            if($this->assigned_appointment_selected[$key][$value->appointment_id]){
                $valid = true;
            }
        }

        // accessrole read
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($valid &&  $this->access_role['U'] ){
            // open modal
            // validate datetime

            foreach ($this->assigned_appointment_data  as $key => $value) {
                if($this->assigned_appointment_selected[$key][$value->appointment_id]){

                    $appointment_details = DB::table('appointments')
                    ->where('appointment_id','=',$value->appointment_id )
                    ->get()
                    ->first();
                    DB::table('notifications')
                    ->insert([
                        'notification_id' =>NULL ,
                        'notification_user_target' => $appointment_details->appointment_user_id ,
                        'notification_user_creator' => $this->user_details['user_id'],
                        'notification_icon_id' => 11 ,
                        'notification_title' => 'Appointment declined!' ,
                        'notification_content'  => 'Your appointment has been declined!' ,
                        'notification_link' => '/student/appointment'
                    ]);

                    DB::table('appointments')
                        ->where('appointment_id','=',$value->appointment_id )
                        ->update(['appointment_status_id'=>DB::table('status')->select('status_id')->where('status_details','=','Declined')->first()->status_id]);
                
                    if($this->mail){
                        if(strlen($value->user_email)>0 && $value->user_email_verified ==1){
                            $this->status = 'Declined';
                            $this->reason = NULL;
                            $this->schedule = NULL;
                            $this->email = $value->user_email;
                            Mail::send('mail.appointment-status-email', [
                                'status'=>$this->status,
                                'reason'=>$this->reason,
                                'schedule'=>$this->schedule,
                                'email'=>$this->email], 
                                function($message) {
                            $message->to($this->email, $this->email)->subject
                            ('Appointment Delined');
                            $message->from('xyz@gmail.com','WMSU TESTING AND EVALUATION CENTER');
                        });
                        }
                    }
                }
            }
    
            $this->assigned_appointment_datetime = null;
            self::update_data();

            $this->assigned_appointment_selected = [];
            foreach ($this->assigned_appointment_data  as $key => $value) {
                array_push($this->assigned_appointment_selected,[$value->appointment_id=>false]);
            }
            $this->dispatchBrowserEvent('openModal','DeleteScheduleAppointmentModal');
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'success',
                'title'             									=> 'Successfully declined!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }else{
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Please select appointment!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }
    }
    public function accept_appointment(){
        $valid = false;
        foreach ($this->unassigned_appointment_data  as $key => $value) {
            if($this->unassigned_appointment_selected[$key][$value->appointment_id]){
                $valid = true;
            }
        }

        // accessrole read
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        $current_time = (strtotime(DB::select(DB::raw('SELECT NOW() as current_datetime'))[0]->current_datetime));
        $datetime = (strtotime($this->unassigned_appointment_datetime));
        if( $datetime  <  $current_time){
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Appointment time must be later than current time!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
            return;
        }
        if($valid &&  $this->access_role['U'] ){
            foreach ($this->unassigned_appointment_data  as $key => $value) {
                if($this->unassigned_appointment_selected[$key][$value->appointment_id]){

                    $appointment_details = DB::table('appointments')
                    ->where('appointment_id','=',$value->appointment_id )
                    ->where('appointment_status_id','=', DB::table('status')->select('status_id')->where('status_details','=','Pending')->first()->status_id)
                    ->get()
                    ->first();
                    DB::table('notifications')
                    ->insert([
                        'notification_id' =>NULL ,
                        'notification_user_target' => $appointment_details->appointment_user_id ,
                        'notification_user_creator' => $this->user_details['user_id'],
                        'notification_icon_id' => 9 ,
                        'notification_title' => 'Appointment Confirmed!' ,
                        'notification_content'  => 'Your appointment has been confirmed!' ,
                        'notification_link' => '/student/appointment'
                    ]);
                    DB::table('appointments')
                        ->where('appointment_id','=',$value->appointment_id )
                        ->where('appointment_status_id','=', DB::table('status')->select('status_id')->where('status_details','=','Pending')->first()->status_id)
                        ->update([
                            'appointment_status_id'=>DB::table('status')->select('status_id')->where('status_details','=','Accepted')->first()->status_id,
                            'appointment_datetime'=> $this->unassigned_appointment_datetime
                        ]);

                    if($this->mail){
                        if(strlen($value->user_email)>0 && $value->user_email_verified ==1){
                            $this->status = 'Scheduled';
                            $this->reason = NULL;
                            $this->schedule = $this->unassigned_appointment_datetime;
                            $this->email = $value->user_email;
                            Mail::send('mail.appointment-status-email', [
                                'status'=>$this->status,
                                'reason'=>$this->reason,
                                'schedule'=>$this->schedule,
                                'email'=>$this->email], 
                                function($message) {
                            $message->to($this->email, $this->email)->subject
                               ('Appointment Accepted');
                            $message->from('xyz@gmail.com','WMSU TESTING AND EVALUATION CENTER');
                         });
                        }
                    }
                }
            }
    
            $this->unassigned_appointment_datetime = null;
            self::update_data();

            $this->unassigned_appointment_selected = [];
            foreach ($this->unassigned_appointment_data  as $key => $value) {
                array_push($this->unassigned_appointment_selected,[$value->appointment_id=>false]);
            }
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'success',
                'title'             									=> 'Successfully accepted!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
            $this->dispatchBrowserEvent('openModal','acceptAppointment');
        }else{
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Please select appointment!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }
    }
    public function reschedule_appointment_modal(){
        $valid = false;
        foreach ($this->assigned_appointment_data  as $key => $value) {
            if($this->assigned_appointment_selected[$key][$value->appointment_id]){
                $valid = true;
            }
        }

        // accessrole read
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($valid &&  $this->access_role['U'] ){
            // open modal
            $this->assigned_appointment_datetime = null;
            $this->dispatchBrowserEvent('openModal','ReassigneAppointmentModal');
        }else{
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Please select appointment!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }
    }
    public function reschedule_appointment(){
        $valid = false;
        foreach ($this->assigned_appointment_data  as $key => $value) {
            if($this->assigned_appointment_selected[$key][$value->appointment_id]){
                $valid = true;
            }
        }

        // accessrole read
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        $current_time = (strtotime(DB::select(DB::raw('SELECT NOW() as current_datetime'))[0]->current_datetime));
        $datetime = (strtotime($this->assigned_appointment_datetime));
        if( $datetime  <  $current_time){
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Appointment time must be later than current time!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
            return;
        }
        if($valid &&  $this->access_role['U'] ){
            foreach ($this->assigned_appointment_data  as $key => $value) {
                if($this->assigned_appointment_selected[$key][$value->appointment_id]){
                    $appointment_details = DB::table('appointments')
                    ->where('appointment_id','=',$value->appointment_id )
                    ->get()
                    ->first();
                    DB::table('notifications')
                        ->insert([
                            'notification_id' =>NULL ,
                            'notification_user_target' => $appointment_details->appointment_user_id  ,
                            'notification_user_creator' => $this->user_details['user_id'],
                            'notification_icon_id' => 15 ,
                            'notification_title' => 'Appointment has been re-scheduled!' ,
                            'notification_content'  => 'Your appointment has been successfully re-scheduled!' ,
                            'notification_link' => '/student/appointment'
                        ]);

                    DB::table('appointments')
                        ->where('appointment_id','=',$value->appointment_id )
                        ->where('appointment_status_id','=', DB::table('status')->select('status_id')->where('status_details','=','Accepted')->first()->status_id)
                        ->update([
                            'appointment_datetime'=> $this->assigned_appointment_datetime
                    ]);

                    if($this->mail){
                        if(strlen($value->user_email)>0 && $value->user_email_verified ==1){
                            $this->status = 'Re-Scheduled';
                            $this->reason = NULL;
                            $this->schedule = $this->assigned_appointment_datetime;
                            $this->email = $value->user_email;
                            Mail::send('mail.appointment-status-email', [
                                'status'=>$this->status,
                                'reason'=>$this->reason,
                                'schedule'=>$this->schedule,
                                'email'=>$this->email], 
                                function($message) {
                            $message->to($this->email, $this->email)->subject
                               ('Appointment is Re-Scheduled');
                            $message->from('xyz@gmail.com','WMSU TESTING AND EVALUATION CENTER');
                         });
                        }
                    }

                }
            }
    
            $this->assigned_appointment_datetime = null;
            self::update_data();

            $this->assigned_appointment_selected = [];
            foreach ($this->assigned_appointment_data  as $key => $value) {
                array_push($this->assigned_appointment_selected,[$value->appointment_id=>false]);
            }
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'success',
                'title'             									=> 'Successfully rescheduled!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
            $this->dispatchBrowserEvent('openModal','ReassigneAppointmentModal');
        }else{
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Please select appointment!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }
    }
    public function remove_reschedule_appointment_modal(){
        $valid = false;
        foreach ($this->assigned_appointment_data  as $key => $value) {
            if($this->assigned_appointment_selected[$key][$value->appointment_id]){
                $valid = true;
            }
        }

        // accessrole read
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($valid &&  $this->access_role['U'] ){
            // open modal
            $this->assigned_appointment_datetime = null;
            $this->dispatchBrowserEvent('openModal','RemoveScheduleAppointmentModal');
        }else{
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Please select appointment!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }
    }
    public function remove_schedule_appointment(){
        $valid = false;
        foreach ($this->assigned_appointment_data  as $key => $value) {
            if($this->assigned_appointment_selected[$key][$value->appointment_id]){
                $valid = true;
            }
        }

        // accessrole read
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        
        if($valid &&  $this->access_role['U'] ){
            foreach ($this->assigned_appointment_data  as $key => $value) {
                if($this->assigned_appointment_selected[$key][$value->appointment_id]){

                    $appointment_details = DB::table('appointments')
                    ->where('appointment_id','=',$value->appointment_id )
                    ->get()
                    ->first();
                    DB::table('notifications')
                        ->insert([
                            'notification_id' =>NULL ,
                            'notification_user_target' => $appointment_details->appointment_user_id  ,
                            'notification_user_creator' => $this->user_details['user_id'],
                            'notification_icon_id' => 13 ,
                            'notification_title' => 'Appointment schedule removed!' ,
                            'notification_content'  => 'Your appointment has been schedule has been removed!' ,
                            'notification_link' => '/student/appointment'
                        ]);

                    DB::table('appointments')
                        ->where('appointment_id','=',$value->appointment_id )
                        ->where('appointment_status_id','=', DB::table('status')->select('status_id')->where('status_details','=','Accepted')->first()->status_id)
                        ->update([
                            'appointment_datetime'=> NULL,
                            'appointment_status_id'=> DB::table('status')->select('status_id')->where('status_details','=','Pending')->first()->status_id
                    ]);

                    if($this->mail){
                        if(strlen($value->user_email)>0 && $value->user_email_verified ==1){
                            $this->status = 'Schedule Removed';
                            $this->reason = NULL;
                            $this->schedule = NULL;
                            $this->email = $value->user_email;
                            Mail::send('mail.appointment-status-email', [
                                'status'=>$this->status,
                                'reason'=>$this->reason,
                                'schedule'=>$this->schedule,
                                'email'=>$this->email], 
                                function($message) {
                            $message->to($this->email, $this->email)->subject
                               ('Appointment Schedule Removed');
                            $message->from('xyz@gmail.com','WMSU TESTING AND EVALUATION CENTER');
                         });
                        }
                    }
                }
            }
    
            $this->assigned_appointment_datetime = null;
            self::update_data();

            $this->assigned_appointment_selected = [];
            foreach ($this->assigned_appointment_data  as $key => $value) {
                array_push($this->assigned_appointment_selected,[$value->appointment_id=>false]);
            }
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'success',
                'title'             									=> 'Successfully removed schedule!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
            $this->dispatchBrowserEvent('openModal','RemoveScheduleAppointmentModal');
        }else{
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Please select appointment!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }
    }
    public function delete_reschedule_appointment_modal(){
        $valid = false;
        foreach ($this->assigned_appointment_data  as $key => $value) {
            if($this->assigned_appointment_selected[$key][$value->appointment_id]){
                $valid = true;
            }
        }

        // accessrole read
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($valid &&  $this->access_role['U'] ){
            // open modal
            $this->assigned_appointment_datetime = null;
            $this->dispatchBrowserEvent('openModal','DeleteScheduleAppointmentModal');
        }else{
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Please select appointment!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }
    }
    public function complete_appointment($appointment_id){
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($this->access_role['U'] ){

            $appointment_details = DB::table('appointments')
                    ->where('appointment_id','=',$appointment_id )
                    ->get()
                    ->first();
            DB::table('notifications')
                ->insert([
                    'notification_id' =>NULL ,
                    'notification_user_target' => $appointment_details->appointment_user_id ,
                    'notification_user_creator' => $this->user_details['user_id'],
                    'notification_icon_id' => 14 ,
                    'notification_title' => 'Appointment Complete!' ,
                    'notification_content'  => 'Your appointment has been complete!' ,
                    'notification_link' => '/student/appointment'
                ]);
            DB::table('appointments')
            ->where('appointment_id','=',$appointment_id )
            ->where('appointment_status_id','=', DB::table('status')->select('status_id')->where('status_details','=','Accepted')->first()->status_id)
            ->update([
                'appointment_status_id'=>DB::table('status')->select('status_id')->where('status_details','=','Complete')->first()->status_id
            ]);

            $appointment_data = DB::table('appointments as a')
            ->select(
            'appointment_id',
            DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
            'user_email',
            'user_id',
            'user_email_verified',
            'user_phone',
            'appointment_purpose',
            'appointment_message',
            'appointment_preferred_date',
            'appointment_preferred_time',
            'appointment_datetime',
            'status_details',
            )
            ->join('users as u','u.user_id','a.appointment_user_id')
            ->join('status as s','s.status_id','a.appointment_status_id')
            ->where('appointment_id','=',$appointment_id )
            ->orderBy('a.date_created','desc')
            ->first();

            if($this->mail){
                if(strlen($appointment_data->user_email)>0 && $appointment_data->user_email_verified ==1){
                    $this->status = 'Complete';
                    $this->reason = NULL;
                    $this->schedule = NULL;
                    $this->email = $appointment_data->user_email;
                    Mail::send('mail.appointment-status-email', [
                        'status'=>$this->status,
                        'reason'=>$this->reason,
                        'schedule'=>$this->schedule,
                        'email'=>$this->email], 
                        function($message) {
                    $message->to($this->email, $this->email)->subject
                       ('Appointment Complete');
                    $message->from('xyz@gmail.com','WMSU TESTING AND EVALUATION CENTER');
                 });
                }
            }

            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'success',
                'title'             									=> 'Accepted appointment is now complete!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);

            self::update_data();


            $this->unassigned_appointment_selected = [];
            foreach ($this->unassigned_appointment_data  as $key => $value) {
                array_push($this->unassigned_appointment_selected,[$value->appointment_id=>false]);
            }

            $this->assigned_appointment_selected = [];
            foreach ($this->assigned_appointment_data  as $key => $value) {
                array_push($this->assigned_appointment_selected,[$value->appointment_id=>false]);
            }
        }

    }
    
}
