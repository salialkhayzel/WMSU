<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Mail;

class RoomManagement extends Component
{

    public $mail = true;

    
    public $user_detais;
    public $title;

    public $active;

    public $school_room_data;
    public $school_room = [
        'school_room_id' =>NULL,
        'school_room_isactive' =>NULL,
        'school_room_bldg_name' =>NULL,
        'school_room_bldg_abr' =>NULL,
        'school_room_name' =>NULL,
        'school_room_number' =>NULL,
        'school_room_max_capacity' =>NULL,
        'school_room_proctor_user_id' =>NULL,
        'school_room_test_center_id' =>NULL,
        'school_room_description' =>NULL,
    ];

    public $test_center_data; 
    public $test_center = [
        'id' =>NULL,
        'test_center_code' =>NULL,
        'test_center_name' =>NULL,
        'test_center_code_name' =>NULL,
        'test_center_isactive' =>NULL,
    ];

    public $test_schedule_data;
    public $test_schedules = [
        'id' => NULL,
        'test_date' => NULL,
        'test_center_id' => NULL,
        'cet_type_id' => NULL
    ];

    public $proctor_data;
    
    public $assigned_examinees_data;

    public $assigned_room_data;

    public $examinees_data;

    public $room_schedule;
    public $proctor = [ 
        'id' => NULL,
        'schedule_room_id' => NULL,
        'schedule_id' => NULL,
        'room_id' => NULL,
        'user_id' => NULL
    ];
       
    
    public $test_date;

    public $column_order = 't_a_id';
    public $order_by = 'asc';

    public $page = 1;
    public $cet_form = [
        't_a_id' => NULL,
        't_a_test_type_id' => NULL,
        't_a_applicant_user_id' => NULL,
        't_a_test_status_id' => NULL,
        't_a_test_center_id' =>NULL,
        't_a_user_details' => NULL,
        't_a_isactive' => 1,

        't_a_citizenship' => NULL,
        't_a_date_of_graduation' => NULL,
        't_a_course' => NULL,
        't_a_school_school_name'=> NULL,
        't_a_school_address' => NULL,

        't_a_formal_photo' => NULL,
        't_a_school_principal_certification' => NULL,
        't_a_original_senior_high_school_card' => NULL,
        't_a_transcript_of_records' => NULL,
        't_a_endorsement_letter_from_wmsu_dean' => NULL,
        't_a_receipt_photo' => NULL,  // note that if the applicant is taking second time
        't_a_times_taken' => NULL,

        't_a_formal_photo_id' => NULL,
        't_a_school_principal_certification_id' => NULL,
        't_a_original_senior_high_school_card_id' => NULL,
        't_a_transcript_of_records_id' => NULL,
        't_a_endorsement_letter_from_wmsu_dean_id'  => NULL,
        't_a_receipt_photo_id'  => NULL,

        't_a_1st_choice' => NULL,
        't_a_2nd_choice' => NULL,
        't_a_3rd_choice' => NULL,

        // parent 
        't_a_f_citizenship' => NULL,
        't_a_f_hef' => NULL,
        't_a_f_occupation'  => NULL,
        't_a_f_place_of_work' => NULL,
        't_a_f_monthly_salary' => "N/A",

        't_a_m_citizenship' => NULL,
        't_a_m_hef' => NULL,
        't_a_m_occupation' => NULL,
        't_a_m_place_of_work' => NULL,
        't_a_m_monthly_salary' => "N/A",

        't_a_computer_literate' => NULL,
        't_a_ethnic_group' => NULL,
        't_a_religious_affiliation' => NULL,
        't_a_accept' => NULL,

        't_a_cet_type_id' => NULL,
        't_a_cet_type_details' => 'SENIOR HIGH SCHOOL GRADUATING STUDENT',
        't_a_cet_english_procficiency' => NULL,
        't_a_cet_reading_comprehension'  => NULL,
        't_a_cet_science_process_skills' => NULL,
        't_a_cet_quantitative_skills' => NULL,
        't_a_cet_abstract_thinking_skills' => NULL,
        't_a_cet_oapr' => NULL,

        't_a_declined_reason' => NULL,
        't_a_declined_by' => NULL,
        't_a_accepted_by' => NULL,   
        't_a_assigned_by' => NULL,
        't_a_proctor_assigned_by' => NULL,
        't_a_returned_by' => NULL,
        't_a_returned_reason' => NULL,
        't_a_proctor_user_id' => NULL,
        't_a_school_room_id' => NULL,

        't_a_school_year_id' => NULL,
        't_a_hash'  => NULL,
    ];


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
        $this->application_view_details = null;
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($this->access_role['C'] || $this->access_role['R'] || $this->access_role['U'] || $this->access_role['D']){

           
                
           
        }
    }
    public function update_data(){
        $this->exam_types = DB::table('test_types')
            ->select('test_type_id','test_type_name')
            ->get()
            ->toArray();

        $this->school_rooms = DB::table('school_rooms as sr')
            ->join('test_centers as tc','tc.id','sr.school_room_test_center_id')
            ->leftjoin('users as u', 'u.user_id', '=', 'sr.school_room_proctor_user_id')
            ->select(
                '*'
            )
            ->get()
            ->toArray();
        
        $this->proctor_data = DB::table('users as u')
            ->select(
                "user_id",
                "user_firstname",
                "user_middlename",
                "user_lastname",
                "user_addr_street",
                "user_addr_brgy",
                "user_addr_city_mun",
                "user_addr_province"
            )
            // ->join('user_roles as ur', 'u.user_role_id', '=', 'ur.user_role_id')
            ->rightJoin('access_roles as ar', 'u.user_id', '=', 'ar.access_role_user_id')
            ->join('modules as m', 'ar.access_role_module_id', '=', 'm.module_id')
            // access_role_user_id 
            ->where('m.module_nav_name','=','Exam Administrator')
            ->get()
            ->toArray();
        

        $this->test_center_data = DB::table('test_centers')
            // ->where('test_center_isactive','=','1')
            ->get()
            ->toArray();
        $this->test_schedule_data = DB::table('test_schedules as ts')
            ->select(
                "ts.id as id",
                "test_date",
                "test_center_id",
                "ct.cet_type_id",
                "am_start",
                "am_end",
                "pm_start",
                "pm_end",
                "isactive",
                "ts.created_at",
                "ts.updated_at",
                "test_center_code",
                "test_center_name",
                "test_center_code_name",
                "test_center_isactive",
                "cet_type_name",
                "cet_type_details",
            )
            ->join('test_centers as tc','tc.id','ts.test_center_id')
            ->join('cet_types as ct', 'ct.cet_type_id', '=', 'ts.cet_type_id')
            ->get()
            ->toArray();
        $this->assigned_test_date = DB::table('test_applications as ta')
            ->select(
                'tsc.id as test_schedule_id',
                'test_date'
            )
            ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
            ->join('test_schedules as tsc', 'tsc.id', '=', 'ta.t_a_test_schedule_id')
            ->join('school_rooms as sr', 'sr.school_room_id', '=', 'ta.t_a_school_room_id')
            ->where('t_a_isactive','=',1)
            ->where('test_status_details','=','Accepted')
            ->groupBy('tsc.id')
            ->get()
            ->toArray();
            
             

            $this->assigned_room_data = DB::table('test_applications as ta')
            ->select(
                // '*',
                "school_room_id",
                'tsc.id as test_schedule_id',
                DB::raw('count(t_a_id) as total_examinees_count'),
                DB::raw('CONCAT(t_a_test_schedule_id," - ",t_a_school_room_id) as schedule_room_id'),
                "school_room_isactive",
                "school_room_bldg_name",
                "school_room_bldg_abr",
                "school_room_name",
                "school_room_number",
                "school_room_max_capacity",
                "school_room_proctor_user_id",
                "school_room_test_center_id",
                "test_center_code",
                "test_center_name",
                "test_center_code_name",
                "test_center_isactive",
                "p.user_id as user_id",
                "user_firstname",
                "user_middlename",
                "user_lastname",
                "user_suffix",
            )
            ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
            ->join('test_schedules as tsc', 'tsc.id', '=', 'ta.t_a_test_schedule_id')
            ->join('school_rooms as sr', 'sr.school_room_id', '=', 'ta.t_a_school_room_id')
            ->join('test_centers as tc','tc.id','sr.school_room_test_center_id')
            ->leftjoin('proctors as p','p.schedule_room_id',DB::raw('CONCAT(t_a_test_schedule_id," - ",t_a_school_room_id)'))
            ->leftjoin('users as u', 'u.user_id', '=', 'p.user_id')
            ->where('t_a_isactive','=',1)
            ->where('test_status_details','=','Accepted')
            ->where('t_a_test_schedule_id','=', $this->test_date)
            ->groupBy('t_a_school_room_id')
            ->orderBy('t_a_school_room_id')
            ->get()
            ->toArray();
            //   dd($this->assigned_room_data );

    }

    public function mount(Request $request){
        $this->user_details = $request->session()->all();
        $this->title = 'room-management';
        $this->active = 'assigned_room';

        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($this->access_role['C'] || $this->access_role['R'] || $this->access_role['U'] || $this->access_role['D']){

            $this->unassigned_applicant_filter = [
                'Select all' => true,
                '#' => true,
                'Code' => true,
                'Applicant name'=> true,
                'Exam type'=> true,
                'Room venue'=> true,
                'School Year'=> true,
                // 'A.Y.'=> true,
                'Date applied'	=> true,								
                'Actions'	=> true					
            ];

            $this->assigned_room_filter = [
                '#' => true,
                'Proctor'=>true,
                'Test Center Code - Name'=>true,
                'Test Center Name'=>false,
                'Test Center Code'=>false,
                'Building name'=>true,
                'Room name'=> true,
                'Room no.'=> false,
                'Room Description' => false,
                '# of Examinees' => true,	
                'Capacity' => true,							
                'Actions'	=> true					
            ];

            $this->school_room_filter = [
                // 'Select all' => true,
                '#' => true,
                'Test Center Name'=>true,
                'Test Center Code'=>true,
                'Building name'=>true,
                'Room name'=> true,
                'Room no.'=> true,
                'Room Description' => false,
                'Capacity' => true,	
                'Status'=> true,							
                'Actions'	=> true					
            ];

          

            $this->test_center_filter = [
                '#' => true,
                'Test Center Code' =>true,
                'Test Center Name' =>true,
                'Test Center Code Name' =>true,
                'isactive?' =>true,
                'Actions'=>true
            ];

            $this->test_schedule_filter = [
                '#' => true,
                'Test Date' =>true,
                'Test Center Code' =>true,
                'Test Center Name' =>true,
                'Student Type' =>false,
                'AM' =>true,
                'PM' =>true,
                'Actions'=>true
            ];

            // 'school_room_id' =>NULL,
            // 'school_room_isactive' =>NULL,
            // 'school_room_bldg_name' =>NULL,
            // 'school_room_bldg_abr' =>NULL,
            // 'school_room_name' =>NULL,
            // 'school_room_number' =>NULL,
            // 'school_room_max_capacity' =>NULL,
            // 'school_room_proctor_user_id' =>NULL,

           self::update_data();
           if($this->assigned_test_date){
                $this->test_date = $this->assigned_test_date[0]->test_schedule_id;
            }
            self::update_data();
            // dd($this->assigned_room_data );
        }
    }
    public function render(){
        return view('livewire.admin.room-management',[
            'user_details' => $this->user_details
            ])
            ->layout('layouts.admin',[
                'title'=>$this->title]);
    }

    public function unassigned_applicant_filterView(){
        $this->dispatchBrowserEvent('swal:redirect',[
            'position'          									=> 'center',
            'icon'              									=> 'success',
            'title'             									=> 'Successfully changed filter!',
            'showConfirmButton' 									=> 'true',
            'timer'             									=> '1000',
            'link'              									=> '#'
        ]);

    }

    public function assigned_applicant_filterView(){
        $this->dispatchBrowserEvent('swal:redirect',[
            'position'          									=> 'center',
            'icon'              									=> 'success',
            'title'             									=> 'Successfully changed filter!',
            'showConfirmButton' 									=> 'true',
            'timer'             									=> '1000',
            'link'              									=> '#'
        ]);

    }

    

  

    public function school_room_filterView(){
        $this->dispatchBrowserEvent('swal:redirect',[
            'position'          									=> 'center',
            'icon'              									=> 'success',
            'title'             									=> 'Successfully changed filter!',
            'showConfirmButton' 									=> 'true',
            'timer'             									=> '1000',
            'link'              									=> '#'
        ]);

    }

   

    

    



    

    // rooms crud
    public function active_page($active){
        $this->active = $active;

      self::update_data();
    }


    public function view_examinees_list($test_schedule_id,$school_room_id){
        self::schedule_room_data($test_schedule_id,$school_room_id);

        // $this->user_details 

        $this->dispatchBrowserEvent('openModal','studentListModal');
        self::update_data();
    }

    public function schedule_room_data($test_schedule_id,$school_room_id){
        $schedule_data = DB::table('test_applications as ta')
        ->select(
            "school_room_id",
            "school_room_bldg_name",
            "school_room_bldg_abr",
            "school_room_name",
            "school_room_number",
            "school_room_test_center_id",
            "test_center_code",
            "test_center_name",
            'tsc.id as test_schedule_id',
            'tsc.test_date as test_date',
        )
        ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
        ->join('test_schedules as tsc', 'tsc.id', '=', 'ta.t_a_test_schedule_id')
        ->join('school_rooms as sr', 'sr.school_room_id', '=', 'ta.t_a_school_room_id')
        ->join('test_centers as tc','tc.id','sr.school_room_test_center_id')
        ->where('t_a_isactive','=',1)
        ->where('test_status_details','=','Accepted')
        ->where('t_a_school_room_id','=', $school_room_id)
        ->where('t_a_test_schedule_id','=', $test_schedule_id)
        ->first();


        $this->room_schedule = [
            "school_room_id" => $schedule_data->school_room_id,
            "school_room_bldg_name" => $schedule_data->school_room_bldg_name,
            "school_room_bldg_abr" => $schedule_data->school_room_bldg_abr,
            "school_room_name" => $schedule_data->school_room_name,
            "school_room_number" => $schedule_data->school_room_number, 
            "school_room_test_center_id" => $schedule_data->school_room_test_center_id,
            "test_center_code" => $schedule_data->test_center_code,
            "test_center_name" => $schedule_data->test_center_name,
            "test_schedule_id"=> $schedule_data->test_schedule_id,
            "test_date"=> $schedule_data->test_date,
            "ampm"=> "AM",
        ];

        $this->examinees_data = DB::table('test_applications as ta')
        ->select(
            '*',
            "school_room_id",
            "school_room_isactive",
            "school_room_bldg_name",
            "school_room_bldg_abr",
            "school_room_name",
            "school_room_number",
            "school_room_max_capacity",
            "school_room_proctor_user_id",
            "school_room_test_center_id",
            "test_center_code",
            "test_center_name",
            "test_center_code_name",
            "test_center_isactive",
            DB::raw('DATE(ta.date_created) as applied_date')
        )
        ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
        ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
        ->join('test_schedules as tsc', 'tsc.id', '=', 'ta.t_a_test_schedule_id')
        ->join('school_rooms as sr', 'sr.school_room_id', '=', 'ta.t_a_school_room_id')
        ->join('test_centers as tc','tc.id','sr.school_room_test_center_id')
        ->where('t_a_isactive','=',1)
        ->where('test_status_details','=','Accepted')
        ->where('t_a_school_room_id','=', $school_room_id)
        ->where('t_a_test_schedule_id','=', $test_schedule_id)
        ->get()
        ->toArray();
    }

    public function view_schedule_change($test_schedule_id,$school_room_id,$ampm){
        self::schedule_room_data($test_schedule_id,$school_room_id);
        $this->room_schedule['ampm'] = $ampm;

        self::update_data();
    }
    public function edit_schedule_room($test_schedule_id,$school_room_id){
        if($proctor = DB::table('proctors as p')
            ->where('schedule_room_id','=', $test_schedule_id.' - '.$school_room_id)
            ->first()){
            $this->proctor = [ 
                'id' => $proctor->id,
                'schedule_room_id' =>  $proctor->schedule_room_id,
                'schedule_id' =>  $proctor->schedule_id,
                'room_id' =>  $proctor->room_id,
                'user_id' =>  $proctor->user_id
            ];
        }else{
            $this->proctor = [ 
                'id' => NULL,
                'schedule_room_id' => $test_schedule_id.' - '.$school_room_id,
                'schedule_id' => $test_schedule_id,
                'room_id' => $school_room_id,
                'user_id' => NULL
            ];
        }

        $schedule_data = DB::table('test_applications as ta')
        ->select(
            "school_room_id",
            "school_room_bldg_name",
            "school_room_bldg_abr",
            "school_room_name",
            "school_room_number",
            "school_room_test_center_id",
            "test_center_code",
            "test_center_name",
            'tsc.id as test_schedule_id',
            'tsc.test_date as test_date',
        )
        ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
        ->join('test_schedules as tsc', 'tsc.id', '=', 'ta.t_a_test_schedule_id')
        ->join('school_rooms as sr', 'sr.school_room_id', '=', 'ta.t_a_school_room_id')
        ->join('test_centers as tc','tc.id','sr.school_room_test_center_id')
        ->where('t_a_isactive','=',1)
        ->where('test_status_details','=','Accepted')
        ->where('t_a_school_room_id','=', $school_room_id)
        ->where('t_a_test_schedule_id','=', $test_schedule_id)
        ->first();

        $this->room_schedule = [
            "school_room_id" => $schedule_data->school_room_id,
            "school_room_bldg_name" => $schedule_data->school_room_bldg_name,
            "school_room_bldg_abr" => $schedule_data->school_room_bldg_abr,
            "school_room_name" => $schedule_data->school_room_name,
            "school_room_number" => $schedule_data->school_room_number, 
            "school_room_test_center_id" => $schedule_data->school_room_test_center_id,
            "test_center_code" => $schedule_data->test_center_code,
            "test_center_name" => $schedule_data->test_center_name,
            "test_schedule_id"=> $schedule_data->test_schedule_id,
            "test_date"=> $schedule_data->test_date,
        ];


        $this->dispatchBrowserEvent('openModal','editTestScheduleRoomProctorModal');
        self::update_data();
    }
    public function save_edit_schedule_room(){
       
        // check conflict
        if($proctor = DB::table('proctors as p')
            ->where('schedule_room_id','=', $this->proctor['schedule_id'].' - '.$this->proctor['room_id'])
            ->first()){
            if( isset($this->proctor['user_id']) && intval($this->proctor['user_id'])>0){
               DB::table('proctors')
                ->update([
                    'user_id' => $this->proctor['user_id']
                ]);
            }else{
                DB::table('proctors')
                ->where('id','=',$this->proctor['id'])
                ->delete();
            }
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'success',
                'title'             									=> 'successfully updated!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }else{
            // insert
            if( isset($this->proctor['user_id'])){
                if(DB::table('proctors')
                    ->where('schedule_id','=', $this->proctor['schedule_id'])
                    ->where('user_id','=', $this->proctor['user_id'])
                    ->get()
                    ->first()
                    ){
                        $this->dispatchBrowserEvent('swal:redirect',[
                            'position'          									=> 'center',
                            'icon'              									=> 'warning',
                            'title'             									=> 'Proctor Conflict with other room schedule!',
                            'showConfirmButton' 									=> 'true',
                            'timer'             									=> '1500',
                            'link'              									=> '#'
                        ]);
                    }else{
                        DB::table('proctors')
                        ->insert([
                            'id' => NULL,
                            'schedule_id' =>  $this->proctor['schedule_id'],
                            'room_id' =>  $this->proctor['room_id'],
                            'user_id' => $this->proctor['user_id']
                        ]);

                        $this->dispatchBrowserEvent('swal:redirect',[
                            'position'          									=> 'center',
                            'icon'              									=> 'success',
                            'title'             									=> 'successfully updated!',
                            'showConfirmButton' 									=> 'true',
                            'timer'             									=> '1500',
                            'link'              									=> '#'
                        ]);
                    }
                
            }else{
                
            }
            
        }

       

        $this->dispatchBrowserEvent('openModal','editTestScheduleRoomProctorModal');
        self::update_data();


    }

    public function add_room(){
        $this->school_room = [
            'school_room_id' =>NULL,
            'school_room_isactive' =>NULL,
            'school_room_bldg_name' =>NULL,
            'school_room_bldg_abr' =>NULL,
            'school_room_name' =>NULL,
            'school_room_number' =>NULL,
            'school_room_max_capacity' =>30,
            'school_room_description' =>NULL,
            'school_room_proctor_user_id' =>NULL,
            'school_room_test_center_id' =>NULL,
        ];

        $this->dispatchBrowserEvent('openModal','addRoomModal');
        self::update_data();
    }
    public function save_add_room(){
        if(empty($this->school_room['school_room_test_center_id'])||
        empty($this->school_room['school_room_bldg_name']) ||
        empty($this->school_room['school_room_bldg_abr']) ||
        empty($this->school_room['school_room_name']) ||
        empty($this->school_room['school_room_number']) ||
        empty($this->school_room['school_room_max_capacity'])
        ){
            return ;
        }
        if(intval($this->school_room['school_room_test_center_id'])<=0){
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Please select test center!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
            return;
        }
        if(intval($this->school_room['school_room_max_capacity'])<=0){
            return;
        }
        if(DB::table('school_rooms')
            ->insert([
                'school_room_id' =>NULL,
                'school_room_isactive' =>1,
                'school_room_bldg_name' =>$this->school_room['school_room_bldg_name'],
                'school_room_bldg_abr' =>$this->school_room['school_room_bldg_abr'],
                'school_room_name' =>$this->school_room['school_room_name'],
                'school_room_number' =>$this->school_room['school_room_number'],
                'school_room_max_capacity' =>$this->school_room['school_room_max_capacity'],
                'school_room_description' =>$this->school_room['school_room_description'],
                'school_room_proctor_user_id' =>NULL,
                'school_room_test_center_id' =>$this->school_room['school_room_test_center_id'],
        ])){
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'success',
                'title'             									=> 'Successfully added!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }else{
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Unsuccessfully added!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }
 
        $this->dispatchBrowserEvent('openModal','addRoomModal');
        self::update_data();
    }
    public function edit_room($school_room_id){
        $school_room = DB::table('school_rooms as sr')
            ->join('test_centers as tc','tc.id','sr.school_room_test_center_id')
            ->where('school_room_id','=',$school_room_id)
            ->first();
        $this->school_room = [
            'school_room_id' => $school_room->school_room_id,
            'school_room_isactive' => $school_room->school_room_isactive,
            'school_room_bldg_name' =>$school_room->school_room_bldg_name,
            'school_room_bldg_abr' =>$school_room->school_room_bldg_abr,
            'school_room_name' =>$school_room->school_room_name,
            'school_room_number' =>$school_room->school_room_number,
            'school_room_max_capacity' =>$school_room->school_room_max_capacity,
            'school_room_description' =>$school_room->school_room_description,
            'school_room_proctor_user_id' =>$school_room->school_room_proctor_user_id,
            'school_room_test_center_id' =>$school_room->school_room_test_center_id,
        ];
        
        $this->dispatchBrowserEvent('openModal','editRoomModal');
        self::update_data();
    }
    public function save_edit_room($school_room_id){
        if(empty($this->school_room['school_room_test_center_id'])||
        empty($this->school_room['school_room_bldg_name']) ||
        empty($this->school_room['school_room_bldg_abr']) ||
        empty($this->school_room['school_room_name']) ||
        empty($this->school_room['school_room_number']) ||
        empty($this->school_room['school_room_max_capacity'])
        ){
            return ;
        }
        if(intval($this->school_room['school_room_test_center_id'])<=0){
            return;
        }
        if(intval($this->school_room['school_room_max_capacity'])<=0){
            return;
        }
    
        if(DB::table('school_rooms')
            ->where('school_room_id','=',$school_room_id)
            ->update([
                'school_room_bldg_name' =>$this->school_room['school_room_bldg_name'],
                'school_room_bldg_abr' =>$this->school_room['school_room_bldg_abr'],
                'school_room_name' =>$this->school_room['school_room_name'],
                'school_room_number' =>$this->school_room['school_room_number'],
                'school_room_max_capacity' =>$this->school_room['school_room_max_capacity'],
                'school_room_description' =>$this->school_room['school_room_description'],
                'school_room_test_center_id' =>$this->school_room['school_room_test_center_id'],
                'school_room_proctor_user_id' =>$this->school_room['school_room_proctor_user_id'],
        ])){
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'success',
                'title'             									=> 'Successfully updated!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }else{
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Unsuccessfully updated!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }
        $this->dispatchBrowserEvent('openModal','editRoomModal');
        self::update_data();
    }
    public function delete_room($school_room_id){
        $school_room = DB::table('school_rooms as sr')
            ->join('test_centers as tc','tc.id','sr.school_room_test_center_id')
            ->where('school_room_id','=',$school_room_id)
            ->first();
        $this->school_room = [
            'school_room_id' => $school_room->school_room_id,
            'school_room_isactive' => $school_room->school_room_isactive,
            'school_room_bldg_name' =>$school_room->school_room_bldg_name,
            'school_room_bldg_abr' =>$school_room->school_room_bldg_abr,
            'school_room_name' =>$school_room->school_room_name,
            'school_room_number' =>$school_room->school_room_number,
            'school_room_max_capacity' =>$school_room->school_room_max_capacity,
            'school_room_description' =>$school_room->school_room_description,
            'school_room_proctor_user_id' =>$school_room->school_room_proctor_user_id,
            'school_room_test_center_id' =>$school_room->school_room_test_center_id,
        ];
        
        $this->dispatchBrowserEvent('openModal','DeleteRoomModal');
        self::update_data();
    }
    public function save_delete_room($school_room_id){
        if(DB::table('school_rooms')
            ->where('school_room_id','=',$school_room_id)
            ->update([
                'school_room_isactive' =>0,
        ])){
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'success',
                'title'             									=> 'Successfully updated!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }else{
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Unsuccessfully updated!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }
        $this->dispatchBrowserEvent('openModal','DeleteRoomModal');
        self::update_data();
    }
    public function activate_room($school_room_id){
        $school_room = DB::table('school_rooms as sr')
            ->join('test_centers as tc','tc.id','sr.school_room_test_center_id')
            ->where('school_room_id','=',$school_room_id)
            ->first();
        $this->school_room = [
            'school_room_id' => $school_room->school_room_id,
            'school_room_isactive' => $school_room->school_room_isactive,
            'school_room_bldg_name' =>$school_room->school_room_bldg_name,
            'school_room_bldg_abr' =>$school_room->school_room_bldg_abr,
            'school_room_name' =>$school_room->school_room_name,
            'school_room_number' =>$school_room->school_room_number,
            'school_room_max_capacity' =>$school_room->school_room_max_capacity,
            'school_room_description' =>$school_room->school_room_description,
            'school_room_proctor_user_id' =>$school_room->school_room_proctor_user_id,
            'school_room_test_center_id' =>$school_room->school_room_test_center_id,
        ];
        
        $this->dispatchBrowserEvent('openModal','ActivateRoomModal');
        self::update_data();
    }
    public function save_actvate_room($school_room_id){
        if(DB::table('school_rooms')
            ->where('school_room_id','=',$school_room_id)
            ->update([
                'school_room_isactive' =>0,
        ])){
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'success',
                'title'             									=> 'Successfully updated!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }else{
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Unsuccessfully updated!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }
        $this->dispatchBrowserEvent('openModal','ActivateRoomModal');
        self::update_data();
    }
    public function save_activate_room($school_room_id){
        if(DB::table('school_rooms')
            ->where('school_room_id','=',$school_room_id)
            ->update([
                'school_room_isactive' =>1,
        ])){
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'success',
                'title'             									=> 'Successfully activated!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }else{
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Unsuccessfully activated!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }
        $this->dispatchBrowserEvent('openModal','ActivateRoomModal');
        self::update_data();
    }

    public function add_test_center(){
        $this->test_center = [
            'id' =>NULL,
            'test_center_code' =>NULL,
            'test_center_name' =>NULL,
            'test_center_code_name' =>NULL,
            'test_center_isactive' =>NULL,
        ];

        $this->dispatchBrowserEvent('openModal','addTestCenterModal');
        self::update_data();
    }
    public function save_add_test_center(){
        if(
        empty($this->test_center['test_center_code']) || 
        empty($this->test_center['test_center_name'])){
            return;
        }

        if(DB::table('test_centers')
            ->insert([
                'id' =>NULL,
                'test_center_code' =>$this->test_center['test_center_code'],
                'test_center_name' =>$this->test_center['test_center_name'],
                'test_center_code_name' =>$this->test_center['test_center_code_name'],
                'test_center_isactive' =>1,
        ])){
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'success',
                'title'             									=> 'Successfully added!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }else{
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Unsuccessfully added!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }

        $this->dispatchBrowserEvent('openModal','addTestCenterModal');
        self::update_data();
    }
    public function delete_test_center($id){
        if($test_center = DB::table('test_centers')
            ->where('id','=',$id)
            ->first()){
            $this->test_center = [
                'id' => $test_center->id,
                'test_center_code' => $test_center->test_center_code,
                'test_center_name' =>$test_center->test_center_name,
                'test_center_code_name' =>$test_center->test_center_code_name,
                'test_center_isactive' => $test_center->test_center_isactive,
            ];
            $this->dispatchBrowserEvent('openModal','deleteTestCenterModal');
            self::update_data();
        }
    }
    public function save_delete_test_center($id){
        if(DB::table('test_centers')
            ->where('id','=',$id)
            ->update([
                'test_center_isactive' =>0
            ])){
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'success',
                'title'             									=> 'Successfully updated!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }else{
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Unsuccessfully updated!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }
        $this->dispatchBrowserEvent('openModal','deleteTestCenterModal');
        self::update_data();
    }
    public function activate_test_center($id){
        if($test_center = DB::table('test_centers')
            ->where('id','=',$id)
            ->first()){
            $this->test_center = [
                'id' => $test_center->id,
                'test_center_code' => $test_center->test_center_code,
                'test_center_name' =>$test_center->test_center_name,
                'test_center_code_name' =>$test_center->test_center_code_name,
                'test_center_isactive' => $test_center->test_center_isactive,
            ];
            $this->dispatchBrowserEvent('openModal','ActivateTestCenterModal');
            self::update_data();
        }
    }
    public function save_activate_test_center($id){
        if(DB::table('test_centers')
            ->where('id','=',$id)
            ->update([
                'test_center_isactive' =>1
            ])){
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'success',
                'title'             									=> 'Successfully updated!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }else{
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Unsuccessfully updated!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }
        $this->dispatchBrowserEvent('openModal','ActivateTestCenterModal');
        self::update_data();
    }
    public function edit_test_center($id){
        if($test_center = DB::table('test_centers')
            ->where('id','=',$id)
            ->first()){
            $this->test_center = [
                'id' => $test_center->id,
                'test_center_code' => $test_center->test_center_code,
                'test_center_name' =>$test_center->test_center_name,
                'test_center_code_name' =>$test_center->test_center_code_name,
                'test_center_isactive' => $test_center->test_center_isactive,
            ];
            $this->dispatchBrowserEvent('openModal','editTestCenterModal');
            self::update_data();
        }
    }
    public function save_edit_test_center($id){
        if(DB::table('test_centers')
            ->where('id','=',$id)
            ->update([
                'test_center_code' => $this->test_center['test_center_code'],
                'test_center_name' => $this->test_center['test_center_name'],
                'test_center_code_name' => $this->test_center['test_center_code_name'],
            ])){
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'success',
                'title'             									=> 'Successfully updated!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }else{
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Unsuccessfully updated!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }
        $this->dispatchBrowserEvent('openModal','editTestCenterModal');
        self::update_data();
    }

    public function view_application($t_a_id){


        $cet_form = DB::table('test_applications as ta')
            ->select('*',DB::raw('DATE(ta.date_created) as applied_date'))
            ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
            // ->join('users as us', 'us.user_id', '=', 'ta.t_a_applicant_user_id')
            // ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'ta.t_a_applicant_user_id')
            ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
            ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
            ->join('cet_types as ct', 'ct.cet_type_id', '=', 'ta.t_a_cet_type_id')
            // ->join('school_rooms as sr', 'sr.school_room_id', '=', 'ta.t_a_school_room_id')
            
            ->where('test_type_details', '=', 'College Entrance Test')
            ->where('t_a_id','=',$t_a_id)
            ->first();
        
            $user_details =DB::table('users as u')
            ->select(
                "u.user_id",
                "u.user_status_id",
                "u.user_sex_id",
                "u.user_gender_id",
                "u.user_role_id",
                "u.user_name",
                "u.user_email",
                "u.user_phone",
                "u.user_name_verified",
                "u.user_email_verified",
                "u.user_phone_verified",
                "u.user_firstname",
                "u.user_middlename",
                "u.user_lastname",
                "u.user_suffix",
                "user_citizenship",
                "u.user_addr_street",
                "u.user_addr_brgy",
                "u.user_addr_city_mun",
                "u.user_addr_province",
                "u.user_addr_zip_code",
                "u.user_birthdate",
                "u.user_profile_picture",
                "u.user_formal_id",
                "u.date_created",
                "u.date_updated",
                "user_status_details",
                "user_sex_details",
                "user_gender_details",
                "user_role_details",
            )
            ->join('user_status as us', 'u.user_status_id', '=', 'us.user_status_id')
            ->join('user_sex as usex', 'u.user_sex_id', '=', 'usex.user_sex_id')
            ->join('user_genders as ug', 'u.user_gender_id', '=', 'ug.user_gender_id')
            ->join('user_roles as ur', 'u.user_role_id', '=', 'ur.user_role_id')
            ->where('user_id','=',$cet_form->t_a_applicant_user_id)
            ->first();
        $this->applicant_details = [
            "user_id" => $user_details->user_id,
            "user_status_id"  => $user_details->user_status_id,
            "user_sex_id"=> $user_details->user_sex_id,
            "user_gender_id"=> $user_details->user_gender_id,
            "user_role_id"=> $user_details->user_role_id,
            "user_name"=> $user_details->user_name,
            "user_email"=> $user_details->user_email,
            "user_phone"=> $user_details->user_phone,
            "user_name_verified"=> $user_details->user_name_verified,
            "user_email_verified"=> $user_details->user_email_verified,
            "user_phone_verified"=> $user_details->user_phone_verified,
            "user_firstname"=> $user_details->user_firstname,
            "user_middlename"=> $user_details->user_middlename,
            "user_lastname"=> $user_details->user_lastname,
            "user_suffix"=> $user_details->user_suffix,
            'user_citizenship' => $user_details->user_citizenship,
            "user_addr_street"=> $user_details->user_addr_street,
            "user_addr_brgy"=> $user_details->user_addr_brgy,
            "user_addr_city_mun"=> $user_details->user_addr_city_mun,
            "user_addr_province"=> $user_details->user_addr_province,
            "user_addr_zip_code"=> $user_details->user_addr_zip_code,
            "user_birthdate"=> $user_details->user_birthdate,
            "user_age"=> floor((time() - strtotime($user_details->user_birthdate)) / 31556926),
            "user_profile_picture"=> $user_details->user_profile_picture,
            "user_formal_id"=> $user_details->user_formal_id,
            "date_created"=> $user_details->date_created,
            "date_updated"=> $user_details->date_updated,
            "user_status_details"=> $user_details->user_status_details,
            "user_sex_details"=> $user_details->user_sex_details,
            "user_gender_details"=> $user_details->user_gender_details,
            "user_role_details"=> $user_details->user_role_details,
        ];
            
        $this->cet_form = [
            't_a_id' => $cet_form->t_a_id,
            't_a_test_type_id' => $cet_form->t_a_test_type_id,
            't_a_applicant_user_id' => $cet_form->t_a_applicant_user_id,
            't_a_test_status_id' => $cet_form->t_a_test_status_id,
            't_a_test_center_id' =>$cet_form->t_a_test_center_id,
            't_a_user_details' => $cet_form->t_a_user_details,
            't_a_isactive' => $cet_form->t_a_isactive,

            't_a_citizenship' => $cet_form->t_a_citizenship,
            't_a_date_of_graduation' => $cet_form->t_a_date_of_graduation,
            't_a_course' => $cet_form->t_a_course,
            't_a_school_school_name'=> $cet_form->t_a_school_school_name,
            't_a_school_address' => $cet_form->t_a_school_address,

            't_a_formal_photo' => $cet_form->t_a_formal_photo,
            't_a_school_principal_certification' => $cet_form->t_a_school_principal_certification,
            't_a_original_senior_high_school_card' => $cet_form->t_a_original_senior_high_school_card,
            't_a_transcript_of_records' => $cet_form->t_a_transcript_of_records,
            't_a_endorsement_letter_from_wmsu_dean' => $cet_form->t_a_endorsement_letter_from_wmsu_dean,
            't_a_receipt_photo' => $cet_form->t_a_receipt_photo,  // note that if the applicant is taking second time


            't_a_1st_choice' => $cet_form->t_a_1st_choice,
            't_a_2nd_choice' => $cet_form->t_a_2nd_choice,
            't_a_3rd_choice' => $cet_form->t_a_3rd_choice,

            // parent 
            't_a_f_citizenship' => $cet_form->t_a_f_citizenship,
            't_a_f_hef' => $cet_form->t_a_f_hef,
            't_a_f_occupation'  => $cet_form->t_a_f_occupation,
            't_a_f_place_of_work' => $cet_form->t_a_f_place_of_work,
            't_a_f_monthly_salary' => $cet_form->t_a_f_monthly_salary,

            't_a_m_citizenship' => $cet_form->t_a_m_citizenship,
            't_a_m_hef' => $cet_form->t_a_m_hef,
            't_a_m_occupation' => $cet_form->t_a_m_occupation,
            't_a_m_place_of_work' => $cet_form->t_a_m_place_of_work,
            't_a_m_monthly_salary' => $cet_form->t_a_m_monthly_salary,

            't_a_computer_literate' => $cet_form->t_a_computer_literate,
            't_a_ethnic_group' => $cet_form->t_a_ethnic_group,
            't_a_religious_affiliation' => $cet_form->t_a_religious_affiliation,
            't_a_accept' => $cet_form->t_a_accept,

            't_a_cet_type_id' => $cet_form->cet_type_id,
            't_a_cet_type_details' => $cet_form->cet_type_details,
            't_a_cet_english_procficiency' => $cet_form->t_a_cet_english_procficiency,
            't_a_cet_reading_comprehension'  => $cet_form->t_a_cet_reading_comprehension,
            't_a_cet_science_process_skills' => $cet_form->t_a_cet_science_process_skills,
            't_a_cet_quantitative_skills' => $cet_form->t_a_cet_quantitative_skills,
            't_a_cet_abstract_thinking_skills' => $cet_form->t_a_cet_abstract_thinking_skills,
            't_a_cet_oapr' => $cet_form->t_a_cet_oapr,

            't_a_declined_reason' => $cet_form->t_a_declined_reason,
            't_a_declined_by' => $cet_form->t_a_declined_by,
            't_a_accepted_by' => $cet_form->t_a_accepted_by,   
            't_a_assigned_by' => $cet_form->t_a_assigned_by,
            't_a_proctor_assigned_by' => $cet_form->t_a_proctor_assigned_by,
            't_a_returned_by' => $cet_form->t_a_returned_by,
            't_a_returned_reason' => $cet_form->t_a_returned_reason,
            't_a_proctor_user_id' => $cet_form->t_a_proctor_user_id,
            't_a_school_room_id' => $cet_form->t_a_school_room_id,

            't_a_school_year_id' => $cet_form->t_a_school_year_id,
            't_a_hash'  => $cet_form->t_a_hash,
        ];

        $this->cet_type_data = DB::table('cet_types')
        ->get()
        ->toArray();
        foreach($this->cet_type_data as $key =>$value){
            if($value->cet_type_id == $this->cet_form['t_a_cet_type_id']){
                $this->cet_form['t_a_cet_type_details'] = $value->cet_type_details;
                break;
            }
        
        }
        // dd($this->cet_form);
        self::update_data();
        self::schedule_room_data($this->room_schedule['test_schedule_id'],$this->room_schedule['school_room_id']);
        $this->dispatchBrowserEvent('openModal','view_application_modal');
    }  
    public function cet_application(){
        if($this->page == 1){
            $this->page = 2;
            $this->dispatchBrowserEvent('moveUp');
        }elseif($this->page == 2){
        }
        self::update_data();
        self::schedule_room_data($this->room_schedule['test_schedule_id'],$this->room_schedule['school_room_id']);
    }
    public function page($page){
        $this->page = $page;
        $this->dispatchBrowserEvent('moveUp');

        if($this->page == 1){
            // check data
        }
        self::update_data();
        self::schedule_room_data($this->room_schedule['test_schedule_id'],$this->room_schedule['school_room_id']);
    }

    public function add_test_schedule(){
        $this->test_schedules = [
            'id' => NULL,
            'test_date' => NULL,
            'test_center_id' => NULL,
            'cet_type_id' => NULL,
            'am_start' => '07:00',
            'am_end' => '12:00',
            'pm_start' => '12:00',
            'pm_end' => '17:00',
        ];
        $this->dispatchBrowserEvent('openModal','addTestSchedule');
        self::update_data();
    }
    public function save_add_test_schedule(){
        if(intval($this->test_schedules['test_center_id'])>0 &&
            DB::table('test_centers')
                ->where('id','=',$this->test_schedules['test_center_id'])
                ->get()
                ->first()){
            if(DB::table('test_schedules')
                ->insert([
                    'id' => NULL,
                    'test_date' => $this->test_schedules['test_date'],
                    'test_center_id' => $this->test_schedules['test_center_id'],
                    'cet_type_id' => 1,
                    'am_start' => $this->test_schedules['am_start'],
                    'am_end' => $this->test_schedules['am_end'],
                    'pm_start' => $this->test_schedules['pm_start'],
                    'pm_end' => $this->test_schedules['pm_end'],
                ])){
                    $this->dispatchBrowserEvent('swal:redirect',[
                        'position'          									=> 'center',
                        'icon'              									=> 'success',
                        'title'             									=> 'Successfuly added!',
                        'showConfirmButton' 									=> 'true',
                        'timer'             									=> '1500',
                        'link'              									=> '#'
                    ]);
                    $this->test_schedules = [
                        'id' => NULL,
                        'test_date' => NULL,
                        'test_center_id' => NULL,
                        'cet_type_id' => NULL,
                        'am_start' => '07:00',
                        'am_end' => '12:00',
                        'pm_start' => '12:00',
                        'pm_end' => '17:00',
                    ];
                    $this->dispatchBrowserEvent('openModal','addTestSchedule');
                }
        }else{
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Please select valid test center!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }
        self::update_data();
    }

    public function edit_test_schedule($id){
        $test_schedule = DB::table('test_schedules')
            ->where('id','=',$id)
            ->get()
            ->first();
        $this->test_schedules = [
            'id' => $test_schedule->id,
            'test_date' => $test_schedule->test_date,
            'test_center_id' => $test_schedule->test_center_id,
            'cet_type_id' => $test_schedule->cet_type_id,
            'am_start' => $test_schedule->am_start,
            'am_end' => $test_schedule->am_end,
            'pm_start' => $test_schedule->pm_start,
            'pm_end' => $test_schedule->pm_end,
        ];
        $this->dispatchBrowserEvent('openModal','EditTestSchedule');
        self::update_data();
    }

}

