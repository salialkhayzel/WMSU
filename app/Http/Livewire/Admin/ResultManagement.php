<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Livewire\Admin\Exports\ExamineesExport;
use App\Http\Livewire\Admin\Imports\ImportResults;
use Mail;

class ResultManagement extends Component
{

    public $mail = true;

    
    use WithFileUploads;
    public $user_detais;
    public $title;

    public $examinees;
    public $cet_filter;
    public $exam_types ;
    public $examinees_filter;
    public $exam_type_name;

    public $examinees_results;
    public $upload_id;

    public $complete_results;

    public $active;
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
        self::update_data();
    }
    public function update_data(){

        $this->exam_types = DB::table('test_applications as ta')
            ->select(
                // '*',
                DB::raw('count(*) exam_type_count' ),
                'test_type_id',
                'test_type_name',
                'test_type_details',
                )
            ->join('school_rooms as sr', 'sr.school_room_id', '=', 'ta.t_a_school_room_id')
            ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
            ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
            ->where('t_a_isactive','=',1)
            ->where('test_status_details','=','Accepted')
            ->whereNotNull('t_a_school_room_id')
            ->where('school_room_isactive','=',1)
            ->groupBy('test_type_id')
            ->get()
            ->toArray();

        $this->complete_results = DB::table('test_applications as ta')
        ->select(
            // '*',
            't_a_id',
            DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
            'test_type_name',
            DB::raw('DATE(ta.date_created) as date_applied'),
            't_a_cet_oapr' ,
            't_a_cet_english_procficiency',
            't_a_cet_reading_comprehension',
            't_a_cet_science_process_skills' ,
            't_a_cet_quantitative_skills',
            't_a_cet_abstract_thinking_skills' ,
            'test_status_details',
            )
        ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
        ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
        ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
        ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
        ->where('t_a_isactive','=',0)
        ->where('test_status_details','=','Complete')
        ->get()
        ->toArray();

        $this->examinees = DB::table('test_applications as ta')
        ->select(
            // '*',
            't_a_id',
            DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
            'test_type_name',
            DB::raw('DATE(ta.date_created) as date_applied'),
            )
        ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
        ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
        ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
        ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
        ->join('school_rooms as sr', 'sr.school_room_id', '=', 'ta.t_a_school_room_id')
        ->where('t_a_isactive','=',1)
        ->where('test_status_details','=','Accepted')
        ->whereNotNull('t_a_school_room_id')
        ->where('school_room_isactive','=',1)
        ->get()
        ->toArray();

        
        // dd($this->examinees);
    }
    public function mount(Request $request){
        $this->user_details = $request->session()->all();
        $this->title = 'result-management';

        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        $this->cet_filter = [
            '#' => true,
            'id' => true,
            'First name' => true,
            'Middle name' => true,
            'Last name' => true,
            'Venue'=> true,
            'Test center'=> true,
            'College' => true,
            'Room code' => true,
            'Room name'=> true,
            'Start - End'=> true,	
            'hash' => true,
            'CET OAPR' => true,
            'English Proficiency' => true,	
            'Reading Comprehension' => true,							
            'Science Processing Skills' => true,
            'Quantitative Skills' => true,
            'Abstract Thinking' => true,
        ];

        $this->nat_filter = [
            '#' => true,
            'id' => true,
            'First name' => true,
            'Middle name' => true,
            'Last name' => true,
            'Venue'=> true,
            'Test center'=> true,
            'College' => true,
            'Room code' => true,
            'Room name'=> true,
            'Start - End'=> true,	
            'hash' => true,
            'CET OAPR' => true,
            'English Proficiency' => true,	
            'Reading Comprehension' => true,							
            'Science Processing Skills' => true,
            'Quantitative Skills' => true,
            'Abstract Thinking' => true,
        ];

        $this->results_filter = [
            '#' => true,
            'Code' => true,
            'Applicant name'=> true,
            'Exam type'=> false,
            'Date applied'	=> false,
            'Status'=> true,	
            'CET OAPR' => true,
            'English Proficiency' => true,	
            'Reading Comprehension' => true,							
            'Science Processing Skills' => true,
            'Quantitative Skills' => true,
            'Abstract Thinking' => true,							
            'Actions'	=> false					
        ];

        $this->examinees_filter = [
            '#' => true,
            'Code' => true,
            'Applicant name'=> true,
            'Exam type'=> true,
            'Date applied'	=> true,
            'Status'=> true ,
            'Actions'	=> false		
        ];

        $this->active = 'results';

       
        if($this->access_role['C'] || $this->access_role['R'] || $this->access_role['U'] || $this->access_role['D']){
            
            self::update_data();
            $this->exam_type_name = 0;
        }
    }

    public function update_filter(){
        // if($this->exam_type_name == 'CET'){
        //     $this->examinees_filter =  $this->cet_filter;
        // }elseif(0){

        // }
      
    }
    public function render()
    {
        return view('livewire.admin.result-management',[
            'user_details' => $this->user_details
            ])
            ->layout('layouts.admin',[
                'title'=>$this->title]);
    }

    public function filterView(){
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
        $this->exam_type_name = 0;
    }
    public function download_option(){
        // display modal
        $this->exam_type_id = 0;
        $this->dispatchBrowserEvent('openModal','examinees_filter');
    }
    public function download_file($export_type = null,$columns = null){
        if($this->exam_type_name == '0'){
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Please select a exam type!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
             ]);
             return;
        }elseif($this->exam_type_name == 'CET'){
            $this->examinees = DB::table('test_applications as ta')
                ->select(
                    // '*',
                    // DB::raw('count(*) as school_room_sschool_room_number_of_examinees' ),
                   '*',
                   'ta.t_a_id as ta_id'
                    )
                ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
                ->join('test_schedules as tsc', 'tsc.id', '=', 'ta.t_a_test_schedule_id')
                ->join('school_rooms as sr', 'sr.school_room_id', '=', 'ta.t_a_school_room_id')
                ->leftjoin('attendance as a','ta.t_a_id','a.t_a_id')
                ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
                ->join('test_centers as tc','tc.id','tsc.test_center_id')
                ->where('t_a_isactive','=',1)
                ->where('test_status_details','=','Accepted')
                ->whereNotNull('t_a_school_room_id')
                ->where('school_room_isactive','=',1)
                ->get()
                ->toArray();
            // dd($this->examinees); $val
            $header = [];
            foreach ($this->cet_filter as $item => $value) {
                if($value){
                    array_push($header,$item);
                }   
            }  
            $item = [];
            $content = [];
            $counter = 1;
            foreach ($this->examinees as $key => $value) {
                $item = [];
                array_push( $item,$counter);
                array_push( $item,$value->ta_id);
                array_push( $item,$value->user_firstname);
                array_push( $item,$value->user_middlename);
                array_push( $item,$value->user_lastname);

                if($this->cet_filter['Venue']){
                    array_push( $item,$value->school_room_bldg_name);
                }
                if($this->cet_filter['Test center']){
                    array_push( $item,$value->test_center_code);
                }
                if($this->cet_filter['College']){
                    array_push( $item,$value->school_room_bldg_abr);
                }
                if($this->cet_filter['Room code']){
                    array_push( $item,$value->school_room_id.' - '.$value->school_room_name);
                }
                if($this->cet_filter['Room name']){
                    array_push( $item,$value->school_room_name);
                }
                if($this->cet_filter['Start - End']){
                    if($value->t_a_ampm == 'AM'){
                        $val = $value->am_start.' - '.$value->am_end;
                    }else{
                        $val = $value->pm_start.' - '.$value->pm_end;
                    }

                    array_push( $item, $val);
                }
                if($this->cet_filter['hash']){
                    array_push( $item,$value->t_a_hash);
                }

                array_push( $item,);
                array_push( $item,);
                array_push( $item,);
                array_push( $item,);
                array_push( $item,);
                array_push($content,$item);
                $counter++;
            }

          
        
        }elseif($this->exam_type_name == 'NAT'){
            $this->examinees = DB::table('test_applications as ta')
                ->select(
                    // '*',
                    // DB::raw('count(*) as school_room_sschool_room_number_of_examinees' ),
                    't_a_id',
                    'user_id',
                    'user_name',
                    DB::raw('CONCAT(user_addr_street,", ",user_addr_brgy,", ",user_addr_city_mun,", ",user_addr_province,", ",user_addr_zip_code) as user_address'),
                    'user_firstname',
                    'user_middlename',
                    'user_lastname',
                    't_a_hash',
                    'school_room_id',
                    'school_room_capacity',	
                    'school_room_college_name',	
                    'school_room_college_abr',
                    'school_room_venue',
                    'school_room_name',	
                    'school_room_test_center',
                    'school_room_test_date',
                    'school_room_test_time_start',
                    'school_room_test_time_end',
                    'school_room_description',
                    )
                ->join('school_rooms as sr', 'sr.school_room_id', '=', 'ta.t_a_school_room_id')
                ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
                ->join('users as u', 'u.user_id', '=', 'ta.t_a_applicant_user_id')
                ->where('t_a_isactive','=',1)
                ->where('test_status_details','=','Accepted')
                ->whereNotNull('t_a_school_room_id')
                ->where('school_room_isactive','=',1)
                ->whereNotNull('school_room_proctor_user_id')
                ->get()
                ->toArray();
            
            $header = [];
            foreach ($this->cet_filter as $item => $value) {
                if($value){
                    array_push($header,$item);
                }   
            }  
            $item = [];
            $content = [];
            $counter = 1;
            foreach ($this->examinees as $key => $value) {
                $item = [];
                array_push( $item,$counter);
                array_push( $item,$value->t_a_id);
                array_push( $item,$value->user_firstname);
                array_push( $item,$value->user_middlename);
                array_push( $item,$value->user_lastname);

                if($this->cet_filter['Venue']){
                    array_push( $item,$value->school_room_venue);
                }
                if($this->cet_filter['Test center']){
                    array_push( $item,$value->school_room_test_center);
                }
                if($this->cet_filter['College']){
                    array_push( $item,$value->school_room_college_abr);
                }
                if($this->cet_filter['Room code']){
                    array_push( $item,$value->school_room_id.' - '.$value->school_room_name);
                }
                if($this->cet_filter['Room name']){
                    array_push( $item,$value->school_room_name);
                }
                if($this->cet_filter['Start - End']){
                    array_push( $item,$value->school_room_test_time_start.' - '.$value->school_room_test_time_end);
                }
                if($this->cet_filter['hash']){
                    array_push( $item,$value->t_a_hash);
                }

                array_push( $item,);
                array_push( $item,);
                array_push( $item,);
                array_push( $item,);
                array_push( $item,);
                array_push($content,$item);
                $counter++;
            }
        }

        $export = new ExamineesExport([
            $header,
            $content
        ]);
        self::update_data();


        if($export_type == 'EXCEL'){
            return Excel::download($export, 'examinees_list.csv', \Maatwebsite\Excel\Excel::CSV);
        }elseif($export_type == 'CSV'){
            return Excel::download($export, 'examinees_list.csv', \Maatwebsite\Excel\Excel::CSV);
        }elseif($export_type == 'ACSV'){
            return Excel::download($export, 'examinees_list.csv', \Maatwebsite\Excel\Excel::CSV, [
                'Content-Type' => 'text/csv',
        ]);
        }else{
            return Excel::download($export, 'examinees_list.csv', \Maatwebsite\Excel\Excel::CSV);
        }
        
    }

    public function upload_file(){
        
        $tmp_name = 'livewire-tmp/'.$this->examinees_results->getfilename();
        $new_file_name = 'result.csv';
        self::update_data();
       
    }

    public function validate_upload_header($header){
        $valid = false;
        foreach ($header as $key => $value) {
            if($value == 'id'){
                $valid = true;
                break;
            }
        }
        if($valid){
            $valid = false;
            foreach ($header as $key => $value) {
                if($value == 'CET OAPR'){
                    $valid = true;
                    break;
                }
            }
        }
        if($valid){
            $valid = false;
            foreach ($header as $key => $value) {
                if($value == 'English Proficiency'){
                    $valid = true;
                    break;
                }
            }
        }
        if($valid){
            $valid = false;
            foreach ($header as $key => $value) {
                if($value == 'Reading Comprehension'){
                    $valid = true;
                    break;
                }
            }
        }
        if($valid){
            $valid = false;
            foreach ($header as $key => $value) {
                if($value == 'Science Processing Skills'){
                    $valid = true;
                    break;
                }
            }
        }
        if($valid){
            $valid = false;
            foreach ($header as $key => $value) {
                if($value == 'Quantitative Skills'){
                    $valid = true;
                    break;
                }
            }
        }
        if($valid){
            $valid = false;
            foreach ($header as $key => $value) {
                if($value == 'Abstract Thinking'){
                    $valid = true;
                    break;
                }
            }
        }

       
        if(!$valid){
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Incorrect header data!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
             ]);
            return -1;
        }
        return 1;
    }

    public function validate_data($header,$content){
        $header_count = count($header);

        foreach ($content as $key => $value) {
            if($header_count != count($value)){
                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'icon'              									=> 'warning',
                    'title'             									=> 'Missing data!',
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '1500',
                    'link'              									=> '#'
                ]);
                return -1;
            }
        }
        foreach ($header as $key => $value) {
            if($value == 'id'){
                $id_index = $key;
                break;
            }
        }
        foreach ($header as $key => $value) {
            if($value == 'CET OAPR'){
                $oapr_index = $key;
                break;
            }
        }
        foreach ($header as $key => $value) {
            if($value == 'English Proficiency'){
                $ep_index = $key;
                break;
            }
        }
        foreach ($header as $key => $value) {
            if($value == 'Reading Comprehension'){
                $rc_index = $key;
                break;
            }
        }
        foreach ($header as $key => $value) {
            if($value == 'Science Processing Skills'){
                $sps_index = $key;
                break;
            }
        }
        foreach ($header as $key => $value) {
            if($value == 'Quantitative Skills'){
                $qs_index = $key;
                break;
            }
        }
        foreach ($header as $key => $value) {
            if($value == 'Abstract Thinking'){
                $at_index = $key;
                break;
            }
        }

        foreach ($content as $key => $value) {
            $id_value = floatval($value[$id_index]);
            if(!DB::table('test_applications as ta')
                ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
                ->where('t_a_id','=',$id_value)
                ->where('t_a_isactive','=',1)
                ->where('test_status_details','=','Accepted')
                ->first()
                ){
                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'icon'              									=> 'warning',
                    'title'             									=> 'Invalid data on #'.$value[0],
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '1500',
                    'link'              									=> '#'
                ]);
                return -1;
            }
            $result_value = floatval($value[$oapr_index]);
            if($result_value <= 0 || $result_value >100){
                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'icon'              									=> 'warning',
                    'title'             									=> 'Invalid OAPR on #'.$value[0],
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '1500',
                    'link'              									=> '#'
                ]);
                return -1;
            }
            $result_value = floatval($value[$ep_index]);
            if($result_value <= 0 || $result_value >100){
                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'icon'              									=> 'warning',
                    'title'             									=> 'Invalid English Proficiency on #'.$value[0],
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '1500',
                    'link'              									=> '#'
                ]);
                return -1;
            }
            $result_value = floatval($value[$rc_index]);
            if($result_value <= 0 || $result_value >100){
                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'icon'              									=> 'warning',
                    'title'             									=> 'Invalid Reading Comprehension on #'.$value[0],
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '1500',
                    'link'              									=> '#'
                ]);
                return -1;
            }
            $result_value = floatval($value[$sps_index]);
            if($result_value <= 0 || $result_value >100){
                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'icon'              									=> 'warning',
                    'title'             									=> 'Invalid Science Processing Skills on #'.$value[0],
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '1500',
                    'link'              									=> '#'
                ]);
                return -1;
            }
            $result_value = floatval($value[$qs_index]);
            if($result_value <= 0 || $result_value >100){
                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'icon'              									=> 'warning',
                    'title'             									=> 'Invalid Quantitative Skills on #'.$value[0],
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '1500',
                    'link'              									=> '#'
                ]);
                return -1;
            }
            $result_value = floatval($value[$at_index]);
            if($result_value <= 0 || $result_value >100){
                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'icon'              									=> 'warning',
                    'title'             									=> 'Invalid Abstract Thinking on #'.$value[0],
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '1500',
                    'link'              									=> '#'
                ]);
                return -1;
            }
        }
        return 1;
    }

    public function import_insert_data($header,$content){
        foreach ($header as $key => $value) {
            if($value == 'id'){
                $id_index = $key;
                break;
            }
        }
        foreach ($header as $key => $value) {
            if($value == 'CET OAPR'){
                $oapr_index = $key;
                break;
            }
        }
        foreach ($header as $key => $value) {
            if($value == 'English Proficiency'){
                $ep_index = $key;
                break;
            }
        }
        foreach ($header as $key => $value) {
            if($value == 'Reading Comprehension'){
                $rc_index = $key;
                break;
            }
        }
        foreach ($header as $key => $value) {
            if($value == 'Science Processing Skills'){
                $sps_index = $key;
                break;
            }
        }
        foreach ($header as $key => $value) {
            if($value == 'Quantitative Skills'){
                $qs_index = $key;
                break;
            }
        }
        foreach ($header as $key => $value) {
            if($value == 'Abstract Thinking'){
                $at_index = $key;
                break;
            }
        }
        foreach ($content as $key => $value) {
            DB::table('test_applications as ta')
                ->where('t_a_id','=',intval($value[$id_index]))
                ->update([
                    't_a_isactive' => 0,
                    't_a_cet_oapr' => floatval($value[$oapr_index]), 
                    't_a_cet_english_procficiency' => floatval($value[$ep_index]), 
                    't_a_cet_reading_comprehension' => floatval($value[$rc_index]), 
                    't_a_cet_science_process_skills' => floatval($value[$sps_index]), 
                    't_a_cet_quantitative_skills' => floatval($value[$qs_index]), 
                    't_a_cet_abstract_thinking_skills' => floatval($value[$at_index]) , 
                    't_a_test_status_id' =>((array) DB::table('test_status')
                                ->where('test_status_details', '=', 'Complete')
                            ->select('test_status_id as t_a_test_status_id')
                            ->first())['t_a_test_status_id'],
            ]);
        }
        return 1;
    }

    public function importresults() {
        // first validation pass
        if($this->exam_type_name == '0' || !isset($this->exam_type_name)){
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Please select a exam type!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
             ]);
             $this->upload_id = rand(0,100000);
             return;
        }else if($this->exam_type_name == 'CET'){
            $rows = array_map('str_getcsv', file(storage_path('app/results/result.csv')));
            $header =[];
            $content =[];
            $item = [];
            foreach ($rows as $key => $value) {
                // validate
                if($key == 0){
                    foreach ($value as $key => $item_value) {
                        array_push( $header,$item_value);
                    }
                }else{
                    $item = [];
                    foreach ($value as $key => $item_value) {
                        array_push( $item,$item_value);
                    }
                    array_push( $content,$item);
                }
            }
            // first validation pass
            self::validate_upload_header($header);
            self::validate_data($header,$content);
        }
    }
    public function save_import_results(){
      
        if($this->exam_type_name == '0' || !isset($this->exam_type_name)){
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Please select a exam type!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
             ]);
             $this->upload_id = rand(0,100000);
             return;
        }else if($this->exam_type_name == 'CET'){
            $rows = array_map('str_getcsv', file(storage_path('app/results/result.csv')));
            $header =[];
            $content =[];
            $item = [];
            foreach ($rows as $key => $value) {
                // validate
                if($key == 0){
                    foreach ($value as $key => $item_value) {
                        array_push( $header,$item_value);
                    }
                }else{
                    $item = [];
                    foreach ($value as $key => $item_value) {
                        array_push( $item,$item_value);
                    }
                    array_push( $content,$item);
                }
            }
            // first validation pass
            if(self::validate_upload_header($header) && self::validate_data($header,$content)){
                if(self::import_insert_data($header,$content)){
                    $this->dispatchBrowserEvent('swal:redirect',[
                        'position'          									=> 'center',
                        'icon'              									=> 'success',
                        'title'             									=> 'Result are now updated!',
                        'showConfirmButton' 									=> 'true',
                        'timer'             									=> '1500',
                        'link'              									=> '#'
                     ]);
                }

            }
        }
    }
}
