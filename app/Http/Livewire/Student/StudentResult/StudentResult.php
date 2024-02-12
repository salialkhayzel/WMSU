<?php

namespace App\Http\Livewire\Student\StudentResult;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class StudentResult extends Component
{
    public $user_detais;
    public $title;
    public $result= [
        't_a_id' => NULL,
        'user_fullname' => NULL,
        'test_type_name'=> NULL,
        'test_type_details'=> NULL,
        'date_applied'=> NULL,
        't_a_cet_oapr' => NULL,
        't_a_cet_english_procficiency'=> NULL,
        't_a_cet_reading_comprehension'=> NULL,
        't_a_cet_science_process_skills' => NULL,
        't_a_cet_quantitative_skills'=> NULL,
        't_a_cet_abstract_thinking_skills' => NULL,
        'test_status_details'=> NULL
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
        $this->complete_results = DB::table('test_applications as ta')
        ->select(
            // '*',
            't_a_id',
            DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
            'test_type_name',
            'test_type_details',
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
        ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
        ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
        ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
        ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
        ->where('t_a_isactive','=',0)
        ->where('test_status_details','=','Complete')
        ->where('t_a_applicant_user_id','=',$this->user_details['user_id'])
        ->get()
        ->toArray();
        // dd($this->complete_results);
    }
    
    public function mount(Request $request){
        $this->user_details = $request->session()->all();
        $this->title = 'result';

        self::update_data();
    }
    public function render()
    {
        return view('livewire.student.student-result.student-result',[
            'user_details' => $this->user_details
            ])
            ->layout('layouts.student',[
                'title'=>$this->title]);
    }
    public function view_result($t_a_id){
        $result = DB::table('test_applications as ta')
        ->select(
            // '*',
            't_a_id',
            DB::raw('CONCAT(u.user_lastname,", ",u.user_firstname," ",LEFT(u.user_middlename,1)) as user_fullname'),
            'test_type_name',
            'test_type_details',
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
        ->join('user_family_background as fb', 'fb.family_background_user_id', '=', 'u.user_id')
        ->join('test_types as tt', 'tt.test_type_id', '=', 'ta.t_a_test_type_id')
        ->join('test_status as ts', 'ts.test_status_id', '=', 'ta.t_a_test_status_id')
        ->join('school_years as sy', 'sy.school_year_id', '=', 'ta.t_a_school_year_id')
        ->where('t_a_isactive','=',0)
        ->where('test_status_details','=','Complete')
        ->where('t_a_applicant_user_id','=',$this->user_details['user_id'])
        ->where('t_a_id','=',$t_a_id)
        ->first();

        $this->result= [
            't_a_id' => $result->t_a_id,
            'user_fullname' => $result->user_fullname,
            'test_type_name'=> $result->test_type_name,
            'test_type_details'=> $result->test_type_details,
            'date_applied'=> $result->date_applied,
            't_a_cet_oapr' => $result->t_a_cet_oapr,
            't_a_cet_english_procficiency'=> $result->t_a_cet_english_procficiency,
            't_a_cet_reading_comprehension'=> $result->t_a_cet_reading_comprehension,
            't_a_cet_science_process_skills' => $result->t_a_cet_science_process_skills,
            't_a_cet_quantitative_skills'=> $result->t_a_cet_quantitative_skills,
            't_a_cet_abstract_thinking_skills' => $result->t_a_cet_abstract_thinking_skills,
            'test_status_details'=> $result->test_status_details
        ];

        self::update_data();
        $this->dispatchBrowserEvent('openModal','uniqueCetResultModal');
        
    }
}
