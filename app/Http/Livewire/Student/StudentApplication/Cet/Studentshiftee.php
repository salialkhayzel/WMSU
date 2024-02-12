<?php

namespace App\Http\Livewire\Student\StudentApplication\Cet;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Studentshiftee extends Component
{
    use WithFileUploads;
    public $user_detais;
    public $title;

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
    public $t_a_transcript_of_records_id;
    public $t_a_transcript_of_records;
    public $t_a_transcript_of_records_name;
    public $t_a_endorsement_letter_from_wmsu_dean_id;
    public $t_a_endorsement_letter_from_wmsu_dean ;
    public $t_a_endorsement_letter_from_wmsu_dean_name ;
    public $t_a_receipt_photo;

    public $required_receipt_photo;
    public $t_a_receipt_photo_name = null;

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
            $this->required_receipt_photo = true;
        }


        $this->title = 'application-cet-shiftee';
        $this->firstname = $this->user_details['user_firstname'];
        $this->middlename = $this->user_details['user_middlename'];
        $this->lastname = $this->user_details['user_lastname'];
        $this->suffix = $this->user_details['user_suffix'];
        $this->gender = $this->user_details['user_gender_details'];
        $this->sex = $this->user_details['user_sex_details'];
        $this->phone = $this->user_details['user_phone'];
        $this->address = $this->user_details['user_address'];
        $this->birthdate = $this->user_details['user_birthdate'];

        $this->email = $this->user_details['user_email'];

        if($family_details = DB::table('user_family_background as fb')
            ->where('family_background_user_id', $this->user_details['user_id'])
            ->first()){
            $this->m_firstname = $family_details->family_background_m_firstname;
            $this->m_middlename = $family_details->family_background_m_middlename ;
            $this->m_lastname = $family_details->family_background_m_lastname;
            $this->m_suffix = $family_details->family_background_m_suffix ;
            $this->f_firstname = $family_details->family_background_f_firstname ;
            $this->f_middlename = $family_details->family_background_f_middlename;
            $this->f_lastname = $family_details->family_background_f_lastname ;
            $this->f_suffix = $family_details->family_background_f_suffix ;
            $this->g_firstname = $family_details->family_background_g_firstname ;
            $this->g_middlename = $family_details->family_background_g_middlename ;
            $this->g_lastname = $family_details->family_background_g_lastname ;
            $this->g_suffix = $family_details->family_background_g_suffix ;
            $this->g_relationship = $family_details->family_background_g_relationship;
            $this->number_of_siblings = $family_details->family_background_number_of_siblings ;
            $this->fb_address = $family_details->family_background_address ;
        }

        if($educational_details = DB::table('user_educational_background as ueb')
            ->where('ueb.ueb_user_id', $this->user_details['user_id'])
            ->first()){

            $this->ueb_id = $educational_details->ueb_id;
            $this->ueb_shs_school_name = $educational_details->ueb_shs_school_name;
            $this->ueb_shs_address = $educational_details->ueb_shs_address ;
        }
    }

    public function mount(Request $request){
        $this->user_details = $request->session()->all();
        $this->title = 'application-cet-shiftee/transferee';
        // check if we already applied (then go to that application)
        self::update_data();
        $this->t_a_formal_photo_id = rand(0,1000000);
        $this->t_a_transcript_of_records_id = rand(0,1000000);
        $this->t_a_endorsement_letter_from_wmsu_dean_id = rand(0,1000000);
       
    } 
    public function render()
    {
        return view('livewire.student.student-application.cet.studentshiftee',[
            'user_details' => $this->user_details,
            ])
            ->layout('layouts.student',[
                'title'=>$this->title]);
    }

    public function submit_application(){

        // check application
        if(strlen($this->firstname) < 1 && strlen($this->firstname) > 255){
            return false;
        }
        if(strlen($this->lastname) < 1 && strlen($this->lastname) > 255){
            return false;
        }
        if(strlen($this->middlename) < 0 && strlen($this->middlename) > 255){
            return false;
        }
        if(strlen($this->suffix) < 0 && strlen($this->suffix) > 255){
            return false;
        }
        if(strlen($this->phone) < 1 && strlen($this->phone) > 255){
            return false;
        }


        // bug
        DB::table('users as u')
        ->where(['u.user_id'=> $this->user_details['user_id']])
        ->update([
            'u.user_firstname' => $this->firstname,
            'u.user_middlename'=>$this->middlename, 
            'u.user_lastname'=>$this->lastname, 
            'u.user_suffix'=>$this->suffix, 
            'u.user_phone'=>$this->phone,
        ]);

        //documents


        // family bg validation
        if(strlen($this->m_firstname) < 1 && strlen($this->m_firstname) > 255){
            return false;
        }
        if(strlen($this->m_middlename) < 1 && strlen($this->m_middlename) > 255){
            return false;
        }
        if(strlen($this->m_lastname) < 0 && strlen($this->m_lastname) > 255){
            return false;
        }
        if(strlen($this->m_suffix) < 0 && strlen($this->m_suffix) > 255){
            return false;
        }
        
        if(strlen($this->f_firstname) < 1 && strlen($this->f_firstname) > 255){
            return false;
        }
        if(strlen($this->m_middlename) < 1 && strlen($this->f_middlename) > 255){
            return false;
        }
        if(strlen($this->f_lastname) < 0 && strlen($this->f_lastname) > 255){
            return false;
        }
        if(strlen($this->f_suffix) < 0 && strlen($this->f_suffix) > 255){
            return false;
        }

        if($family_details = DB::table('user_family_background as fb')
        ->where('family_background_user_id', $this->user_details['user_id'])
        ->first()){
            // validation
            if(DB::table('user_family_background as fb')
                ->where(['fb.family_background_id'=> $family_details->family_background_id,
                ])
                ->update(['family_background_m_firstname' =>$this->m_firstname ,
                'family_background_m_middlename' => $this->m_middlename ,
                'family_background_m_lastname' => $this->m_lastname,
                'family_background_m_suffix' => $this->m_suffix,
                'family_background_f_firstname' =>  $this->f_firstname,
                'family_background_f_middlename' => $this->f_middlename,
                'family_background_f_lastname' =>  $this->f_lastname,
                'family_background_f_suffix' => $this->f_suffix,
                'family_background_g_firstname' => $this->g_firstname,
                'family_background_g_middlename' => $this->g_middlename,
                'family_background_g_lastname' => $this->g_lastname,
                'family_background_g_suffix' => $this->g_suffix,
                'family_background_g_relationship' => $this->g_relationship,
                
                'family_background_number_of_siblings' => $this->number_of_siblings,
                'family_background_address' => $this->fb_address,  
            ]));
        }else{
            if(DB::table('user_family_background')->insert([
                'family_background_user_id'=> $this->user_details['user_id'],
                'family_background_m_firstname' =>$this->m_firstname ,
                'family_background_m_middlename' => $this->m_middlename ,
                'family_background_m_lastname' => $this->m_lastname,
                'family_background_m_suffix' => $this->m_suffix,
                'family_background_f_firstname' =>  $this->f_firstname,
                'family_background_f_middlename' => $this->f_middlename,
                'family_background_f_lastname' =>  $this->f_lastname,
                'family_background_f_suffix' => $this->f_suffix,
                'family_background_g_firstname' => $this->g_firstname,
                'family_background_g_middlename' => $this->g_middlename,
                'family_background_g_lastname' => $this->g_lastname,
                'family_background_g_suffix' => $this->g_suffix,
                'family_background_g_relationship' => $this->g_relationship,
                'family_background_number_of_siblings' => $this->number_of_siblings,
                'family_background_address' => $this->fb_address,
            ]));
        }
        
        // documents
        if($this->t_a_formal_photo && file_exists(storage_path().'/app/livewire-tmp/'.$this->t_a_formal_photo->getfilename())){
            $file_extension =$this->t_a_formal_photo->getClientOriginalExtension();
            $tmp_name = 'livewire-tmp/'.$this->t_a_formal_photo->getfilename();
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
                    $storage_file_path = storage_path().'/app/public/application-requirements/t_a_formal_photo/';
                    
                    // move
                    $new_file_name = md5($tmp_name).'.'.$file_extension;
                    while(DB::table('test_applications')
                    ->where(['t_a_formal_photo'=> $new_file_name])
                    ->first()){
                        $new_file_name = md5($tmp_name.rand(1,10000000)).'.'.$file_extension;
                    }
                    if(Storage::move($tmp_name, 'public/application-requirements/t_a_formal_photo/'.$new_file_name)){
    
                        $this->t_a_formal_photo_name = $new_file_name;
                        // resize thumb nail
                        // resize 500x500 px
                        $this->t_a_formal_photo = null;

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
            $this->t_a_formal_photo_id = rand(0,1000000);         
        }

        if($this->t_a_transcript_of_records && file_exists(storage_path().'/app/livewire-tmp/'.$this->t_a_transcript_of_records->getfilename())){
            $file_extension =$this->t_a_transcript_of_records->getClientOriginalExtension();
            $tmp_name = 'livewire-tmp/'.$this->t_a_transcript_of_records->getfilename();
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
                    $storage_file_path = storage_path().'/app/public/application-requirements/t_a_transcript_of_records/';
                    
                    // move
                    $new_file_name = md5($tmp_name).'.'.$file_extension;
                    while(DB::table('test_applications')
                    ->where(['t_a_transcript_of_records'=> $new_file_name])
                    ->first()){
                        $new_file_name = md5($tmp_name.rand(1,10000000)).'.'.$file_extension;
                    }
                    if(Storage::move($tmp_name, 'public/application-requirements/t_a_transcript_of_records/'.$new_file_name)){
    
                        $this->t_a_transcript_of_records_name = $new_file_name;
                        // resize thumb nail
                        // resize 500x500 px
                        $this->t_a_transcript_of_records = null;

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
            $this->t_a_transcript_of_records_id = rand(0,1000000);         
        }

        if($this->t_a_endorsement_letter_from_wmsu_dean && file_exists(storage_path().'/app/livewire-tmp/'.$this->t_a_endorsement_letter_from_wmsu_dean->getfilename())){
            $file_extension =$this->t_a_endorsement_letter_from_wmsu_dean->getClientOriginalExtension();
            $tmp_name = 'livewire-tmp/'.$this->t_a_endorsement_letter_from_wmsu_dean->getfilename();
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
                    $storage_file_path = storage_path().'/app/public/application-requirements/t_a_endorsement_letter_from_wmsu_dean/';
                    
                    // move
                    $new_file_name = md5($tmp_name).'.'.$file_extension;
                    while(DB::table('test_applications')
                    ->where(['t_a_endorsement_letter_from_wmsu_dean'=> $new_file_name])
                    ->first()){
                        $new_file_name = md5($tmp_name.rand(1,10000000)).'.'.$file_extension;
                    }
                    if(Storage::move($tmp_name, 'public/application-requirements/t_a_endorsement_letter_from_wmsu_dean/'.$new_file_name)){
    
                        $this->t_a_endorsement_letter_from_wmsu_dean_name = $new_file_name;
                        // resize thumb nail
                        // resize 500x500 px
                        $this->t_a_endorsement_letter_from_wmsu_dean = null;

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
            $this->t_a_endorsement_letter_from_wmsu_dean_id = rand(0,1000000);         
        }
        if($this->t_a_receipt_photo && file_exists(storage_path().'/app/livewire-tmp/'.$this->t_a_receipt_photo->getfilename())){
            $file_extension =$this->t_a_receipt_photo->getClientOriginalExtension();
            $tmp_name = 'livewire-tmp/'.$this->t_a_receipt_photo->getfilename();
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
                    $storage_file_path = storage_path().'/app/public/application-requirements/t_a_receipt_photo/';
                    
                    // move
                    $new_file_name = md5($tmp_name).'.'.$file_extension;
                    while(DB::table('test_applications')
                    ->where(['t_a_receipt_photo'=> $new_file_name])
                    ->first()){
                        $new_file_name = md5($tmp_name.rand(1,10000000)).'.'.$file_extension;
                    }
                    if(Storage::move($tmp_name, 'public/application-requirements/t_a_receipt_photo/'.$new_file_name)){
    
                        $this->t_a_receipt_photo_name = $new_file_name;
                        // resize thumb nail
                        // resize 500x500 px
                        $this->t_a_receipt_photo = null;

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
            $this->required_receipt_photo_id = rand(0,1000000);         
        }
        

        $t_a_hash = md5(random_bytes(32));
        if(DB::table('test_applications')->insert([
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
            't_a_cet_type_id'=>((array) DB::table('cet_types')
                ->where('cet_type_name', '=', 'shiftee/tranferee')
                ->select('cet_type_id as t_a_cet_type_id')
                ->first())['t_a_cet_type_id'],
            't_a_hash' => $t_a_hash,
            't_a_school_school_name'=> $this->ueb_shs_school_name ,
            't_a_school_address' => $this->ueb_shs_address,

            't_a_formal_photo' => $this->t_a_formal_photo_name,
            't_a_transcript_of_records' => $this->t_a_transcript_of_records_name,
            't_a_endorsement_letter_from_wmsu_dean' => $this->t_a_endorsement_letter_from_wmsu_dean_name,
            't_a_receipt_photo' => $this->t_a_receipt_photo_name,
            
            ]
        )){
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'success',
                'title'             									=> 'Successfully Applied!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '/student/status'
            ]);
        }
    }
}
