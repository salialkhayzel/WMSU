<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Mail;

class ScheduleManagement extends Component
{

    public $mail = true;

    
    public $user_detais;
    public $title;

    public $exam_schedules;
    public $exam_schedule = [ 
        'es_id'  =>NULL,
        'es_exam_details' =>NULL,
        'es_exam_abr' =>NULL,
        'es_date_start' =>NULL,
        'es_date_end' =>NULL,
        'es_isactive' =>NULL,
        ];
    public $exam_filters;

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
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];
        if($this->access_role['C'] || $this->access_role['R'] || $this->access_role['U'] || $this->access_role['D']){
            self::update_data();
        }
    }

    public function update_data(){

        $this->exam_schedules = DB::table('exam_schedules')
            ->select('*')
            ->get()
            ->toArray();
        // dd($this->exam_schedules);

    }
    public function mount(Request $request){
        $this->user_details = $request->session()->all();
        $this->title = 'dashboard';

        $this->exam_filters = [
            '#'=> true,
            'Exam name'=> true,
            'Exam Abr'=> true,
            'start-end'=> true,
            'Status'=>true,
            'Action' =>true

        ];

        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($this->access_role['C'] || $this->access_role['R'] || $this->access_role['U'] || $this->access_role['D']){
            self::update_data();
        }
    }
    public function render()
    {
        return view('livewire.admin.schedule-management',[
            'user_details' => $this->user_details
            ])
            ->layout('layouts.admin',[
                'title'=>$this->title]);
    }
    public function edit_exam_schedule($es_id){
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];
        if($this->access_role['U']){
            $exam_schedule = DB::table('exam_schedules')
                ->select('*')
                ->where('es_id','=',$es_id)
                ->first();

            $this->exam_schedule = [ 
                'es_id'  =>$exam_schedule->es_id,
                'es_exam_details' =>$exam_schedule->es_exam_details,
                'es_exam_abr' =>$exam_schedule->es_exam_abr,
                'es_date_start' =>$exam_schedule->es_date_start,
                'es_date_end' =>$exam_schedule->es_date_end,
                'es_isactive' =>$exam_schedule->es_isactive
                ];
            $this->dispatchBrowserEvent('openModal','editScheduleModal');
        }
    }
    public function save_edit_exam_schedule($es_id){
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];
        if($this->access_role['U']){
            // validate
            if(strlen($this->exam_schedule['es_exam_details'])<=0){
                return 0;
            }
            if(strlen($this->exam_schedule['es_exam_abr'])<=0){
                return 0;
            }
            $es_date_start=date_create($this->exam_schedule['es_date_start']);
            $es_date_end=date_create($this->exam_schedule['es_date_end']);
            $diff=date_diff($es_date_end,$es_date_start);
            if(intval($diff->format("%R%a"))>=0){
                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'icon'              									=> 'warning',
                    'title'             									=> 'Range should be at least 1 day!',
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '1500',
                    'link'              									=> '#'
                ]);
                return;
            }
            // dd($this->exam_schedule['es_isactive']);
            if(DB::table('exam_schedules')
                ->where('es_id','=',$es_id)
                ->update([
                    'es_exam_details' =>$this->exam_schedule['es_exam_details'],
                    'es_exam_abr' =>$this->exam_schedule['es_exam_abr'],
                    'es_date_start' =>$this->exam_schedule['es_date_start'],
                    'es_date_end' =>$this->exam_schedule['es_date_end'],
                    'es_isactive' =>intval($this->exam_schedule['es_isactive'])
                ])){
                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'icon'              									=> 'success',
                    'title'             									=> 'Successfully updated!',
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '1500',
                    'link'              									=> '#'
                ]);
                self::update_data();
                $this->dispatchBrowserEvent('openModal','editScheduleModal');
            }
         
        }
    }
}
