<?php

namespace App\Http\Livewire\Student\StudentApplication;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class CetApplicationForm extends Component
{
    use WithFileUploads;
    public $user_detais;
    public $title;

    public $page = 1;

    public $cet_type_data;
    public $course_data;

    public $cet_form = [
        't_a_id' => NULL,
        't_a_test_type_id' => NULL,
        't_a_applicant_user_id' => NULL,
        't_a_test_status_id' => NULL,
        't_a_user_details' => NULL,
        't_a_isactive' => NULL,

        't_a_citizenship' => NULL,
        't_a_date_of_graduation' => NULL,
        't_a_course' => NULL,
        't_a_school_school_name'=> NULL,
        't_a_school_address' => NULL,
        't_a_school_id' => NULL,
        
        't_a_formal_photo' => NULL,
        't_a_school_principal_certification' => NULL,
        't_a_original_senior_high_school_card' => NULL,
        't_a_transcript_of_records' => NULL,
        't_a_endorsement_letter_from_wmsu_dean' => NULL,
        't_a_receipt_photo' => NULL,  // note that if the applicant is taking second time
        't_a_time_taken' => NULL,

        't_a_1st_choice' => NULL,
        't_a_2nd_choice' => NULL,
        't_a_3rd_choice' => NULL,

        // parent 
        't_a_f_citizenship' => NULL,
        't_a_f_hef' => NULL,
        't_a_f_occupation'  => NULL,
        't_a_f_place_of_work' => NULL,
        't_a_f_monthly_salary' => NULL,

        't_a_m_citizenship' => NULL,
        't_a_m_hef' => NULL,
        't_a_m_occupation' => NULL,
        't_a_m_place_of_work' => NULL,
        't_a_m_monthly_salary' => NULL,

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

    public function hydrate(){
        self::update_data();
        // dd($this->cet_form['t_a_cet_type_details']);
    }
    public function update_cet_type(){
        foreach($this->cet_type_data as $key =>$value){
            if($value->cet_type_details == $this->cet_form['t_a_cet_type_details']){
                $this->cet_form['t_a_cet_type_id'] = $value->cet_type_id;
                $this->cet_form['t_a_cet_type_details'] = $value->cet_type_details;
                break;
            }
        }
    }
    public function update_data(){
        $this->cet_type_data = DB::table('cet_types')
            ->get()
            ->toArray();
        $this->course_data = DB::table('departments as d')
            ->select(
                'department_id',
                'college_header',
                'department_name',
                'campus_name'
                )
            ->join('colleges as c','d.department_college_id','c.college_id')
            ->join('campuses as cp','c.college_campus_id','cp.campus_id')
            ->get()
            ->toArray();

        $this->high_schools =  DB::table('high_schools')
            ->select('*')
            ->where('high_school_name','LIKE',($this->cet_form['t_a_school_school_name'].'%'))
            ->limit(25)
            ->get()
            ->toArray();
            // dd( $this->high_schools);
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
        
        $this->cet_form = [
            't_a_id' => NULL,
            't_a_test_type_id' => NULL,
            't_a_applicant_user_id' => $this->user_details['user_id'],
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

            't_a_formal_photo_id' => rand(1,1000000),
            't_a_school_principal_certification_id' =>  rand(1,1000000),
            't_a_original_senior_high_school_card_id' =>  rand(1,1000000),
            't_a_transcript_of_records_id' =>  rand(1,1000000),
            't_a_endorsement_letter_from_wmsu_dean_id' =>  rand(1,1000000),
            't_a_receipt_photo_id' =>  rand(1,1000000),
    
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
        
        self::update_data();

        self::check_profile();
        foreach($this->cet_type_data as $key =>$value){
            if($value){
                $this->cet_form['t_a_cet_type_id'] = $value->cet_type_id;
                break;
            }
        }

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
      
        if(DB::table('test_applications')
            ->where('t_a_test_type_id', '=', 
                ((array) DB::table('test_types')
                    ->where('test_type_details', '=', 'College Entrance Test')
                    ->select('test_type_id as t_a_test_type_id')
                    ->first())['t_a_test_type_id'])
            
            ->where('t_a_applicant_user_id','=',$this->user_details['user_id'])
            ->where('t_a_test_status_id','=',
                DB::table('test_status')
                ->where('test_status_details', '=', 'Complete')
                ->select('test_status_id as t_a_test_status_id')
                ->first()->t_a_test_status_id)
            ->first()){
            $this->cet_form['t_a_times_taken'] = true;
        }
        
       
    }
    public function render(){
        return view('livewire.student.student-application.cet-application-form',[
            'user_details' => $this->user_details
            ])
            ->layout('layouts.student',[
                'title'=>$this->title]);
    }
    public function page($page){
        $this->page = $page;
        $this->dispatchBrowserEvent('moveUp');

        if($this->page == 1){
            // check data
        }
    }
    public function display_error($error_content){
        $this->dispatchBrowserEvent('swal:redirect',[
            'position'          									=> 'center',
            'icon'              									=> 'warning',
            'title'             									=> $error_content,
            'showConfirmButton' 									=> 'true',
            'timer'             									=> '1500',
            'link'              									=> '#'
        ]);
    }

    public function save_image($photo,$folder_name){
        if($photo && file_exists(storage_path().'/app/livewire-tmp/'.$photo->getfilename())){
            $file_extension =$photo->getClientOriginalExtension();
            $tmp_name = 'livewire-tmp/'.$photo->getfilename();
            $size = Storage::size($tmp_name);
            $mime = Storage::mimeType($tmp_name);
            $max_image_size = 20 * 1024*1024; // 5 mb
            $file_extensions = array('image/jpeg','image/png','image/jpg');
            
            if($size<= $max_image_size){
                $valid_extension = false;
                foreach ($file_extensions as $value) {
                    if($value == $mime){
                        $valid_extension = true;
                        break;
                    }
                }
                if($valid_extension){
                    $storage_file_path = storage_path().'/app/public/application-requirements/'.$folder_name.'/';
                    
                    // move
                    $new_file_name = md5($tmp_name).'.'.$file_extension;
                    while(DB::table('test_applications')
                    ->where([$folder_name=> $new_file_name])
                    ->first()){
                        $new_file_name = md5($tmp_name.rand(1,10000000)).'.'.$file_extension;
                    }
                   
                    if(Storage::copy($tmp_name, 'public/application-requirements/'.$folder_name.'/'.$new_file_name)){
                        return $new_file_name;
                    }    
                }else{
                    $this->dispatchBrowserEvent('swal:redirect',[
                        'position'          									=> 'center',
                        'icon'              									=> 'warning',
                        'title'             									=> 'Invalid image type!',
                        'showConfirmButton' 									=> 'true',
                        'timer'             									=> '1500',
                        'link'              									=> '#'
                    ]);
                    return 0;
                }
            }else{
                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'icon'              									=> 'warning',
                    'title'             									=> 'Image is too large!',
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '1500',
                    'link'              									=> '#'
                ]);
                return 0;
            }     
        }
    }
    public function validate_string($string,$error){
        if(strlen($string) < 1 || strlen($string) > 255){
            self::display_error('Please input valid '.$error);
            return 0;
        }
        return 1;
    }

    public function cet_application(){
        if($this->page == 1){
            $this->page = 2;
            $this->dispatchBrowserEvent('moveUp');
        }elseif($this->page == 2){
            //validate all
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

                return redirect('/student/status');
            }
            if(strlen($this->user_details['user_firstname']) < 1 && strlen($this->user_details['user_firstname']) > 255){
                self::display_error('Please input valid firstname');
                $this->page = 1;
                return 0;
            }
            
            if(strlen($this->user_details['user_lastname']) < 1 && strlen($this->user_details['user_lastname']) > 255){
                self::display_error('Please input valid lastname');
                $this->page = 1;
                return 0;
            }
            if(strlen($this->user_details['user_middlename']) < 0 && strlen($this->user_details['user_middlename']) > 255){
                self::display_error('Please input valid middlename');
                $this->page = 1;
                return 0;
            }
            if(strlen($this->user_details['user_suffix']) < 0 && strlen($this->user_details['user_suffix']) > 255){
                self::display_error('Please input valid suffix');
                $this->page = 1;
                return 0;
            }
            if(strlen($this->user_details['user_citizenship']) < 1 && strlen($this->user_details['user_citizenship']) > 255){
                self::display_error('Please input valid citizenship');
                $this->page = 1;
                return 0;
            }
            if(strlen($this->user_details['user_phone'])<10){
                self::display_error('Please input valid phone number');
                $this->page = 1;
                return 0;
            }

            if(strlen($this->cet_form['t_a_school_school_name'])<=0){
                self::display_error('Please input valid phone number');
                $this->page = 1;
                return 0;
            }else{
                if($high_schools =  DB::table('high_schools')
                ->select('*')
                ->where('high_school_name','=',$this->cet_form['t_a_school_school_name'])
                ->first()){
                    $this->cet_form['t_a_school_id'] = $high_schools->id;
                }
            }
            
            
            // update 
            DB::table('users as u')
                ->where(['u.user_id'=> $this->user_details['user_id']])
                ->update([
                    'u.user_firstname' => $this->user_details['user_firstname'],
                    'u.user_middlename'=>$this->user_details['user_middlename'],
                    'u.user_lastname'=>$this->user_details['user_lastname'],
                    'u.user_suffix'=>$this->user_details['user_suffix'],
                    'u.user_phone'=>$this->user_details['user_phone'],
                    'u.user_citizenship'=>$this->user_details['user_citizenship'],
                    
                ]);

            // // check course choice
            // if( !$this->cet_form['t_a_1st_choice'] && !intval($this->cet_form['t_a_1st_choice'])>0){
            //     dd($this->cet_form);
            // }
            // if( !$this->cet_form['t_a_2nd_choice'] && !intval($this->cet_form['t_a_2nd_choice'])>0){
            //     dd($this->cet_form);
            // }
            // if( !$this->cet_form['t_a_3rd_choice'] && !intval($this->cet_form['t_a_3rd_choice'])>0){
            //     dd($this->cet_form);
            // }

            foreach($this->cet_type_data as $key =>$value){
                if($value->cet_type_details == $this->cet_form['t_a_cet_type_details']){
                    $this->cet_form['t_a_cet_type_id'] = $value->cet_type_id;
                    $this->cet_form['t_a_cet_type_details'] = $value->cet_type_details;
                    break;
                }
            }

            $valid = true;
            if($valid){
                $valid = self::validate_string($this->cet_form['t_a_f_citizenship'],'father citizenship');
            }
            if($valid){
                $valid = self::validate_string($this->cet_form['t_a_f_hef'],'father highest education finished');
            }
            if($valid){
                $valid = self::validate_string($this->cet_form['t_a_f_occupation'],'father occupation');
            }
            if($valid){
                $valid = self::validate_string($this->cet_form['t_a_f_place_of_work'],'father place of work');
            }
            if($valid){
                $valid = self::validate_string($this->cet_form['t_a_f_monthly_salary'],'father monthly salary');
            }
            if($valid){
                $valid = self::validate_string($this->cet_form['t_a_m_citizenship'],'mother citizenship');
            }
            if($valid){
                $valid = self::validate_string($this->cet_form['t_a_m_hef'],'mother highest education finished');
            }
            if($valid){
                $valid = self::validate_string($this->cet_form['t_a_m_occupation'],'mother occupation');
            }
            if($valid){
                $valid = self::validate_string($this->cet_form['t_a_m_place_of_work'],'mother place of work');
            }
            if($valid){
                $valid = self::validate_string($this->cet_form['t_a_m_monthly_salary'],'mother monthly salary');
            }
        

            if(!$valid){
                return;
            }

            if(!isset($this->cet_form['t_a_computer_literate'])){
                self::display_error('Please check yes or no for "Do you know how to use a computer? "');
                return 0;
            }
            if(!isset($this->cet_form['t_a_religious_affiliation']) && strlen($this->cet_form['t_a_religious_affiliation'])>0){
                self::display_error('Please check for "Religous affiliation" or specify other');
                return 0;
            }
           
            if($this->cet_form['t_a_accept'] != 1){
                self::display_error('Please accept that you have read and understood all the instructions');
                return 0;
            }
            $rValue = self::save_image($this->cet_form['t_a_formal_photo'],'t_a_formal_photo');
            if($rValue){
                $this->cet_form['formal_photo'] = $rValue;
            }

            if($this->cet_form['t_a_cet_type_details'] == 'SENIOR HIGH SCHOOL GRADUATING STUDENT'){
                if(strlen($this->cet_form['t_a_school_school_name']) < 1 || strlen($this->cet_form['t_a_school_school_name']) > 255){
                    self::display_error('Please input valid school name');
                    $this->page = 1;
                    return 0;
                }
                if(strlen($this->cet_form['t_a_school_address']) < 1 || strlen($this->cet_form['t_a_school_address']) > 255){
                    self::display_error('Please input valid school address');
                    $this->page = 1;
                    return 0;
                }
                if(strlen($this->cet_form['t_a_date_of_graduation']) < 1 || strlen($this->cet_form['t_a_date_of_graduation']) > 255){
                    self::display_error('Please input valid graduation date');
                    $this->page = 1;
                    return 0;
                }

                $rValue = self::save_image($this->cet_form['t_a_school_principal_certification'],'t_a_school_principal_certification');
                if($rValue){
                    $this->cet_form['t_a_school_principal_certification'] = $rValue;
                }
                
            }else if($this->cet_form['t_a_cet_type_details'] == 'SENIOR HIGH SCHOOL GRADUATE'){
                if(strlen($this->cet_form['t_a_school_school_name']) < 1 || strlen($this->cet_form['t_a_school_school_name']) > 255){
                    self::display_error('Please input valid school name');
                    $this->page = 1;
                    return 0;
                }
                if(strlen($this->cet_form['t_a_school_address']) < 1 || strlen($this->cet_form['t_a_school_address']) > 255){
                    self::display_error('Please input valid school address');
                    $this->page = 1;
                    return 0;
                }
                if(strlen($this->cet_form['t_a_date_of_graduation']) < 1 || strlen($this->cet_form['t_a_date_of_graduation']) > 255){
                    self::display_error('Please input valid graduation date');
                    $this->page = 1;
                    return 0;
                }
                $rValue = self::save_image($this->cet_form['t_a_original_senior_high_school_card'],'t_a_original_senior_high_school_card');
                if($rValue){
                    $this->cet_form['t_a_original_senior_high_school_card'] = $rValue;
                }
                if($this->cet_form['t_a_times_taken']){
                    $rValue = self::save_image($this->cet_form['t_a_receipt_photo'],'t_a_receipt_photo');
                    if($rValue){
                        $this->cet_form['t_a_receipt_photo'] = $rValue;
                    }
                }
            }else if($this->cet_form['t_a_cet_type_details'] == 'SHIFTEE / TRANSFEREE STUDENT'){
                if(strlen($this->cet_form['t_a_school_school_name']) < 1 || strlen($this->cet_form['t_a_school_school_name']) > 255){
                    self::display_error('Please input valid school name');
                    $this->page = 1;
                    return 0;
                }
                if(strlen($this->cet_form['t_a_school_address']) < 1 || strlen($this->cet_form['t_a_school_address']) > 255){
                    self::display_error('Please input valid school address');
                    $this->page = 1;
                    return 0;
                }
                if(strlen($this->cet_form['t_a_course']) < 1 || strlen($this->cet_form['t_a_course']) > 255){
                    self::display_error('Please input valid course');
                    $this->page = 1;
                    return 0;
                }
                $rValue = self::save_image($this->cet_form['t_a_transcript_of_records'],'t_a_transcript_of_records');
                if($rValue){
                    $this->cet_form['t_a_transcript_of_records'] = $rValue;
                }
                $rValue = self::save_image($this->cet_form['t_a_endorsement_letter_from_wmsu_dean'],'t_a_endorsement_letter_from_wmsu_dean');
                if($rValue){
                    $this->cet_form['t_a_endorsement_letter_from_wmsu_dean'] = $rValue;
                }
                $this->cet_form['t_a_times_taken'] = true;
                if($this->cet_form['t_a_times_taken']){
                    $rValue = self::save_image($this->cet_form['t_a_receipt_photo'],'t_a_receipt_photo');
                    if($rValue){
                        $this->cet_form['t_a_receipt_photo'] = $rValue;
                    }
                }
            }



            if(DB::table('test_applications')
                ->insert([
                    't_a_test_type_id'=>((array) DB::table('test_types')
                        ->where('test_type_details', '=', 'College Entrance Test')
                        ->select('test_type_id as t_a_test_type_id')
                        ->first())['t_a_test_type_id'],
                    't_a_applicant_user_id'=>$this->user_details['user_id'],
                    't_a_school_year_id'=>((array) DB::table('school_years')
                        ->where('school_year_details', '=', DB::raw('CONCAT(YEAR(NOW()),"-",YEAR(NOW())+1)'))
                        ->select('school_year_id as t_a_school_year_id')
                        ->first())['t_a_school_year_id'],
                    't_a_applicant_user_id'=>$this->user_details['user_id'],
                    't_a_user_details'=>json_encode($this->user_details),
                    't_a_test_status_id'=>((array) DB::table('test_status')
                        ->where('test_status_details', '=', 'Pending')
                        ->select('test_status_id as t_a_test_status_id')
                        ->first())['t_a_test_status_id'],
                    't_a_cet_type_id'=> $this->cet_form['t_a_cet_type_id'],
                        
                    't_a_citizenship' => $this->user_details['user_citizenship'],
                    
                    't_a_date_of_graduation' => $this->cet_form['t_a_date_of_graduation'],
                    't_a_course' => $this->cet_form['t_a_course'],
                    't_a_school_school_name'=> $this->cet_form['t_a_school_school_name'],
                    't_a_school_address' => $this->cet_form['t_a_school_address'],
                    't_a_school_id' => $this->cet_form['t_a_school_id'],
                    't_a_formal_photo' => $this->cet_form['formal_photo'],
                    't_a_school_principal_certification' => $this->cet_form['t_a_school_principal_certification'],
                    't_a_original_senior_high_school_card' => $this->cet_form['t_a_original_senior_high_school_card'],
                    't_a_transcript_of_records' => $this->cet_form['t_a_transcript_of_records'],
                    't_a_endorsement_letter_from_wmsu_dean' => $this->cet_form['t_a_endorsement_letter_from_wmsu_dean'],
                    't_a_receipt_photo' => $this->cet_form['t_a_receipt_photo'],  // note that if the applicant is taking second time

                    't_a_1st_choice' => $this->cet_form['t_a_1st_choice'],
                    't_a_2nd_choice' => $this->cet_form['t_a_2nd_choice'],
                    't_a_3rd_choice' => $this->cet_form['t_a_3rd_choice'],

                    // parent 
                    't_a_f_citizenship' => $this->cet_form['t_a_f_citizenship'],
                    't_a_f_hef' => $this->cet_form['t_a_f_hef'],
                    't_a_f_occupation'  => $this->cet_form['t_a_f_occupation'],
                    't_a_f_place_of_work' => $this->cet_form['t_a_f_place_of_work'],
                    't_a_f_monthly_salary' => $this->cet_form['t_a_f_monthly_salary'],

                    't_a_m_citizenship' => $this->cet_form['t_a_m_citizenship'],
                    't_a_m_hef' => $this->cet_form['t_a_m_hef'],
                    't_a_m_occupation' => $this->cet_form['t_a_m_occupation'],
                    't_a_m_place_of_work' => $this->cet_form['t_a_m_place_of_work'],
                    't_a_m_monthly_salary' => $this->cet_form['t_a_m_monthly_salary'],

                    't_a_computer_literate' => $this->cet_form['t_a_computer_literate'],
                    't_a_ethnic_group' => $this->cet_form['t_a_ethnic_group'],
                    't_a_religious_affiliation' => $this->cet_form['t_a_religious_affiliation'],
                    't_a_accept' => $this->cet_form['t_a_accept'],
                    't_a_hash' => md5(random_bytes(32)),
                        ])
                ){
                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'icon'              									=> 'success',
                    'title'             									=> 'Successfully applied!',
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '1500',
                    'link'              									=> '/student/status'
                ]);

                DB::table('notifications')
                ->insert([
                    'notification_id' =>NULL ,
                    'notification_user_target' => $this->user_details['user_id'] ,
                    'notification_user_creator' => $this->user_details['user_id'],
                    'notification_icon_id' => 6 ,
                    'notification_title' => 'Application Submitted!' ,
                    'notification_content'  => 'Your application has been successfully submitted!' ,
                    'notification_link' => '/student/status'
                ]);
            }
            
        }
       
        
    }
}
