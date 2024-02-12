<?php

namespace App\Http\Livewire\Admin;

// use Livewire\WithPagination;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
// use Livewire\WithPagination;
use Mail;

class ApplicationManagement extends Component
{
    // use WithPagination;

    public $mail = false;

    public $user_detais;
    public $title;

    public $active;

    

    public $selected_all;
    public $selected = [];

    // pagination
    public $per_page = 10;

    public $items;
    public $item_first = 0 ;
    public $item_current ;
    public $item_last;
    public $cursor = 0;
    public $next_pages;
    public $next_page_count;
    public $prev_pages;
    public $prev_page_count;
    public $page_number = 1;

    

    // pending applicant data
    public $pending_applicant_data;
    public $pending_test_type_id = 0;
    public $pending_applicant_filter;
    public $pending_selected_all;
    public $pending_selected = [];
    public $declined_pending_valid = false;
    public $declined_pending_reason;
    public $pending_search;
   
    // Accepted applicant data
    public $accepted_applicant_data;
    public $accepted_test_type_id= 0;
    public $accepted_applicant_filter;
    public $accepted_selected_all;
    public $accepted_selected = [];
    public $declined_accepted_valid = false;
    public $declined_accepted_reason;
    public $return_reason;
    public $accepted_search;

    // declined applicant data
    public $declined_applicant_data;
    public $declined_test_type_id= 0;
    public $declined_applicant_filter;
    public $declined_selected_all;
    public $declined_selected = [];
    public $delete_declined_valid;

    public $application_view_details;
    public $application_user_name;

    public $exam_types;
    public $column_order = 't_a_id';
    public $order_by = 'asc';
    public $access_role ;

    public $return_valid;



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

            $this->exam_types = DB::table('test_types')
                    ->select('test_type_id','test_type_name')
                    ->get()
                    ->toArray();

            if($this->pending_test_type_id == 0){
                $this->pending_applicant_data = DB::table('test_applications as ta')
                ->select(
                    // '*',
                    'school_year_details',
                    't_a_id',
                    'user_email',
                    'user_id',
                    'user_email_verified',
                    DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                    'test_type_name',
                    DB::raw('DATE(ta.date_created) as date_applied')
                    )
                ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
                ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
                ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
                ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
                ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
                ->where('t_a_isactive','=',1)
                ->where('ts.test_status_details','=','Pending')
                ->orderBy($this->column_order, 'asc')
                ->get()
                ->toArray();
            }else{
                $this->pending_applicant_data = DB::table('test_applications as ta')
                ->select(
                    // '*',
                    'school_year_details',
                    't_a_id',
                    'user_email',
                    'user_id',
                    'user_email_verified',
                    DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                    'test_type_name',
                    DB::raw('DATE(ta.date_created) as date_applied')
                    )
                ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
                ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
                ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
                ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
                ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
                ->where('t_a_isactive','=',1)
                ->where('test_status_details','=','Pending')
                ->where('t_a_test_type_id','=',$this->pending_test_type_id)
                ->orderBy($this->column_order, 'asc')
                ->get()
                ->toArray();
            }

            if($this->accepted_test_type_id == 0){
                $this->accepted_applicant_data = DB::table('test_applications as ta')
                ->select(
                    // '*',
                    'school_year_details',
                    't_a_id',
                    'user_email',
                    'user_id',
                    'user_email_verified',
                    DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                    'test_type_name',
                    DB::raw('DATE(ta.date_created) as date_applied')
                    )
                ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
                ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
                ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
                ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
                ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
                ->where('t_a_isactive','=',1)
                ->where('ts.test_status_details','=','Accepted')
                ->orderBy($this->column_order, 'asc')
                ->get()
                ->toArray();
            }else{
                $this->accepted_applicant_data = DB::table('test_applications as ta')
                ->select(
                    // '*',
                    'school_year_details',
                    't_a_id',
                    'user_email',
                    'user_id',
                    'user_email_verified',
                    DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                    'test_type_name',
                    DB::raw('DATE(ta.date_created) as date_applied')
                    )
                ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
                ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
                ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
                ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
                ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
                ->where('t_a_isactive','=',1)
                ->where('test_status_details','=','Accepted')
                ->where('t_a_test_type_id','=',$this->accepted_test_type_id)
                ->orderBy($this->column_order, 'asc')
                ->get()
                ->toArray();
            }

            if($this->declined_test_type_id == 0){
                $this->declined_applicant_data = DB::table('test_applications as ta')
                ->select(
                    // '*',
                    'school_year_details',
                    't_a_id',
                    'user_email',
                    'user_id',
                    'user_email_verified',
                    DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                    'test_type_name',
                    DB::raw('DATE(ta.date_created) as date_applied'),
                    't_a_declined_reason'
                    )
                ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
                ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
                ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
                ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
                ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
                ->where('t_a_isactive','=',0)
                ->where('test_status_details','=','Declined')
                ->orderBy($this->column_order, 'asc')
                ->get()
                ->toArray();
            }else{
                $this->declined_applicant_data = DB::table('test_applications as ta')
                ->select(
                    // '*',
                    'school_year_details',
                    't_a_id',
                    'user_email',
                    'user_id',
                    'user_email_verified',
                    DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                    'test_type_name',
                    DB::raw('DATE(ta.date_created) as date_applied'),
                    't_a_declined_reason'
                    )
                ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
                ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
                ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
                ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
                ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
                ->where('t_a_isactive','=',0)
                ->where('test_status_details','=','Declined')
                ->where('t_a_test_type_id','=',$this->declined_test_type_id)
                ->orderBy($this->column_order, 'asc')
                ->get()
                ->toArray();
            }

            foreach ($this->pending_applicant_data  as $key => $value) {
                array_push($this->pending_selected,[$value->t_a_id=>false]);
            }
            foreach ($this->accepted_applicant_data  as $key => $value) {
                array_push($this->accepted_selected,[$value->t_a_id=>false]);
            }

            foreach ($this->declined_applicant_data  as $key => $value) {
                array_push($this->declined_selected,[$value->t_a_id=>false]);
            }
            
        }

        
    }

    public function update_data(){
        $this->cet_type_data = DB::table('cet_types')
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

            
        $this->school_rooms = DB::table('school_rooms as sr')
            ->join('test_centers as tc','tc.id','sr.school_room_test_center_id')
            ->select(
                '*'
            )
            ->get()
            ->toArray();
        
        $this->test_schedule_data = DB::table('test_schedules as ts')
            ->join('test_centers as tc','tc.id','ts.test_center_id')
            ->join('cet_types as ct', 'ct.cet_type_id', '=', 'ts.cet_type_id')
            ->get()
            ->toArray();

           
    }
    public function mount(Request $request){
        $this->user_details = $request->session()->all();
        $this->title = 'application-management';

        self::update_data();

        // accessrole read
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($this->access_role['C'] || $this->access_role['R'] || $this->access_role['U'] || $this->access_role['D']){

            $this->active = 'pending';

            $this->pending_applicant_filter = [
                'Select all' => true,
                '#' => true,
                'Code' => true,
                'Applicant name'=> true,
                'Exam type'=> true,
                'School Year'=> true,
                'Date applied'	=> true,
                'Status'=> true,								
                'Actions'	=> true					
            ];
            $this->accepted_applicant_filter = [
                'Select all' => true,
                '#' => true,
                'Code' => true,
                'Applicant name'=> true,
                'Exam type'=> true,
                'School Year'=> true,
                'Date applied'	=> true,	
                'Status'=> true,							
                'Actions'	=> true					
            ];

            $this->declined_applicant_filter = [
                'Select all' => true,
                '#' => true,
                'Code' => true,
                'Applicant name'=> true,
                'Exam type'=> true,
                'School Year'=> true,
                'Date applied'	=> true,
                'Status'=> true,	
                'Reason'=> true,								
                'Actions'	=> false					
            ];

            $this->exam_types = DB::table('test_types')
                ->select('test_type_id','test_type_name')
                ->get()
                ->toArray();

            $this->pending_selected_all = false;
            $this->pending_selected = [];
            $this->pending_test_type_id = 0;

            $this->accepted_selected_all = false;
            $this->accepted_selected = [];
            $this->accepted_test_type_id = 0;

            $this->declined_selected_all = false;
            $this->declined_selected = [];
            $this->declined_test_type_id = 0;

            self::hydrate();

            foreach ($this->pending_applicant_data  as $key => $value) {
                array_push($this->pending_selected,[$value->t_a_id=>false]);
            }
            foreach ($this->accepted_applicant_data  as $key => $value) {
                array_push($this->accepted_selected,[$value->t_a_id=>false]);
            }

            foreach ($this->declined_applicant_data  as $key => $value) {
                array_push($this->declined_selected,[$value->t_a_id=>false]);
            }           

        }else{
            $this->redirect('/admin/dashboard');
        }
        
    }

    public function render(){
        

        return view('livewire.admin.application-management',[
            'user_details' => $this->user_details,
            ])
            ->layout('layouts.admin',[
                'title'=>$this->title]);
    }

    public function active_page($active){
        $this->active = $active;

        if($this->access_role['C'] || $this->access_role['R'] || $this->access_role['U'] || $this->access_role['D']){

            $this->exam_types = DB::table('test_types')
                ->select('test_type_id','test_type_name')
                ->get()
                ->toArray();

            $this->pending_selected_all = false;
            $this->pending_selected = [];

            $this->accepted_selected_all = false;
            $this->accepted_selected = [];

            $this->declined_selected_all = false;
            $this->declined_selected = [];

            if($this->pending_test_type_id == 0){
                $this->pending_applicant_data = DB::table('test_applications as ta')
                ->select(
                    // '*',
                    'school_year_details',
                    't_a_id',
                    'user_email',
                    'user_id',
                    'user_email_verified',
                    DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                    'test_type_name',
                    DB::raw('DATE(ta.date_created) as date_applied')
                    )
                ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
                ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
                ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
                ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
                ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
                ->where('t_a_isactive','=',1)
                ->where('ts.test_status_details','=','Pending')
                ->orderBy($this->column_order, 'asc')
                ->get()
                ->toArray();
            }else{
                $this->pending_applicant_data = DB::table('test_applications as ta')
                ->select(
                    // '*',
                    'school_year_details',
                    't_a_id',
                    'user_email',
                    'user_id',
                    'user_email_verified',
                    DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                    'test_type_name',
                    DB::raw('DATE(ta.date_created) as date_applied')
                    )
                ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
                ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
                ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
                ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
                ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
                ->where('t_a_isactive','=',1)
                ->where('test_status_details','=','Pending')
                ->where('t_a_test_type_id','=',$this->pending_test_type_id)
                ->orderBy($this->column_order, 'asc')
                ->get()
                ->toArray();
            }

            if($this->accepted_test_type_id == 0){
                $this->accepted_applicant_data = DB::table('test_applications as ta')
                ->select(
                    // '*',
                    'school_year_details',
                    't_a_id',
                    'user_email',
                    'user_id',
                    'user_email_verified',
                    DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                    'test_type_name',
                    DB::raw('DATE(ta.date_created) as date_applied')
                    )
                ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
                ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
                ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
                ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
                ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
                ->where('t_a_isactive','=',1)
                ->where('ts.test_status_details','=','Accepted')
                ->orderBy($this->column_order, 'asc')
                ->get()
                ->toArray();
            }else{
                $this->accepted_applicant_data = DB::table('test_applications as ta')
                ->select(
                    // '*',
                    'school_year_details',
                    't_a_id',
                    'user_email',
                    'user_id',
                    'user_email_verified',
                    DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                    'test_type_name',
                    DB::raw('DATE(ta.date_created) as date_applied')
                    )
                ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
                ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
                ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
                ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
                ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
                ->where('t_a_isactive','=',1)
                ->where('test_status_details','=','Accepted')
                ->where('t_a_test_type_id','=',$this->accepted_test_type_id)
                ->orderBy($this->column_order, 'asc')
                ->get()
                ->toArray();
            }

            if($this->declined_test_type_id == 0){
                $this->declined_applicant_data = DB::table('test_applications as ta')
                ->select(
                    // '*',
                    'school_year_details',
                    't_a_id',
                    'user_email',
                    'user_id',
                    'user_email_verified',
                    DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                    'test_type_name',
                    DB::raw('DATE(ta.date_created) as date_applied'),
                    't_a_declined_reason'
                    )
                ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
                ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
                ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
                ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
                ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
                ->where('t_a_isactive','=',0)
                ->where('test_status_details','=','Declined')
                ->orderBy($this->column_order, 'asc')
                ->get()
                ->toArray();
            }else{
                $this->declined_applicant_data = DB::table('test_applications as ta')
                ->select(
                    // '*',
                    'school_year_details',
                    't_a_id',
                    'user_email',
                    'user_id',
                    'user_email_verified',
                    DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                    'test_type_name',
                    DB::raw('DATE(ta.date_created) as date_applied'),
                    't_a_declined_reason'
                    )
                ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
                ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
                ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
                ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
                ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
                ->where('t_a_isactive','=',0)
                ->where('test_status_details','=','Declined')
                ->where('t_a_test_type_id','=',$this->declined_test_type_id)
                ->orderBy($this->column_order, 'asc')
                ->get()
                ->toArray();
            }

            foreach ($this->pending_applicant_data  as $key => $value) {
                array_push($this->pending_selected,[$value->t_a_id=>false]);
            }
            foreach ($this->accepted_applicant_data  as $key => $value) {
                array_push($this->accepted_selected,[$value->t_a_id=>false]);
            }

            foreach ($this->declined_applicant_data  as $key => $value) {
                array_push($this->declined_selected,[$value->t_a_id=>false]);
            }
            $this->application_view_details = null;
            
        }
    }

    public function pending_applicant_filterView(){
        
        $this->dispatchBrowserEvent('swal:redirect',[
            'position'          									=> 'center',
            'icon'              									=> 'success',
            'title'             									=> 'Successfully changed filter!',
            'showConfirmButton' 									=> 'true',
            'timer'             									=> '1000',
            'link'              									=> '#'
        ]);

    }

    public function accepted_applicant_filterView(){
        
        $this->dispatchBrowserEvent('swal:redirect',[
            'position'          									=> 'center',
            'icon'              									=> 'success',
            'title'             									=> 'Successfully changed filter!',
            'showConfirmButton' 									=> 'true',
            'timer'             									=> '1000',
            'link'              									=> '#'
        ]);

    }

    public function declined_applicant_filterView(){
        
        $this->dispatchBrowserEvent('swal:redirect',[
            'position'          									=> 'center',
            'icon'              									=> 'success',
            'title'             									=> 'Successfully changed filter!',
            'showConfirmButton' 									=> 'true',
            'timer'             									=> '1000',
            'link'              									=> '#'
        ]);

    }

    


    public function pending_applicant_select_all(){
        
        if($this->pending_selected_all){
            $this->pending_selected=[];
            foreach ($this->pending_applicant_data  as $key => $value) {
                array_push($this->pending_selected,[$value->t_a_id=>true]);
            }
        }else{
            $this->pending_selected=[];
            foreach ($this->pending_applicant_data  as $key => $value) {
                array_push($this->pending_selected,[$value->t_a_id=>false]);
            }
        }

 
    }

    public function accepted_applicant_select_all(){
        
        if($this->accepted_selected_all){
            $this->accepted_selected=[];
            foreach ($this->accepted_applicant_data as $key => $value) {
                array_push($this->accepted_selected,[$value->t_a_id=>true]);
            }
        }else{
            $this->accepted_selected=[];
            foreach ($this->accepted_applicant_data as $key => $value) {
                array_push($this->accepted_selected,[$value->t_a_id=>false]);
            }
        }
 
    }

    public function declined_applicant_select_all(){
        
        if($this->declined_selected_all){
            $this->declined_selected=[];
            foreach ($this->declined_applicant_data as $key => $value) {
                array_push($this->declined_selected,[$value->t_a_id=>true]);
            }
        }else{
            $this->declined_selected=[];
            foreach ($this->declined_applicant_data as $key => $value) {
                array_push($this->declined_selected,[$value->t_a_id=>false]);
            }
        }
 
    }

   
    public function pending_application_exam_type_filter(){
        

        if($this->pending_test_type_id == 0){
            $this->pending_applicant_data = DB::table('test_applications as ta')
            ->select(
                // '*',
                'school_year_details',
                't_a_id',
                'user_email',
                'user_id',
                'user_email_verified',
                DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                'test_type_name',
                DB::raw('DATE(ta.date_created) as date_applied')
                )
            ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
            ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
            ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
            ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
            ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
            ->where('t_a_isactive','=',1)
            ->where('ts.test_status_details','=','Pending')
            ->orderBy($this->column_order, 'asc')
            ->get()
            ->toArray();
        }else{
            $this->pending_applicant_data = DB::table('test_applications as ta')
            ->select(
                // '*',
                'school_year_details',
                't_a_id',
                'user_email',
                'user_id',
                'user_email_verified',
                DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                'test_type_name',
                DB::raw('DATE(ta.date_created) as date_applied')
                )
            ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
            ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
            ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
            ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
            ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
            ->where('t_a_isactive','=',1)
            ->where('test_status_details','=','Pending')
            ->where('t_a_test_type_id','=',$this->pending_test_type_id)
            ->orderBy($this->column_order, 'asc')
            ->get()
            ->toArray();
        }

        $this->pending_selected_all = false;
        $this->pending_selected = [];

        foreach ($this->pending_applicant_data  as $key => $value) {
            array_push($this->pending_selected,[$value->t_a_id=>false]);
        }

        
       



    }  
    
    public function accepted_application_exam_type_filter(){
        if($this->accepted_test_type_id == 0){
            $this->accepted_applicant_data = DB::table('test_applications as ta')
            ->select(
                // '*',
                'school_year_details',
                't_a_id',
                'user_email',
                'user_id',
                'user_email_verified',
                DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                'test_type_name',
                DB::raw('DATE(ta.date_created) as date_applied')
                )
            ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
            ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
            ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
            ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
            ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
            ->where('t_a_isactive','=',1)
            ->where('ts.test_status_details','=','Processing')
            ->orderBy($this->column_order, 'asc')
            ->get()
            ->toArray();
        }else{
            $this->accepted_applicant_data = DB::table('test_applications as ta')
            ->select(
                // '*',
                'school_year_details',
                't_a_id',
                'user_email',
                'user_id',
                'user_email_verified',
                DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                'test_type_name',
                DB::raw('DATE(ta.date_created) as date_applied')
                )
            ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
            ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
            ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
            ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
            ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
            ->where('t_a_isactive','=',1)
            ->where('test_status_details','=','Processing')
            ->where('t_a_test_type_id','=',$this->accepted_test_type_id)
            ->orderBy($this->column_order, 'asc')
            ->get()
            ->toArray();
        }

        $this->accepted_selected_all = false;
        $this->accepted_selected = [];

        foreach ($this->accepted_applicant_data  as $key => $value) {
            array_push($this->accepted_selected,[$value->t_a_id=>false]);
        }
    }  

    public function declined_application_exam_type_filter(){
        if($this->declined_test_type_id == 0){
            $this->declined_applicant_data = DB::table('test_applications as ta')
            ->select(
                // '*',
                'school_year_details',
                't_a_id',
                'user_email',
                'user_id',
                'user_email_verified',
                DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                'test_type_name',
                DB::raw('DATE(ta.date_created) as date_applied'),
                't_a_declined_reason'
                )
            ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
            ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
            ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
            ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
            ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
            ->where('t_a_isactive','=',1)
            ->where('ts.test_status_details','=','Declined')
            ->orderBy($this->column_order, 'asc')
            ->get()
            ->toArray();
        }else{
            $this->declined_applicant_data = DB::table('test_applications as ta')
            ->select(
                // '*',
                'school_year_details',
                't_a_id',
                'user_email',
                'user_id',
                'user_email_verified',
                DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                'test_type_name',
                DB::raw('DATE(ta.date_created) as date_applied'),
                't_a_declined_reason'
                )
            ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
            ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
            ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
            ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
            ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
            ->where('t_a_isactive','=',1)
            ->where('test_status_details','=','Declined')
            ->where('t_a_test_type_id','=',$this->declined_test_type_id)
            ->orderBy($this->column_order, 'asc')
            ->get()
            ->toArray();
        }

        $this->declined_selected_all = false;
        $this->declined_selected = [];

        foreach ($this->declined_applicant_data  as $key => $value) {
            array_push($this->declined_selected,[$value->t_a_id=>false]);
        }
    } 

    public function get_schedule($test_schedules,$date,$test_center_id){
        $date_now_time_stamp = strtotime($date);
        foreach (  $this->test_schedule_data as $test_schedule_key => $value) {
            $test_date_time_stamp = strtotime(date($value->test_date));
            if($test_date_time_stamp > $date_now_time_stamp && $value->test_center_id == $test_center_id){
                return  $value;
            }
        }
    }
    public function get_school_rooms(){
        return (DB::table('school_rooms as sr')
        ->join('test_centers as tc','tc.id','sr.school_room_test_center_id')
        ->select(
            '*'
        )
        ->where('school_room_isactive','=',1)
        ->get()
        ->toArray());
    }
    public function get_populated_rooms($test_schedule_id ,$test_center_id){
        return DB::table('test_applications as ta')
        ->select(
            'school_room_max_capacity',
            't_a_ampm as ampm',
            't_a_test_schedule_id as test_schedule_id',
            'test_center_id',
            't_a_school_room_id',
        )
            ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
            ->join('test_schedules as tsc', 'tsc.id', '=', 'ta.t_a_test_schedule_id')
            ->join('school_rooms as sr', 'sr.school_room_id', '=', 'ta.t_a_school_room_id')
            // ->right('')
            
            ->where('t_a_isactive','=',1)
            ->where('test_status_details','=','Accepted')
            ->where('t_a_test_schedule_id','=',$test_schedule_id)
            ->where('test_center_id','=',$test_center_id)
            ->get()
            ->toArray();
    }
    public function get_available_room($school_rooms,$test_center_id){
        foreach ($school_rooms as $key => $value) {
            if($value->id == $test_center_id ){
                return $value;
            }
        }
    }

    public function tally_rooms($populated_rooms){
        $room_slots = [];
        // $room_slots = [
        //     '1'=>
        //     ['AM'=>['number_of_examinees'=>0,'school_room_max_capacity'=>0],
        //     'PM'=>['number_of_examinees'=>0,'school_room_max_capacity'=>0]]
        // ];
        $count = 0;
        foreach ($populated_rooms as $key => $value) {
           
            if(count($room_slots)>0){
                $found = true;
                foreach ($room_slots as $room_key => $room_value) {
                    if($value->t_a_school_room_id == $room_value['t_a_school_room_id']){
                        $previous_room = $room_value;
                        $ampm = $value->ampm;
                        if(($previous_room[$previous_room['t_a_school_room_id']][$ampm]['number_of_examinees'] + 1) <= $previous_room['school_room_max_capacity']){
                            $room_slots[$room_key][$room_slots[$room_key]['t_a_school_room_id']][$ampm]['number_of_examinees'] = $previous_room[$previous_room['t_a_school_room_id']][$ampm]['number_of_examinees'] + 1;
                        }else{
                            dd('error');
                        }
                        $found = false;
                        break;
                    }
                }
                if($found){
                    $count++;
                    if($value->ampm == 'AM'){
                        array_push($room_slots,[$value->t_a_school_room_id=>[
                            'AM'=>['number_of_examinees'=>1],
                            'PM'=>['number_of_examinees'=>0]],
                            'test_schedule_id'=>$value->test_schedule_id,
                            'test_center_id'=>$value->test_center_id,
                            't_a_school_room_id'=>$value->t_a_school_room_id,
                            'school_room_max_capacity'=>$value->school_room_max_capacity,
                        ]);
                    }else{
                        array_push($room_slots,[$value->t_a_school_room_id=>[
                            'AM'=>['number_of_examinees'=>0],
                            'PM'=>['number_of_examinees'=>1]],
                            'test_schedule_id'=>$value->test_schedule_id,
                            'test_center_id'=>$value->test_center_id,
                            't_a_school_room_id'=>$value->t_a_school_room_id,
                            'school_room_max_capacity'=>$value->school_room_max_capacity,
                        ]);
                    }
                }
            }else{
                if($value->ampm == 'AM'){
                    array_push($room_slots,[$value->t_a_school_room_id=>[
                        'AM'=>['number_of_examinees'=>1],
                        'PM'=>['number_of_examinees'=>0]],
                        'test_schedule_id'=>$value->test_schedule_id,
                        'test_center_id'=>$value->test_center_id,
                        't_a_school_room_id'=>$value->t_a_school_room_id,
                        'school_room_max_capacity'=>$value->school_room_max_capacity,
                    ]);
                }else{
                    array_push($room_slots,[$value->t_a_school_room_id=>[
                        'AM'=>['number_of_examinees'=>0],
                        'PM'=>['number_of_examinees'=>1]],
                        'test_schedule_id'=>$value->test_schedule_id,
                        'test_center_id'=>$value->test_center_id,
                        't_a_school_room_id'=>$value->t_a_school_room_id,
                        'school_room_max_capacity'=>$value->school_room_max_capacity,
                    ]);
                }
            }
        }
        return $room_slots;
    }
    public function check_slot($room_slots){
        foreach ($room_slots as $key => $value) {
            if(
                $value[$value['t_a_school_room_id']]['AM']['number_of_examinees'] < $value['school_room_max_capacity'] ||
                $value[$value['t_a_school_room_id']]['PM']['number_of_examinees'] < $value['school_room_max_capacity']
            ){
                return $value;
            }
        }
    }

    public function check_other_room($school_rooms,$room_slots){
        foreach ($school_rooms as $key => $value) {
            $valid = true;
            foreach ($room_slots as $room_slot_key => $room_slot_value) {
                if($value->school_room_id == $room_slot_value['t_a_school_room_id']){
                    if($room_slot_value[$room_slot_value['t_a_school_room_id']]['AM']['number_of_examinees'] ==$room_slot_value['school_room_max_capacity']){
                        $valid = false;
                        break;
                    }
                    if($room_slot_value[$room_slot_value['t_a_school_room_id']]['PM']['number_of_examinees'] == $room_slot_value['school_room_max_capacity']){
                        $valid = false;
                        break;
                    }
                }
            }
            if($valid){
                return $value;
            }
        }
    }

    public function accepted_pending(){
        $valid = false;
        foreach ($this->pending_applicant_data  as $key => $value) {
            if($this->pending_selected[$key][$value->t_a_id]){
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
            $date_now = (date('Y/m/d'));
            $date_now_time_stamp = strtotime($date_now);

            $this->test_schedule_data = DB::table('test_schedules as ts')
                ->select(
                    'ts.id as ts_id',
                    "test_date",
                    "test_center_id",
                    "ts.cet_type_id",
                    "am_start",
                    "am_end",
                    "pm_start",
                    "pm_end",
                    'ts.isactive as ts_isactive',
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
            $test_center_id = 29;
            foreach ($this->pending_applicant_data  as $key => $value) {
                 // note that they can only accept students if the previous exam is done/ closed
                if($this->pending_selected[$key][$value->t_a_id]){
                    $insert = true;
                    $schedule = self::get_schedule($this->test_schedule_data,$date_now,$test_center_id);
                    while($insert){
                        
                        $schedule = self::get_schedule($this->test_schedule_data,$date_now,$test_center_id);
                        $test_schedule_id = $schedule->ts_id;
                        // count rooms per schedule;
                        $total_examinees;
                        $school_rooms = self::get_school_rooms();

                        $populated_rooms = self::get_populated_rooms($test_schedule_id ,$test_center_id);
            
                        if($populated_rooms){
                            $room_slots = self::tally_rooms($populated_rooms);
                            $room = self::check_slot($room_slots);
                            if($room){
                                if($room[$room['t_a_school_room_id']]['AM']['number_of_examinees'] < $room['school_room_max_capacity']){
                                    $ampm = 'AM';
                                    
                                }elseif($room[$room['t_a_school_room_id']]['PM']['number_of_examinees'] < $room['school_room_max_capacity']){
                                    $ampm = 'PM';
                                }
                                $school_room_id = $room['t_a_school_room_id'];
                                $test_schedule_id = $room['test_schedule_id'];
                                if ($ampm || $test_schedule_id || $school_room_id){
                                    // update here
                                    $test_application_details = DB::table('test_applications as ta')
                                    ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
                                    ->where(['t_a_id'=> $value->t_a_id,
                                    't_a_isactive'=>1,
                                    'ts.test_status_details'=>'Pending'])
                                    ->get()
                                    ->first();
                                    DB::table('notifications')
                                    ->insert([
                                        'notification_id' =>NULL ,
                                        'notification_user_target' => $test_application_details->t_a_applicant_user_id ,
                                        'notification_user_creator' => $this->user_details['user_id'],
                                        'notification_icon_id' => 9 ,
                                        'notification_title' => ' Application Accepted!' ,
                                        'notification_content'  => 'Your application is accepted, please prepare for your exam and goodluck!' ,
                                        'notification_link' => '/student/status'
                                    ]);

                                    DB::table('test_applications as ta')
                                    ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
                                    ->where(['t_a_id'=> $value->t_a_id,
                                            't_a_isactive'=>1,
                                            'ts.test_status_details'=>'Pending'])
                                    ->update([
                                            't_a_test_status_id' =>((array) DB::table('test_status')
                                                ->where('test_status_details', '=', 'Accepted')
                                            ->select('test_status_id as t_a_test_status_id')
                                            ->first())['t_a_test_status_id'],
                                            't_a_accepted_by'=> $this->user_details['user_id'],
                                            
                                            't_a_ampm' =>$ampm,
                                            't_a_test_schedule_id'  =>$test_schedule_id,
                                            't_a_school_room_id'  => $school_room_id,
                                    ]);
                
                                    $insert = false;
                                    if($this->mail){
                                        if(strlen($value->user_email)>0 && $value->user_email_verified ==1){
                                            $this->status = 'Processing';
                                            $this->reason = NULL;
                                            $this->link = ($_SERVER['SERVER_PORT'] == 80?'http://':'https://'). $_SERVER['SERVER_NAME'] .'/'.'student/status';
                                            $this->email = $value->user_email;
                                            Mail::send('mail.application-status-email', [
                                                'status'=>$this->status,
                                                'reason'=>$this->reason,
                                                'link'=>$this->link,
                                                'email'=>$this->email], 
                                                function($message) {
                                            $message->to($this->email, $this->email)->subject
                                                ('Test Application Processing');
                                            $message->from('xyz@gmail.com','WMSU TESTING AND EVALUATION CENTER');
                                            });
                                        }
                                    }
                                }
                            }else{
                                // check other rooms
                                $school_room = self::check_other_room($school_rooms,$room_slots);
                                if($school_room){
                                    $ampm = 'AM';
                                    $school_room_id = $school_room->school_room_id;
                                    if ($ampm || $test_schedule_id || $school_room_id){
                                        // update here
                                        $test_application_details = DB::table('test_applications as ta')
                                        ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
                                        ->where(['t_a_id'=> $value->t_a_id,
                                        't_a_isactive'=>1,
                                        'ts.test_status_details'=>'Pending'])
                                        ->get()
                                        ->first();
                                        DB::table('notifications')
                                        ->insert([
                                            'notification_id' =>NULL ,
                                            'notification_user_target' => $test_application_details->t_a_applicant_user_id ,
                                            'notification_user_creator' => $this->user_details['user_id'],
                                            'notification_icon_id' => 9 ,
                                            'notification_title' => ' Application Accepted!' ,
                                            'notification_content'  => 'Your application is accepted, please prepare for your exam and goodluck!' ,
                                            'notification_link' => '/student/status'
                                        ]);
                                        DB::table('test_applications as ta')
                                        ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
                                        ->where(['t_a_id'=> $value->t_a_id,
                                                't_a_isactive'=>1,
                                                'ts.test_status_details'=>'Pending'])
                                        ->update([
                                                't_a_test_status_id' =>((array) DB::table('test_status')
                                                    ->where('test_status_details', '=', 'Accepted')
                                                ->select('test_status_id as t_a_test_status_id')
                                                ->first())['t_a_test_status_id'],
                                                't_a_accepted_by'=> $this->user_details['user_id'],
                                                
                                                't_a_ampm' =>$ampm,
                                                't_a_test_schedule_id'  =>$test_schedule_id,
                                                't_a_school_room_id'  => $school_room_id,
                                        ]);
                                        $insert = false;
                    
                                        if($this->mail){
                                            if(strlen($value->user_email)>0 && $value->user_email_verified ==1){
                                                $this->status = 'Processing';
                                                $this->reason = NULL;
                                                $this->link = ($_SERVER['SERVER_PORT'] == 80?'http://':'https://'). $_SERVER['SERVER_NAME'] .'/'.'student/status';
                                                $this->email = $value->user_email;
                                                Mail::send('mail.application-status-email', [
                                                    'status'=>$this->status,
                                                    'reason'=>$this->reason,
                                                    'link'=>$this->link,
                                                    'email'=>$this->email], 
                                                    function($message) {
                                                $message->to($this->email, $this->email)->subject
                                                    ('Test Application Processing');
                                                $message->from('xyz@gmail.com','WMSU TESTING AND EVALUATION CENTER');
                                                });
                                            }
                                        }
                                    }
                                }
                                
                            }
                        
                        }else{
                            $school_room = self::get_available_room($school_rooms,$test_center_id);
                            $ampm = 'AM';
                            
                            $school_room_id = $school_room->school_room_id;
                            if ($ampm || $test_schedule_id || $school_room_id){
                                // update here
                                $test_application_details = DB::table('test_applications as ta')
                                    ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
                                    ->where(['t_a_id'=> $value->t_a_id,
                                    't_a_isactive'=>1,
                                    'ts.test_status_details'=>'Pending'])
                                    ->get()
                                    ->first();
                                    DB::table('notifications')
                                    ->insert([
                                        'notification_id' =>NULL ,
                                        'notification_user_target' => $test_application_details->t_a_applicant_user_id ,
                                        'notification_user_creator' => $this->user_details['user_id'],
                                        'notification_icon_id' => 9 ,
                                        'notification_title' => ' Application Accepted!' ,
                                        'notification_content'  => 'Your application is accepted, please prepare for your exam and goodluck!' ,
                                        'notification_link' => '/student/status'
                                    ]);

                                DB::table('test_applications as ta')
                                ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
                                ->where(['t_a_id'=> $value->t_a_id,
                                        't_a_isactive'=>1,
                                        'ts.test_status_details'=>'Pending'])
                                ->update([
                                        't_a_test_status_id' =>((array) DB::table('test_status')
                                            ->where('test_status_details', '=', 'Accepted')
                                        ->select('test_status_id as t_a_test_status_id')
                                        ->first())['t_a_test_status_id'],
                                        't_a_accepted_by'=> $this->user_details['user_id'],
                                        
                                        't_a_ampm' =>$ampm,
                                        't_a_test_schedule_id'  =>$test_schedule_id,
                                        't_a_school_room_id'  => $school_room_id,
                                ]);
                                $insert = false;
            
                                if($this->mail){
                                    if(strlen($value->user_email)>0 && $value->user_email_verified ==1){
                                        $this->status = 'Processing';
                                        $this->reason = NULL;
                                        $this->link = ($_SERVER['SERVER_PORT'] == 80?'http://':'https://'). $_SERVER['SERVER_NAME'] .'/'.'student/status';
                                        $this->email = $value->user_email;
                                        Mail::send('mail.application-status-email', [
                                            'status'=>$this->status,
                                            'reason'=>$this->reason,
                                            'link'=>$this->link,
                                            'email'=>$this->email], 
                                            function($message) {
                                        $message->to($this->email, $this->email)->subject
                                            ('Test Application Processing');
                                        $message->from('xyz@gmail.com','WMSU TESTING AND EVALUATION CENTER');
                                        });
                                    }
                                }
                            }
                        }   
                        if($insert){
                            $date_now = ($schedule->test_date);        
                        }
                        
                    }
                }
               
            }
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'success',
                'title'             									=> 'Applicants seleted is now Accepted!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }else{
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Please select applicant!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
             ]);
        }

        if($this->pending_test_type_id == 0){
            $this->pending_applicant_data = DB::table('test_applications as ta')
            ->select(
                // '*',
                'school_year_details',
                't_a_id',
                'user_email',
                'user_id',
                'user_email_verified',
                DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                'test_type_name',
                DB::raw('DATE(ta.date_created) as date_applied')
                )
            ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
            ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
            ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
            ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
            ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
            ->where('t_a_isactive','=',1)
            ->where('ts.test_status_details','=','Pending')
            ->orderBy($this->column_order, 'asc')
            ->get()
            ->toArray();
        }else{
            $this->pending_applicant_data = DB::table('test_applications as ta')
            ->select(
                // '*',
                'school_year_details',
                't_a_id',
                'user_email',
                'user_id',
                'user_email_verified',
                DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                'test_type_name',
                DB::raw('DATE(ta.date_created) as date_applied')
                )
            ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
            ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
            ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
            ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
            ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
            ->where('t_a_isactive','=',1)
            ->where('test_status_details','=','Pending')
            ->where('t_a_test_type_id','=',$this->pending_test_type_id)
            ->orderBy($this->column_order, 'asc')
            ->get()
            ->toArray();
        }
        $this->pending_selected = [];
        foreach ($this->pending_applicant_data  as $key => $value) {
            array_push($this->pending_selected,[$value->t_a_id=>false]);
        }
  
    }
    public function declined_check(){

        $this->declined_pending_valid = false;
        foreach ($this->pending_applicant_data  as $key => $value) {
            if($this->pending_selected[$key][$value->t_a_id]){
                $this->declined_pending_valid = true;
                break;
            }
        }

        if(!$this->declined_pending_valid){
            $this->dispatchBrowserEvent('swal:remove_backdrop',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Please select applicant!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }
    }

    public function declined_check_accepted(){

        $this->declined_accepted_valid = false;
        foreach ($this->accepted_applicant_data  as $key => $value) {
            if($this->accepted_selected[$key][$value->t_a_id]){
                $this->declined_accepted_valid = true;
                break;
            }
        }
        if(!$this->declined_accepted_valid){
            $this->dispatchBrowserEvent('swal:remove_backdrop',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Please select applicant!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
             ]);
        }
    }

    public function decline_accepted(){

        $this->declined_accepted_valid = false;
        foreach ($this->accepted_applicant_data  as $key => $value) {
            if($this->accepted_selected[$key][$value->t_a_id]){
                $this->declined_accepted_valid = true;
            }
        }

        if($this->declined_accepted_valid &&  $this->access_role['U'] ){
            foreach ($this->accepted_applicant_data  as $key => $value) {
                if($this->accepted_selected[$key][$value->t_a_id]){
                    // update here
                    $test_application_details = DB::table('test_applications as ta')
                    ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
                    ->where(['t_a_id'=> $value->t_a_id,
                    't_a_isactive'=>1,
                    'ts.test_status_details'=>'Accepted'])
                    ->get()
                    ->first();

                    DB::table('notifications')
                    ->insert([
                        'notification_id' =>NULL ,
                        'notification_user_target' => $test_application_details->t_a_applicant_user_id ,
                        'notification_user_creator' => $this->user_details['user_id'],
                        'notification_icon_id' => 8 ,
                        'notification_title' => ' Application declined!' ,
                        'notification_content'  => 'Your application is declined, because '.$this->declined_accepted_reason.' !' ,
                        'notification_link' => '/student/status'
                    ]);

                    DB::table('test_applications as ta')
                    ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
                    ->where(['t_a_id'=> $value->t_a_id,
                            't_a_isactive'=>1,
                            'ts.test_status_details'=>'Accepted'])
                    ->update([
                            't_a_isactive'=>0,
                            't_a_declined_by'=> $this->user_details['user_id'],
                            't_a_declined_reason' => $this->declined_accepted_reason,
                            't_a_test_status_id' =>((array) DB::table('test_status')
                                ->where('test_status_details', '=', 'Declined')
                            ->select('test_status_id as t_a_test_status_id')
                            ->first())['t_a_test_status_id']
                            
                    ]);

                    if($this->mail){
                        if(strlen($value->user_email)>0 && $value->user_email_verified ==1){
                            $this->status = 'Declined';
                            $this->reason = $this->declined_accepted_reason;
                            $this->link = ($_SERVER['SERVER_PORT'] == 80?'http://':'https://'). $_SERVER['SERVER_NAME'] .'/'.'student/status';
                            $this->email = $value->user_email;
                            Mail::send('mail.application-status-email', [
                                'status'=>$this->status,
                                'reason'=>$this->reason,
                                'link'=>$this->link,
                                'email'=>$this->email], 
                                function($message) {
                            $message->to($this->email, $this->email)->subject
                               ('Test Application '.$this->status);
                            $message->from('xyz@gmail.com','WMSU TESTING AND EVALUATION CENTER');
                         });
                        }
                    }
                }
            }
            $this->dispatchBrowserEvent('swal:remove_backdrop',[
                'position'          									=> 'center',
                'icon'              									=> 'success',
                'title'             									=> 'Applicants seleted is now declined!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }else{
            $this->dispatchBrowserEvent('swal:remove_backdrop',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Please select applicant!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
             ]);
        }
        if($this->accepted_test_type_id == 0){
            $this->accepted_applicant_data = DB::table('test_applications as ta')
            ->select(
                // '*',
                'school_year_details',
                't_a_id',
                'user_email',
                'user_id',
                'user_email_verified',
                DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                'test_type_name',
                DB::raw('DATE(ta.date_created) as date_applied')
                )
            ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
            ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
            ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
            ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
            ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
            ->where('t_a_isactive','=',1)
            ->where('ts.test_status_details','=','Processing')
            ->orderBy($this->column_order, 'asc')
            ->get()
            ->toArray();
        }else{
            $this->accepted_applicant_data = DB::table('test_applications as ta')
            ->select(
                // '*',
                'school_year_details',
                't_a_id',
                'user_email',
                'user_id',
                'user_email_verified',
                DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                'test_type_name',
                DB::raw('DATE(ta.date_created) as date_applied')
                )
            ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
            ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
            ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
            ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
            ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
            ->where('t_a_isactive','=',1)
            ->where('test_status_details','=','Processing')
            ->where('t_a_test_type_id','=',$this->accepted_test_type_id)
            ->orderBy($this->column_order, 'asc')
            ->get()
            ->toArray();
        }

        $this->accepted_selected = [];

        foreach ($this->accepted_applicant_data  as $key => $value) {
            array_push($this->accepted_selected,[$value->t_a_id=>false]);
        }
        $this->declined_accepted_reason = null;
    }

    public function decline(){

        $this->declined_valid = false;
        foreach ($this->pending_applicant_data  as $key => $value) {
            if($this->pending_selected[$key][$value->t_a_id]){
                $this->declined_valid = true;
            }
        }

        if($this->declined_valid &&  $this->access_role['U'] ){
            foreach ($this->pending_applicant_data  as $key => $value) {
                if($this->pending_selected[$key][$value->t_a_id]){
                    // update here

                    $test_application_details = DB::table('test_applications as ta')
                    ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
                    ->where(['t_a_id'=> $value->t_a_id,
                    't_a_isactive'=>1,
                    'ts.test_status_details'=>'Pending'])
                    ->get()
                    ->first();

                    DB::table('notifications')
                    ->insert([
                        'notification_id' =>NULL ,
                        'notification_user_target' => $test_application_details->t_a_applicant_user_id ,
                        'notification_user_creator' => $this->user_details['user_id'],
                        'notification_icon_id' => 8 ,
                        'notification_title' => ' Application declined!' ,
                        'notification_content'  => 'Your application is declined, because '.$this->declined_pending_reason.' !' ,
                        'notification_link' => '/student/status'
                    ]);

                    DB::table('test_applications as ta')
                    ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
                    ->where(['t_a_id'=> $value->t_a_id,
                            't_a_isactive'=>1,
                            'ts.test_status_details'=>'Pending'])
                    ->update([
                            't_a_isactive'=>0,
                            't_a_declined_by'=> $this->user_details['user_id'],
                            't_a_declined_reason' => $this->declined_pending_reason,
                            't_a_test_status_id' =>((array) DB::table('test_status')
                                ->where('test_status_details', '=', 'Declined')
                            ->select('test_status_id as t_a_test_status_id')
                            ->first())['t_a_test_status_id']
                    ]);

                    if($this->mail){
                        if(strlen($value->user_email)>0 && $value->user_email_verified ==1){
                            $this->status = 'Declined';
                            $this->reason = $this->declined_pending_reason;
                            $this->link = ($_SERVER['SERVER_PORT'] == 80?'http://':'https://'). $_SERVER['SERVER_NAME'] .'/'.'student/status';
                            $this->email = $value->user_email;
                            Mail::send('mail.application-status-email', [
                                'status'=>$this->status,
                                'reason'=>$this->reason,
                                'link'=>$this->link,
                                'email'=>$this->email], 
                                function($message) {
                            $message->to($this->email, $this->email)->subject
                               ('Test Application '.$this->status);
                            $message->from('xyz@gmail.com','WMSU TESTING AND EVALUATION CENTER');
                         });
                        }
                    }

                }
            }
            $this->dispatchBrowserEvent('swal:remove_backdrop',[
                'position'          									=> 'center',
                'icon'              									=> 'success',
                'title'             									=> 'Applicants seleted is now declined!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }else{
            $this->dispatchBrowserEvent('swal:remove_backdrop',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Please select applicant!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
             ]);
        }
        if($this->pending_test_type_id == 0){
            $this->pending_applicant_data = DB::table('test_applications as ta')
            ->select(
                // '*',
                'school_year_details',
                't_a_id',
                'user_email',
                'user_id',
                'user_email_verified',
                DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                'test_type_name',
                DB::raw('DATE(ta.date_created) as date_applied')
                )
            ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
            ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
            ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
            ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
            ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
            ->where('t_a_isactive','=',1)
            ->where('ts.test_status_details','=','Pending')
            ->orderBy($this->column_order, 'asc')
            ->get()
            ->toArray();
        }else{
            $this->pending_applicant_data = DB::table('test_applications as ta')
            ->select(
                // '*',
                'school_year_details',
                't_a_id',
                'user_email',
                'user_id',
                'user_email_verified',
                DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                'test_type_name',
                DB::raw('DATE(ta.date_created) as date_applied')
                )
            ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
            ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
            ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
            ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
            ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
            ->where('t_a_isactive','=',1)
            ->where('test_status_details','=','Pending')
            ->where('t_a_test_type_id','=',$this->pending_test_type_id)
            ->orderBy($this->column_order, 'asc')
            ->get()
            ->toArray();
        }

        $this->pending_selected = [];

        foreach ($this->pending_applicant_data  as $key => $value) {
            array_push($this->pending_selected,[$value->t_a_id=>false]);
        }
        $this->declined_pending_reason = null;
    }

    public function accepted_return_check(){
        $this->return_valid = false;
        foreach ($this->accepted_applicant_data  as $key => $value) {
            if($this->accepted_selected[$key][$value->t_a_id]){
                $this->return_valid = true;
                break;
            }
        }

        if(!$this->return_valid){
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Please select applicant!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
             ]);
        }
    }

    public function accepted_return(){
        $this->return_valid = false;
        foreach ($this->accepted_applicant_data  as $key => $value) {
            if($this->accepted_selected[$key][$value->t_a_id]){
                $this->return_valid = true;
                break;
            }
        }

        // accessrole read
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($this->return_valid &&  $this->access_role['U'] ){
            foreach ($this->accepted_applicant_data  as $key => $value) {
                if($this->accepted_selected[$key][$value->t_a_id]){
                    // update here
                    $test_application_details = DB::table('test_applications as ta')
                    ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
                    ->where(['t_a_id'=> $value->t_a_id,
                    't_a_isactive'=>1,
                    'ts.test_status_details'=>'Accepted'])
                    ->get()
                    ->first();

                    DB::table('notifications')
                    ->insert([
                        'notification_id' =>NULL ,
                        'notification_user_target' => $test_application_details->t_a_applicant_user_id ,
                        'notification_user_creator' => $this->user_details['user_id'],
                        'notification_icon_id' => 8 ,
                        'notification_title' => ' Application returned!' ,
                        'notification_content'  => 'Your application is returned, because '.$this->return_reason.' !' ,
                        'notification_link' => '/student/status'
                    ]);
                    DB::table('test_applications as ta')
                    ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
                    ->where(['t_a_id'=> $value->t_a_id,
                            't_a_isactive'=>1,
                            'ts.test_status_details'=>'Accepted'])
                    ->update([
                            't_a_returned_by'=> $this->user_details['user_id'],
                            't_a_returned_reason' => $this->return_reason,
                            't_a_test_status_id' =>((array) DB::table('test_status')
                                ->where('test_status_details', '=', 'Pending')
                            ->select('test_status_id as t_a_test_status_id')
                            ->first())['t_a_test_status_id']
                    ]);

                   

                    if($this->mail){
                        if(strlen($value->user_email)>0 && $value->user_email_verified ==1){
                            $this->status = 'Pending';
                            $this->reason = $this->return_reason;
                            $this->link = ($_SERVER['SERVER_PORT'] == 80?'http://':'https://'). $_SERVER['SERVER_NAME'] .'/'.'student/status';
                            $this->email = $value->user_email;
                            Mail::send('mail.application-status-email', [
                                'status'=>$this->status,
                                'reason'=>$this->reason,
                                'link'=>$this->link,
                                'email'=>$this->email], 
                                function($message) {
                            $message->to($this->email, $this->email)->subject
                               ('Test Application '.$this->status);
                            $message->from('xyz@gmail.com','WMSU TESTING AND EVALUATION CENTER');
                         });
                        }
                    }


                }
            }
            $this->dispatchBrowserEvent('swal:remove_backdrop',[
                'position'          									=> 'center',
                'icon'              									=> 'success',
                'title'             									=> 'Applicants seleted is now back to pending!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }else{
            $this->dispatchBrowserEvent('swal:remove_backdrop',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Please select applicant!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
             ]);
        }

        if($this->pending_test_type_id == 0){
            $this->pending_applicant_data = DB::table('test_applications as ta')
            ->select(
                // '*',
                'school_year_details',
                't_a_id',
                'user_email',
                'user_id',
                'user_email_verified',
                DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                'test_type_name',
                DB::raw('DATE(ta.date_created) as date_applied')
                )
            ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
            ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
            ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
            ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
            ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
            ->where('t_a_isactive','=',1)
            ->where('ts.test_status_details','=','Pending')
            ->orderBy($this->column_order, 'asc')
            ->get()
            ->toArray();
        }else{
            $this->pending_applicant_data = DB::table('test_applications as ta')
            ->select(
                // '*',
                'school_year_details',
                't_a_id',
                'user_email',
                'user_id',
                'user_email_verified',
                DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                'test_type_name',
                DB::raw('DATE(ta.date_created) as date_applied')
                )
            ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
            ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
            ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
            ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
            ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
            ->where('t_a_isactive','=',1)
            ->where('test_status_details','=','Pending')
            ->where('t_a_test_type_id','=',$this->pending_test_type_id)
            ->orderBy($this->column_order, 'asc')
            ->get()
            ->toArray();
        }

        if($this->accepted_test_type_id == 0){
            $this->accepted_applicant_data = DB::table('test_applications as ta')
            ->select(
                // '*',
                'school_year_details',
                't_a_id',
                'user_email',
                'user_id',
                'user_email_verified',
                DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                'test_type_name',
                DB::raw('DATE(ta.date_created) as date_applied')
                )
            ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
            ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
            ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
            ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
            ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
            ->where('t_a_isactive','=',1)
            ->where('ts.test_status_details','=','Processing')
            ->orderBy($this->column_order, 'asc')
            ->get()
            ->toArray();
        }else{
            $this->accepted_applicant_data = DB::table('test_applications as ta')
            ->select(
                // '*',
                'school_year_details',
                't_a_id',
                'user_email',
                'user_id',
                'user_email_verified',
                DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                'test_type_name',
                DB::raw('DATE(ta.date_created) as date_applied')
                )
            ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
            ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
            ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
            ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
            ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
            ->where('t_a_isactive','=',1)
            ->where('test_status_details','=','Processing')
            ->where('t_a_test_type_id','=',$this->accepted_test_type_id)
            ->orderBy($this->column_order, 'asc')
            ->get()
            ->toArray();
        }

        if($this->declined_test_type_id == 0){
            $this->declined_applicant_data = DB::table('test_applications as ta')
            ->select(
                // '*',
                'school_year_details',
                't_a_id',
                'user_email',
                'user_id',
                'user_email_verified',
                DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                'test_type_name',
                DB::raw('DATE(ta.date_created) as date_applied'),
                't_a_declined_reason'
                )
            ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
            ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
            ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
            ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
            ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
            ->where('t_a_isactive','=',1)
            ->where('ts.test_status_details','=','Declined')
            ->orderBy($this->column_order, 'asc')
            ->get()
            ->toArray();
        }else{
            $this->declined_applicant_data = DB::table('test_applications as ta')
            ->select(
                // '*',
                'school_year_details',
                't_a_id',
                'user_email',
                'user_id',
                'user_email_verified',
                DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                'test_type_name',
                DB::raw('DATE(ta.date_created) as date_applied'),
                't_a_declined_reason'
                )
            ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
            ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
            ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
            ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
            ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
            ->where('t_a_isactive','=',1)
            ->where('test_status_details','=','Declined')
            ->where('t_a_test_type_id','=',$this->declined_test_type_id)
            ->orderBy($this->column_order, 'asc')
            ->get()
            ->toArray();
        }

        $this->accepted_selected = [];
        $this->pending_selected = [];
        $this->declined_selected = [];

        foreach ($this->accepted_applicant_data  as $key => $value) {
            array_push($this->accepted_selected,[$value->t_a_id=>false]);
        }

        foreach ($this->pending_applicant_data  as $key => $value) {
            array_push($this->pending_selected,[$value->t_a_id=>false]);
        }

        foreach ($this->declined_applicant_data  as $key => $value) {
            array_push($this->declined_selected,[$value->t_a_id=>false]);
        }
    }
    
    public function search_accepted_applicant(){
        // last

        if($this->accepted_test_type_id == 0){
            $this->accepted_applicant_data = DB::table('test_applications as ta')
            ->select(
                // '*',
                'school_year_details',
                't_a_id',
                'user_email',
                'user_id',
                'user_email_verified',
                DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                'test_type_name',
                DB::raw('DATE(ta.date_created) as date_applied')
                )
            ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
            ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
            ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
            ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
            ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
            ->where('t_a_isactive','=',1)
            ->where('ts.test_status_details','=','Accepted')
            ->where('u.user_lastname','LIKE',($this->accepted_search.'%'))
            ->orderBy($this->column_order, 'asc')
            ->get()
            ->toArray();
        }else{
            $this->accepted_applicant_data = DB::table('test_applications as ta')
            ->select(
                // '*',
                'school_year_details',
                't_a_id',
                'user_email',
                'user_id',
                'user_email_verified',
                DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                'test_type_name',
                DB::raw('DATE(ta.date_created) as date_applied')
                )
            ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
            ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
            ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
            ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
            ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
            ->where('t_a_isactive','=',1)
            ->where('test_status_details','=','Accepted')
            ->where('t_a_test_type_id','=',$this->accepted_test_type_id)
            ->where('u.user_lastname','LIKE',($this->accepted_search.'%'))
            ->orderBy($this->column_order, 'asc')
            ->get()
            ->toArray();
        }
    }
    public function search_pending_applicant(){
        // last

        if($this->pending_test_type_id == 0){
            $this->pending_applicant_data = DB::table('test_applications as ta')
            ->select(
                // '*',
                'school_year_details',
                't_a_id',
                'user_email',
                'user_id',
                'user_email_verified',
                DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                'test_type_name',
                DB::raw('DATE(ta.date_created) as date_applied')
                )
            ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
            ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
            ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
            ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
            ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
            ->where('t_a_isactive','=',1)
            ->where('ts.test_status_details','=','Pending')
            ->where('u.user_lastname','LIKE',($this->pending_search.'%'))
            // ->where('u.user_firstname','LIKE',($this->pending_search.'%'))
            ->orderBy($this->column_order, 'asc')
            ->get()
            ->toArray();
        }else{
            $this->pending_applicant_data = DB::table('test_applications as ta')
            ->select(
                // '*',
                'school_year_details',
                't_a_id',
                'user_email',
                'user_id',
                'user_email_verified',
                DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                'test_type_name',
                DB::raw('DATE(ta.date_created) as date_applied')
                )
            ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
            ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
            ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
            ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
            ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
            ->where('t_a_isactive','=',1)
            ->where('test_status_details','=','Pending')
            ->where('t_a_test_type_id','=',$this->pending_test_type_id)
            ->where('u.user_lastname','LIKE',($this->pending_search.'%'))
            // ->where('u.user_firstname','LIKE',($this->pending_search.'%'))
            ->orderBy($this->column_order, 'asc')
            ->get()
            ->toArray();
        }
    }

    public function delete_check(){
        $this->delete_declined_valid = false;
        foreach ($this->declined_applicant_data  as $key => $value) {
            if($this->declined_selected[$key][$value->t_a_id]){
                $this->delete_declined_valid = true;
                break;
            }
        }

        if(!$this->delete_declined_valid){
            $this->dispatchBrowserEvent('swal:remove_backdrop',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Please select applicant!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
             ]);
        }
    }

    public function delete_declined(){
        $this->delete_declined_valid = false;
        foreach ($this->declined_applicant_data  as $key => $value) {
            if($this->declined_selected[$key][$value->t_a_id]){
                $this->delete_declined_valid = true;
                break;
            }
        }


        // accessrole read
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($this->delete_declined_valid &&  $this->access_role['U'] ){
            foreach ($this->declined_applicant_data  as $key => $value) {
                if($this->declined_selected[$key][$value->t_a_id]){
                    // update here
                    DB::table('test_applications as ta')
                    ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
                    ->where(['t_a_id'=> $value->t_a_id,
                            't_a_isactive'=>1,
                            'ts.test_status_details'=>'Declined'])
                    ->delete(
                );

                // delete files  here
                }
            }
            $this->dispatchBrowserEvent('swal:remove_backdrop',[
                'position'          									=> 'center',
                'icon'              									=> 'success',
                'title'             									=> 'Applicants seleted is now deleted!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }else{
            $this->dispatchBrowserEvent('swal:remove_backdrop',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Please select applicant!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
             ]);
        }

        if($this->pending_test_type_id == 0){
            $this->pending_applicant_data = DB::table('test_applications as ta')
            ->select(
                // '*',
                'school_year_details',
                't_a_id',
                'user_email',
                'user_id',
                'user_email_verified',
                DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                'test_type_name',
                DB::raw('DATE(ta.date_created) as date_applied')
                )
            ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
            ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
            ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
            ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
            ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
            ->where('t_a_isactive','=',1)
            ->where('ts.test_status_details','=','Pending')
            ->orderBy($this->column_order, 'asc')
            ->get()
            ->toArray();
        }else{
            $this->pending_applicant_data = DB::table('test_applications as ta')
            ->select(
                // '*',
                'school_year_details',
                't_a_id',
                'user_email',
                'user_id',
                'user_email_verified',
                DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                'test_type_name',
                DB::raw('DATE(ta.date_created) as date_applied')
                )
            ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
            ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
            ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
            ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
            ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
            ->where('t_a_isactive','=',1)
            ->where('test_status_details','=','Pending')
            ->where('t_a_test_type_id','=',$this->pending_test_type_id)
            ->orderBy($this->column_order, 'asc')
            ->get()
            ->toArray();
        }

        if($this->accepted_test_type_id == 0){
            $this->accepted_applicant_data = DB::table('test_applications as ta')
            ->select(
                // '*',
                'school_year_details',
                't_a_id',
                'user_email',
                'user_id',
                'user_email_verified',
                DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                'test_type_name',
                DB::raw('DATE(ta.date_created) as date_applied')
                )
            ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
            ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
            ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
            ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
            ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
            ->where('t_a_isactive','=',1)
            ->where('ts.test_status_details','=','Processing')
            ->orderBy($this->column_order, 'asc')
            ->get()
            ->toArray();
        }else{
            $this->accepted_applicant_data = DB::table('test_applications as ta')
            ->select(
                // '*',
                'school_year_details',
                't_a_id',
                'user_email',
                'user_id',
                'user_email_verified',
                DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                'test_type_name',
                DB::raw('DATE(ta.date_created) as date_applied')
                )
            ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
            ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
            ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
            ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
            ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
            ->where('t_a_isactive','=',1)
            ->where('test_status_details','=','Processing')
            ->where('t_a_test_type_id','=',$this->accepted_test_type_id)
            ->orderBy($this->column_order, 'asc')
            ->get()
            ->toArray();
        }

        if($this->declined_test_type_id == 0){
            $this->declined_applicant_data = DB::table('test_applications as ta')
            ->select(
                // '*',
                'school_year_details',
                't_a_id',
                'user_email',
                'user_id',
                'user_email_verified',
                DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                'test_type_name',
                DB::raw('DATE(ta.date_created) as date_applied'),
                't_a_declined_reason'
                )
            ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
            ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
            ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
            ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
            ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
            ->where('t_a_isactive','=',1)
            ->where('ts.test_status_details','=','Declined')
            ->orderBy($this->column_order, 'asc')
            ->get()
            ->toArray();
        }else{
            $this->declined_applicant_data = DB::table('test_applications as ta')
            ->select(
                // '*',
                'school_year_details',
                't_a_id',
                'user_email',
                'user_id',
                'user_email_verified',
                DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                'test_type_name',
                DB::raw('DATE(ta.date_created) as date_applied'),
                't_a_declined_reason'
                )
            ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
            ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
            ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
            ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
            ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
            ->where('t_a_isactive','=',1)
            ->where('test_status_details','=','Declined')
            ->where('t_a_test_type_id','=',$this->declined_test_type_id)
            ->orderBy($this->column_order, 'asc')
            ->get()
            ->toArray();
        }

        $this->accepted_selected = [];
        $this->pending_selected = [];
        $this->declined_selected = [];

        foreach ($this->accepted_applicant_data  as $key => $value) {
            array_push($this->accepted_selected,[$value->t_a_id=>false]);
        }

        foreach ($this->pending_applicant_data  as $key => $value) {
            array_push($this->pending_selected,[$value->t_a_id=>false]);
        }

        foreach ($this->declined_applicant_data  as $key => $value) {
            array_push($this->declined_selected,[$value->t_a_id=>false]);
        }
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
        $this->dispatchBrowserEvent('openModal','view_application_modal');
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

    public function view_accepted_application($t_a_id){


        $this->application_view_details = DB::table('test_applications as ta')
            ->select('*',DB::raw('DATE(ta.date_created) as applied_date'))
            ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
            ->join('users as us', 'us.user_id', '=', 'ta.t_a_applicant_user_id')
            ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'ta.t_a_applicant_user_id')
            ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
            ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
            ->join('cet_types as ct', 'ct.cet_type_id', '=', 'ta.t_a_cet_type_id')
                    
            // ->where('t_a_test_status_id', '=', 
            //     ((array) DB::table('test_types')
            //         ->where('test_type_details', '=', 'College Entrance Test')
            //         ->select('test_type_id as t_a_test_type_id')
            //         ->first())['t_a_test_type_id'])
            
            ->where('t_a_isactive','=',1)
            ->where('t_a_id','=',$t_a_id )
            ->limit(1)
            ->get()
            ->toArray();
            // dd($this->application_view_details);


        
            $this->dispatchBrowserEvent('openModal','view_accepted_application_modal');
    }
    



    // pagination
    public function refesh_page(){
        $this->cursor = 0;
        $this->page_number = 1;
        $item_current = 0;

        

        if($this->pending_test_type_id == 0){
            $this->next_pages = DB::table('test_applications as ta')
            ->select(
                't_a_id'
                )
            ->where('t_a_isactive','=',1)
            ->where('t_a_id','>',$this->cursor)
            ->orderBy('ta.'.$this->column_order, 'asc')
            ->limit($this->per_page*3+1)
            ->get()
            ->toArray();
            $this->next_page_count = count($this->next_pages);


            $this->prev_pages = DB::table('test_applications as ta')
            ->select(
                't_a_id'
                )
            ->where('t_a_isactive','=',1)
            ->where('t_a_id','<=',$this->cursor)
            ->orderBy('ta.'.$this->column_order, 'asc')
            ->limit($this->per_page*3+1)
            ->get()
            ->toArray();
            $this->prev_page_count = count($this->prev_pages);
            $this->item_last = DB::table('test_applications as ta')
                ->select(
                    // '*',
                    't_a_id'
                    )
                ->where('t_a_isactive','=',1)
                ->orderBy('ta.'.$this->column_order, $this->order_by)
                ->first()->t_a_id;

            $this->pending_applicant_data = DB::table('test_applications as ta')
                ->select(
                    // '*',
                    't_a_id',
                    'user_email',
                    'user_id',
                    'user_email_verified',
                    DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                    'test_type_name',
                    DB::raw('DATE(ta.date_created) as date_applied')
                    )
                ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
                ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
                ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
                ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
                ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
                ->where('t_a_isactive','=',1)
                ->where('t_a_id','>',$this->cursor)
                ->orderBy('ta.'.$this->column_order, 'asc')
                ->limit($this->per_page)
                ->get()
                ->toArray();
                
        
        }else{
            $this->next_pages = DB::table('test_applications as ta')
            ->select(
                't_a_id'
                )
            ->where('t_a_isactive','=',1)
            ->where('t_a_id','>',$this->cursor)
            ->where('t_a_test_type_id','=',$this->pending_test_type_id)
            ->orderBy('ta.'.$this->column_order, 'asc')
            ->limit($this->per_page*3+1)
            ->get()
            ->toArray();
            $this->next_page_count = count($this->next_pages);


            $this->prev_pages = DB::table('test_applications as ta')
            ->select(
                't_a_id'
                )
            ->where('t_a_isactive','=',1)
            ->where('t_a_id','<=',$this->cursor)
            ->where('t_a_test_type_id','=',$this->pending_test_type_id)
            ->orderBy('ta.'.$this->column_order, 'asc')
            ->limit($this->per_page*3+1)
            ->get()
            ->toArray();
            $this->prev_page_count = count($this->prev_pages);

            $this->pending_applicant_data = DB::table('test_applications as ta')
                ->select(
                    // '*',
                    't_a_id',
                    DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                    'test_type_name',
                    DB::raw('DATE(ta.date_created) as date_applied')
                    )
                ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
                ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
                ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
                ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
                ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
                ->where('t_a_isactive','=',1)
                ->where('t_a_id','>',$this->cursor)
                ->where('t_a_test_type_id','=',$this->pending_test_type_id)
                ->orderBy('ta.'.$this->column_order, 'asc')
                ->limit($this->per_page)
                ->get()
                ->toArray();
                
        }
    }
    public function prev_page($cursor,$offset){
        $this->cursor = $cursor;
        $this->page_number = $this->page_number + $offset;

        if($this->pending_test_type_id == 0){
            $this->next_pages = DB::table('test_applications as ta')
                ->select(
                    // '*',
                    't_a_id'
                    )
                ->where('t_a_isactive','=',1)
                ->where('t_a_id','>=',$this->cursor)
                ->orderBy('ta.'.$this->column_order, 'asc')
                ->limit($this->per_page*3+1)
                ->get()
                ->toArray();
            $this->next_page_count = count($this->next_pages);

            $this->prev_pages = DB::table('test_applications as ta')
                ->select(
                    // '*',
                    't_a_id'
                    )
                ->where('t_a_isactive','=',1)
                ->where('t_a_id','<',$this->cursor)
                ->orderBy('ta.'.$this->column_order, 'desc')
                ->limit($this->per_page*3+1)
                ->get()
                ->toArray();
                $this->prev_page_count = count($this->prev_pages);
                $this->item_current = $this->cursor ;
                // dd($this->prev_page_count);
                // dd($this->prev_pages);
                // dd($this->next_pages);

            $this->pending_applicant_data = DB::table('test_applications as ta')
                ->select(
                    // '*',
                    't_a_id',
                    DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                    'test_type_name',
                    DB::raw('DATE(ta.date_created) as date_applied')
                    )
                ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
                ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
                ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
                ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
                ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
                ->where('t_a_isactive','=',1)
                ->where('t_a_id','>=',$this->cursor)
                ->orderBy('ta.'.$this->column_order, 'asc')
                ->limit($this->per_page)
                ->get()
                ->toArray();
        }else{
            $this->next_pages = DB::table('test_applications as ta')
                ->select(
                    // '*',
                    't_a_id'
                    )
                ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
                ->where('t_a_isactive','=',1)
                ->where('t_a_id','>=',$this->cursor)
                ->where('t_a_test_type_id','=',$this->pending_test_type_id)
                ->orderBy('ta.'.$this->column_order, 'asc')
                ->limit($this->per_page*3+1)
                ->get()
                ->toArray();
            $this->next_page_count = count($this->next_pages);

            $this->prev_pages = DB::table('test_applications as ta')
                ->select(
                    // '*',
                    't_a_id'
                    )
                ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
                ->where('t_a_isactive','=',1)
                ->where('t_a_id','<',$this->cursor)
                ->where('t_a_test_type_id','=',$this->pending_test_type_id)
                ->orderBy('ta.'.$this->column_order, 'desc')
                ->limit($this->per_page*3+1)
                ->get()
                ->toArray();
            $this->prev_page_count = count($this->prev_pages);
            $this->item_current = $this->cursor ;
            $this->pending_applicant_data = DB::table('test_applications as ta')
                ->select(
                    // '*',
                    't_a_id',
                    DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                    'test_type_name',
                    DB::raw('DATE(ta.date_created) as date_applied')
                    )
                ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
                ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
                ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
                ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
                ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
                ->where('t_a_isactive','=',1)
                ->where('t_a_id','>=',$this->cursor)
                ->where('t_a_test_type_id','=',$this->pending_test_type_id)
                ->orderBy('ta.'.$this->column_order, 'asc')
                ->limit($this->per_page)
                ->get()
                ->toArray();
        }
    }
    public function next_page($cursor,$offset){
        {
            // dd($cursor);
            $this->cursor = $cursor;
            $this->page_number = $this->page_number + $offset;

            if($this->pending_test_type_id == 0){
                $this->next_pages = DB::table('test_applications as ta')
                ->select(
                    // '*',
                    't_a_id'
                    )
                ->where('t_a_isactive','=',1)
                ->where('t_a_id','>',$this->cursor)
                ->orderBy('ta.'.$this->column_order, 'asc')
                ->limit($this->per_page*3+1)
                ->get()
                ->toArray();
                $this->next_page_count = count($this->next_pages);
                


                $this->prev_pages = DB::table('test_applications as ta')
                ->select(
                    // '*',
                    't_a_id'
                    )
                ->where('t_a_isactive','=',1)
                ->where('t_a_id','<=',$this->cursor)
                ->orderBy('ta.'.$this->column_order, 'desc')
                ->limit($this->per_page*3+1)
                ->get()
                ->toArray();
                $this->prev_page_count = count($this->prev_pages);
                $this->item_current = $this->cursor ;
                
                $this->pending_applicant_data = DB::table('test_applications as ta')
                ->select(
                    // '*',
                    't_a_id',
                    DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                    'test_type_name',
                    DB::raw('DATE(ta.date_created) as date_applied')
                    )
                ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
                ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
                ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
                ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
                ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
                ->where('t_a_isactive','=',1)
                ->where('t_a_id','>',$this->cursor)
                ->orderBy('ta.'.$this->column_order, 'asc')
                ->limit($this->per_page)
                ->get()
                ->toArray();

            }else{
                $this->next_pages = DB::table('test_applications as ta')
                ->select(
                    // '*',
                    't_a_id'
                    )
                ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
                ->where('t_a_isactive','=',1)
                ->where('t_a_id','>',$this->cursor)
                ->where('t_a_test_type_id','=',$this->pending_test_type_id)
                ->orderBy('ta.'.$this->column_order, 'asc')
                ->limit($this->per_page*3+1)
                ->get()
                ->toArray();
                $this->next_page_count = count($this->next_pages);
                


                $this->prev_pages = DB::table('test_applications as ta')
                ->select(
                    // '*',
                    't_a_id'
                    )
                ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
                ->where('t_a_isactive','=',1)
                ->where('t_a_id','<=',$this->cursor)
                ->where('t_a_test_type_id','=',$this->pending_test_type_id)
                ->orderBy('ta.'.$this->column_order, 'desc')
                ->limit($this->per_page*3+1)
                ->get()
                ->toArray();
                $this->prev_page_count = count($this->prev_pages);
                $this->item_current = $this->cursor ;
                
                $this->pending_applicant_data = DB::table('test_applications as ta')
                ->select(
                    // '*',
                    't_a_id',
                    DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                    'test_type_name',
                    DB::raw('DATE(ta.date_created) as date_applied')
                    )
                ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
                ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
                ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
                ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
                ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
                ->where('t_a_isactive','=',1)
                ->where('t_a_id','>',$this->cursor)
                ->where('t_a_test_type_id','=',$this->pending_test_type_id)
                ->orderBy('ta.'.$this->column_order, 'asc')
                ->limit($this->per_page)
                ->get()
                ->toArray();
            }
        }
    }

    public function first_page(){
        {
            $this->cursor = 0;
            $this->page_number = 1;
            if($this->pending_test_type_id == 0){
                $this->next_pages = DB::table('test_applications as ta')
                ->select(
                    // '*',
                    't_a_id'
                    )
                ->where('t_a_isactive','=',1)
                ->where('t_a_id','>',$this->cursor)
                ->orderBy('ta.'.$this->column_order, 'asc')
                ->limit($this->per_page*3+1)
                ->get()
                ->toArray();
                $this->next_page_count = count($this->next_pages);
                $this->prev_pages = DB::table('test_applications as ta')
                ->select(
                    // '*',
                    't_a_id'
                    )
                ->where('t_a_isactive','=',1)
                ->where('t_a_id','<',$this->cursor)
                ->orderBy('ta.'.$this->column_order, 'asc')
                ->limit($this->per_page*3+1)
                ->get()
                ->toArray();
                $this->prev_page_count = count($this->prev_pages);
                $this->item_current = $this->cursor ;

                $this->pending_applicant_data = DB::table('test_applications as ta')
                ->select(
                    // '*',
                    't_a_id',
                    DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                    'test_type_name',
                    DB::raw('DATE(ta.date_created) as date_applied')
                    )
                ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
                ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
                ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
                ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
                ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
                ->where('t_a_isactive','=',1)
                ->orderBy('ta.'.$this->column_order, 'asc')
                ->limit($this->per_page)
                ->get()
                ->toArray();
            }else{
                $this->next_pages = DB::table('test_applications as ta')
                ->select(
                    // '*',
                    't_a_id'
                    )
                ->where('t_a_isactive','=',1)
                ->where('t_a_id','>',$this->cursor)
                ->where('t_a_test_type_id','=',$this->pending_test_type_id)
                ->orderBy('ta.'.$this->column_order, 'asc')
                ->limit($this->per_page*3+1)
                ->get()
                ->toArray();
                $this->next_page_count = count($this->next_pages);

                $this->prev_pages = DB::table('test_applications as ta')
                ->select(
                    // '*',
                    't_a_id'
                    )
                ->where('t_a_isactive','=',1)
                ->where('t_a_test_type_id','=',$this->pending_test_type_id)
                ->where('t_a_id','<',$this->cursor)
                ->orderBy('ta.'.$this->column_order, 'asc')
                ->limit($this->per_page*3+1)
                ->get()
                ->toArray();
                $this->prev_page_count = count($this->prev_pages);
                $this->item_current = $this->cursor ;

                $this->pending_applicant_data = DB::table('test_applications as ta')
                ->select(
                    // '*',
                    't_a_id',
                    DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                    'test_type_name',
                    DB::raw('DATE(ta.date_created) as date_applied')
                    )
                ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
                ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
                ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
                ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
                ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
                ->where('t_a_isactive','=',1)
                ->where('t_a_test_type_id','=',$this->pending_test_type_id)
                ->orderBy('ta.'.$this->column_order, 'desc')
                ->limit($this->per_page)
                ->get()
                ->toArray();
            }
        
        }
    }

    public function last_page(){
        if($this->pending_test_type_id == 0){
            $pages = DB::table('test_applications as ta')
            ->select(
                // '*',
                DB::raw('COUNT(ta.t_a_id) as t_a_id_count')
                )
            ->where('ta.t_a_isactive','=',1)
            ->get()
            ->toArray()[0]->t_a_id_count;
            
            $pages = $pages/$this->per_page;
            $this->cursor = intval($pages)*$this->per_page;
            if($pages > intval($pages)){
                $pages = intval($pages)+1;
            
            }
            $this->page_number= $pages;
            
            $this->next_page_count = 0;


            $this->prev_pages = DB::table('test_applications as ta')
                ->select(
                    // '*',
                    'ta.t_a_id'
                    )
                ->where('t_a_isactive','=',1)
                ->where('ta.t_a_id','<',$this->cursor)
                ->orderBy('ta.'.$this->column_order, 'desc')
                ->limit($this->per_page*3+1)
                ->get()
                ->toArray();
            $this->prev_page_count = count($this->prev_pages);
            $this->item_current = $this->cursor ;
                // dd($this->prev_pages);
                // dd($this->prev_page_count);
                // dd($this->prev_pages[0]->t_a_id);
                

            $this->pending_applicant_data = DB::table('test_applications as ta')
                ->select(
                    // '*',
                    'ta.t_a_id',
                    DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                    'test_type_name',
                    DB::raw('DATE(ta.date_created) as date_applied')
                    )
                ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
                ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
                ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
                ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
                ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
                ->where('ta.t_a_isactive','=',1)
                ->where('ta.t_a_id','>=',$this->prev_pages[0]->t_a_id)
                ->orderBy('ta.'.$this->column_order, 'desc')
                ->limit($this->per_page)
                ->get()
                ->toArray();
        }else{
            

            $pages = DB::table('test_applications as ta')
            ->select(
                // '*',
                DB::raw('COUNT(ta.t_a_id) as t_a_id_count')
                )
            ->where('ta.t_a_isactive','=',1)
            ->where('t_a_test_type_id','=',$this->pending_test_type_id)
            ->get()
            ->toArray()[0]->t_a_id_count;
            
            $pages = $pages/$this->per_page;
            $this->cursor = intval($pages)*$this->per_page;
            if($pages > intval($pages)){
                $pages = intval($pages)+1;
            
            }
            $this->page_number= $pages;
            
            $this->next_page_count = 0;


            $this->prev_pages = DB::table('test_applications as ta')
                ->select(
                    // '*',
                    'ta.t_a_id'
                    )
                ->where('t_a_isactive','=',1)
                ->where('ta.t_a_id','<',$this->cursor)
                ->where('t_a_test_type_id','=',$this->pending_test_type_id)
                ->orderBy('ta.'.$this->column_order, 'desc')
                ->limit($this->per_page*3+1)
                ->get()
                ->toArray();
            $this->prev_page_count = count($this->prev_pages);
            $this->item_current = $this->cursor ;
                // dd($this->prev_pages);
                // dd($this->prev_page_count);
                // dd($this->prev_pages[0]->t_a_id);
                

            $this->pending_applicant_data = DB::table('test_applications as ta')
                ->select(
                    // '*',
                    'ta.t_a_id',
                    DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
                    'test_type_name',
                    DB::raw('DATE(ta.date_created) as date_applied')
                    )
                ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
                ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
                ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
                ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
                ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
                ->where('ta.t_a_isactive','=',1)
                ->where('ta.t_a_id','>',$this->prev_pages[1]->t_a_id)
                ->where('t_a_test_type_id','=',$this->pending_test_type_id)
                ->orderBy('ta.'.$this->column_order, 'desc')
                ->limit($this->per_page)
                ->get()
                ->toArray();
        }

    }
}
