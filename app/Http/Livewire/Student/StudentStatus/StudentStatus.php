<?php

namespace App\Http\Livewire\Student\StudentStatus;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use chillerlan\QRCode\{QRCode, QROptions};

class StudentStatus extends Component
{
    public $user_detais;
    public $title;

    public $application_details;
    public $application_history;

    public $t_a_id;
    public $view_details;
    public $cancel_details;


    public $firstname;
    public $middlename;
    public $lastname;
    public $suffix;
    public $gender;
    public $sex;
    public $phone;
    public $address;
    public $birthdate;

    public $email;

    public $f_firstname;
    public $f_middlename;
    public $f_lastname;
    public $f_suffix;
    public $m_firstname;
    public $m_middlename;
    public $m_lastname;
    public $m_suffix;
    public $g_firstname;
    public $g_middlename;
    public $g_lastname;
    public $g_suffix;
    public $g_relationship;
    public $number_of_siblings;
    public $fb_address;

    public $ueb_id;
    public $ueb_shs_school_name;
    public $ueb_shs_address;

    public $t_a_formal_photo ;
    public $t_a_formal_photo_id;
    public $t_a_formal_photo_name;
    public $t_a_school_principal_certification_id;
    public $t_a_school_principal_certification;
    public $t_a_school_principal_certification_name;
    public $t_a_original_senior_high_school_card_id;
    public $t_a_original_senior_high_school_card;
    public $t_a_original_senior_high_school_card_name;
    public $t_a_transcript_of_records_id;
    public $t_a_transcript_of_records;
    public $t_a_transcript_of_records_name;
    public $t_a_endorsement_letter_from_wmsu_dean_id;
    public $t_a_endorsement_letter_from_wmsu_dean ;
    public $t_a_endorsement_letter_from_wmsu_dean_name ;

    public $qrcode;
    public $qr_code_link;
    public $scale_size = 20; 

    public $edit = false;

    public $page = 1;
    public $application =[
        't_a_id' => NULL,
        't_a_test_type_id' => NULL,
        't_a_applicant_user_id' => NULL,
        't_a_test_status_id' => NULL,
        't_a_user_details' => NULL,
        't_a_isactive' => NULL,

        't_a_school_school_name' => NULL,
        't_a_school_address' => NULL,

        't_a_formal_photo' => NULL,
        't_a_school_principal_certification' => NULL,
        't_a_original_senior_high_school_card' => NULL,
        't_a_transcript_of_records' => NULL,
        't_a_endorsement_letter_from_wmsu_dean' => NULL,
        't_a_receipt_photo' => NULL,

        // -- nat

        // -- eat 

        // -- etc

        // --
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

        't_a_hash' => NULL,

        't_a_cet_type_id' => NULL,

        't_a_cet_english_procficiency' => NULL,
        't_a_cet_reading_comprehension'  => NULL,
        't_a_cet_science_process_skills' => NULL,
        't_a_cet_quantitative_skills' => NULL,
        't_a_cet_abstract_thinking_skills' => NULL,
        't_a_cet_oapr' => NULL

    ];

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
        $this->view_permit = null;
        self::update_data();
    }

    public function update_data(){
        $this->cet_type_data = DB::table('cet_types')
            ->get()
            ->toArray();
        $this->application_details = DB::table('test_applications as ta')
            ->select('*',DB::raw('DATE(ta.date_created) as applied_date'))
            ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
            ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
            ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
            ->where('t_a_test_type_id', '=', 
                ((array) DB::table('test_types')
                    ->where('test_type_details', '=', 'College Entrance Test')
                    ->select('test_type_id as t_a_test_type_id')
                    ->first())['t_a_test_type_id'])
            
            ->where('t_a_applicant_user_id','=',$this->user_details['user_id'])
            ->where('t_a_isactive','=',1)
            ->get()
            ->toArray();

        $this->application_history = DB::select('SELECT *,DATE(ta.date_created) as applied_date FROM test_applications as ta 
            LEFT JOIN test_types as tt on tt.test_type_id = ta.t_a_test_type_id
            LEFT JOIN test_status as ts on ts.test_status_id = ta.t_a_test_status_id 
            LEFT JOIN school_years as sy on sy.school_year_id = ta.t_a_school_year_id 
            WHERE t_a_applicant_user_id = :user_id and (t_a_isactive = :t_a_isactive  or test_status_details = :test_status_complete or test_status_details = :test_status_cancelled ) 
            ORDER BY ta.date_created DESC
            ',['user_id'=>$this->user_details['user_id'],
                't_a_isactive'=>0,
                'test_status_complete' => 'Complete',
                'test_status_cancelled' => 'Cancelled'  
            ]
            
    );
    }
    public function update_application($t_a_id){
        if($application = DB::table('test_applications as ta')
        ->select('*',DB::raw('DATE(ta.date_created) as applied_date'))
        ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
        ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
        ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
        ->where('t_a_test_type_id', '=', 
            ((array) DB::table('test_types')
                ->where('test_type_details', '=', 'College Entrance Test')
                ->select('test_type_id as t_a_test_type_id')
                ->first())['t_a_test_type_id'])
        
        ->where('t_a_applicant_user_id','=',$this->user_details['user_id'])
        ->where('t_a_isactive','=',1)
        ->where('t_a_id','=',$t_a_id)
        ->first()){

            $this->application =[
                't_a_id' => $application->t_a_id,
                't_a_test_type_id' => $application->t_a_test_type_id,
                't_a_applicant_user_id' => $application->t_a_applicant_user_id,
                't_a_test_status_id' => $application->t_a_test_status_id,
                't_a_user_details' => $application->t_a_user_details,
                't_a_isactive' => $application->t_a_isactive,
        
                't_a_school_school_name' => $application->t_a_school_school_name,
                't_a_school_address' => $application->t_a_school_address,
        
                't_a_formal_photo' => $application->t_a_formal_photo,
                't_a_school_principal_certification' => $application->t_a_school_principal_certification,
                't_a_original_senior_high_school_card' => $application->t_a_original_senior_high_school_card,
                't_a_transcript_of_records' => $application->t_a_transcript_of_records,
                't_a_endorsement_letter_from_wmsu_dean' => $application->t_a_endorsement_letter_from_wmsu_dean,
                't_a_receipt_photo' => $application->t_a_receipt_photo,
        
                // -- nat
        
                // -- eat 
        
                // -- etc
        
                // --
                't_a_declined_reason' => $application->t_a_declined_reason,
                't_a_declined_by' => $application->t_a_declined_by, 
                't_a_accepted_by' => $application->t_a_accepted_by,  
                't_a_assigned_by' => $application->t_a_assigned_by,
                't_a_proctor_assigned_by' => $application->t_a_proctor_assigned_by,
                't_a_returned_by' => $application->t_a_returned_by,
                't_a_returned_reason' => $application->t_a_returned_reason,
                't_a_proctor_user_id' => $application->t_a_proctor_user_id,
                't_a_school_room_id' => $application->t_a_school_room_id,
        
                't_a_school_year_id' => $application->t_a_school_year_id,
        
                't_a_hash' => $application->t_a_hash,
        
                't_a_cet_type_id' => $application->t_a_cet_type_id,
        
                't_a_cet_english_procficiency' => $application->t_a_cet_english_procficiency,
                't_a_cet_reading_comprehension'  => $application->t_a_cet_reading_comprehension,
                't_a_cet_science_process_skills' => $application->t_a_cet_science_process_skills,
                't_a_cet_quantitative_skills' => $application->t_a_cet_quantitative_skills,
                't_a_cet_abstract_thinking_skills' => $application->t_a_cet_abstract_thinking_skills,
                't_a_cet_oapr' => $application->t_a_cet_oapr,
                'test_type_details' => $application->test_type_details,
                'applied_date' => $application->applied_date
            ];
        }
       
    }


    public function mount(Request $request){
        $this->user_details = $request->session()->all();
        $this->title = 'status';
       
        self::update_data();
        
        $user_details = $request->session()->all();
        $this->title = 'CET Application Form';

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
            ->where('user_id','=',$user_details['user_id'])
            ->first();
        $this->user_details = [
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

    }
    public function render()
    {
        return view('livewire.student.student-status.student-status',[
            'user_details' => $this->user_details,
            ])
            ->layout('layouts.student',[
                'title'=>$this->title]);
    }

    public function cancel_application($t_a_id){
       
        self::update_application($t_a_id);
        $this->view_details = NULL;
        self::update_data();
        $this->dispatchBrowserEvent('openModal','confirm_cancel_modal');
        
    }
    public function confirm_cancel($t_a_id){     
        
        if( DB::table('test_applications as ta')
        ->where([
            't_a_applicant_user_id'=> $this->user_details['user_id'],
            't_a_id'=>$t_a_id
                
            ])
        ->update(['t_a_isactive'=> 0,
                't_a_test_status_id' =>((array) DB::table('test_status')
                    ->where('test_status_details', '=', 'Cancelled')
                    ->select('test_status_id as t_a_test_status_id')
                    ->first())['t_a_test_status_id']
            ])
            ){
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'success',
                'title'             									=> 'Application successfully cancelled!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);

            DB::table('notifications')
            ->insert([
                'notification_id' =>NULL ,
                'notification_user_target' => $this->user_details['user_id'] ,
                'notification_user_creator' => $this->user_details['user_id'],
                'notification_icon_id' => 10 ,
                'notification_title' => 'Application cancelled!' ,
                'notification_content'  => 'You have successfully cancelled your application!' ,
                'notification_link' => '/student/status'
            ]);
            
        }else{
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'success',
                'title'             									=> 'Error cancelling application!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }
        
        self::update_data();
        $this->dispatchBrowserEvent('openModal','confirm_cancel_modal');
    }

    public function view_application2($t_a_id){ 
        $this->edit = false;
        $this->t_a_id = $t_a_id;
        $this->view_details = DB::table('test_applications as ta')
            ->select('*',DB::raw('DATE(ta.date_created) as applied_date'))
            ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
            ->join('users as us', 'us.user_id', '=', 'ta.t_a_applicant_user_id')
            ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'ta.t_a_applicant_user_id')
            ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
            ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
            ->join('cet_types as ct', 'ct.cet_type_id', '=', 'ta.t_a_cet_type_id')
            // ->join('school_rooms as sr', 'sr.school_room_id', '=', 'ta.t_a_school_room_id')
            
            ->where('test_type_details', '=', 'College Entrance Test')
            ->where('t_a_applicant_user_id','=',$this->user_details['user_id'])
            ->where('t_a_isactive','=',1)
            ->where('t_a_id','=',$this->t_a_id )
            ->limit(1)
            ->get()
            ->toArray();
            // dd($this->view_details);
            self::update_data();
            $this->dispatchBrowserEvent('openModal','view_application_modal_2');
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
            ->where('t_a_applicant_user_id','=',$this->user_details['user_id'])
            ->where('t_a_isactive','=',1)
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
            ->where('user_id','=',$this->user_details['user_id'])
            ->first();
        $this->user_details = [
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
    public function edit_application(){
        self::update_data();

        $this->view_details = DB::table('test_applications as ta')
            ->select('*',DB::raw('DATE(ta.date_created) as applied_date'))
            ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
            ->join('users as us', 'us.user_id', '=', 'ta.t_a_applicant_user_id')
            ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'ta.t_a_applicant_user_id')
            ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
            ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
            ->join('cet_types as ct', 'ct.cet_type_id', '=', 'ta.t_a_cet_type_id')
            ->join('school_rooms as sr', 'sr.school_room_id', '=', 'ta.t_a_school_room_id')
            ->where('test_type_details', '=', 'College Entrance Test')
                    
            // ->where('t_a_test_status_id', '=', 
            //     ((array) DB::table('test_types')
            //         ->where('test_type_details', '=', 'College Entrance Test')
            //         ->select('test_type_id as t_a_test_type_id')
            //         ->first())['t_a_test_type_id'])
            
            ->where('t_a_applicant_user_id','=',$this->user_details['user_id'])
            ->where('t_a_isactive','=',1)
            ->where('t_a_id','=',$this->t_a_id )
            ->limit(1)
            ->get()
            ->toArray();
        $this->edit = true;

        self::update_data();
        $this->dispatchBrowserEvent('openModal','view_application_modal');
    }

    public function cancel_edit_application(){

        $this->view_details = DB::table('test_applications as ta')
            ->select('*',DB::raw('DATE(ta.date_created) as applied_date'))
            ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
            ->join('users as us', 'us.user_id', '=', 'ta.t_a_applicant_user_id')
            ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'ta.t_a_applicant_user_id')
            ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
            ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
            ->join('cet_types as ct', 'ct.cet_type_id', '=', 'ta.t_a_cet_type_id')
            ->join('school_rooms as sr', 'sr.school_room_id', '=', 'ta.t_a_school_room_id')
            ->where('test_type_details', '=', 'College Entrance Test')
            
                    
            // ->where('t_a_test_status_id', '=', 
            //     ((array) DB::table('test_types')
            //         ->where('test_type_details', '=', 'College Entrance Test')
            //         ->select('test_type_id as t_a_test_type_id')
            //         ->first())['t_a_test_type_id'])
            
            ->where('t_a_applicant_user_id','=',$this->user_details['user_id'])
            ->where('t_a_isactive','=',1)
            ->where('t_a_id','=',$this->t_a_id )
            ->limit(1)
            ->get()
            ->toArray();


        self::update_data();
        // $this->dispatchBrowserEvent('openModal','view_application_modal');
        $this->edit = false;
    }
    public function exam_permit($t_a_id){ 
        $this->edit = false;
        $this->t_a_id = $t_a_id;
        $this->view_details =null;
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
            
            ->where('t_a_applicant_user_id','=',$this->user_details['user_id'])
            ->where('t_a_isactive','=',1)
            ->where('t_a_id','=',$this->t_a_id )
            ->limit(1)
            ->get()
            ->toArray();
            // dd($this->view_permit);
      
        
        $path = 'application-permit/'.$this->view_permit[0]->t_a_hash;
        $this->qr_code_link = ( $_SERVER['SERVER_PORT'] == 80?'http://':'https://'). $_SERVER['SERVER_NAME'] .'/'.$path;
        $options = new QROptions;
        $options->version     = 7;
        $options->imageBase64 = true;
        $options->scale =  $this->scale_size;
        $this->qrcode = (new QRCode($options))->render($this->qr_code_link);

        self::update_data();
        $this->dispatchBrowserEvent('openModal','ExamPermitModal');
        
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
