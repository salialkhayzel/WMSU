<?php

namespace App\Http\Livewire\Admin;

// use Livewire\WithPagination;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Mail;

class ApplicationManagement3 extends Component
{
    // use WithPagination;
    
    public $mail = true;

    public $user_detais;
    public $title;

    // table filter
    public $pending_applicant_filter;

    public $selected_all;
    public $selected = [];

    // pagination
    public $per_page = 2;
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

    // data

    public $pending_applicant_data;
    public $exam_types;

    public $pending_test_type_id = 0;
    public $column_order = 't_a_id';
    public $order_by = 'asc';
    public $access_role ;



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
        if(1){
            
       
            
            $this->exam_types = DB::table('test_types')
                ->select('test_type_id','test_type_name')
                ->get()
                ->toArray();

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
                // ->where()
                ->orderBy('ta.'.$this->column_order, $this->order_by)
                ->limit($this->per_page)
                ->get()
                ->toArray();


           
            
        }else{
            $this->redirect('/admin/dashboard');
        }
    }
    public function mount(Request $request){
        $this->user_details = $request->session()->all();
        $this->title = 'application-management';

        // accessrole read
        if(1){
            $this->pending_applicant_filter = [
                'Select all' => true,
                '#' => true,
                'Code' => true,
                'Applicant name'=> true,
                'Exam type'=> true,
                'Date applied'	=> true,								
                'Actions'	=> true					
            ];
            $this->selected_all = false;

            $this->access_role = [
                'C' => true,
                'R' => true,
                'U' => true,
                'D' => true
            ];
       

            $this->exam_types = DB::table('test_types')
                ->select('test_type_id','test_type_name')
                ->get()
                ->toArray();

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
                ->paginate(2)
                // ->cursorPaginate(2)
                // ->get()
                
                ;
                dd( $this->pending_applicant_data->links() );

                foreach ($this->pending_applicant_data['data'] as $key => $value) {
                    array_push($this->selected,[$value->t_a_id=>false]);
                }


            // pagination
            {
                $this->cursor = 0;
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

                $next_page_arr =[];

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
                // dd($this->next_pages);
                
                // dd($this->next_page_count);
                

                $this->item_current = $this->cursor ;
            

                $this->item_last = DB::table('test_applications as ta')
                ->select(
                    // '*',
                    't_a_id'
                    )
                ->where('t_a_isactive','=',1)
                ->orderBy('ta.'.$this->column_order, $this->order_by)
                ->first()->t_a_id;
            }
            
            
        }else{
            $this->redirect('/admin/dashboard');
        }
        
    }

    public function render(){
        

        return view('livewire.admin.application-management',[
            'user_details' => $this->user_details
            ])
            ->layout('layouts.admin',[
                'title'=>$this->title]);
    }

    public function pending_applicant_filterView(Request $request){
        $this->user_details = $request->session()->all();
        if(1){
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
                // ->where()
                ->orderBy('ta.'.$this->column_order, $this->order_by)
                ->limit($this->per_page)
                ->get()
                ->toArray();

        }else{
            $this->redirect('/admin/dashboard');
        }
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
        
        $this->selected_all = !$this->selected_all ;
        if($this->selected_all){
            $this->selected=[];
            foreach ($this->pending_applicant_data as $key => $value) {
                array_push($this->selected,[$value->t_a_id=>true]);
            }
        }else{
            $this->selected=[];
            foreach ($this->pending_applicant_data as $key => $value) {
                array_push($this->selected,[$value->t_a_id=>false]);
            }
        }
 
    }

   
    public function pending_application_exam_type_filter(){
        
        if($this->pending_test_type_id == 0){
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
                ->where('ta.t_a_isactive','=',1)
                ->orderBy('ta.'.$this->column_order, $this->order_by)
                ->limit($this->per_page)
                ->get()
                ->toArray();
        }else{
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
                ->where('ta.t_a_isactive','=',1)
                ->where(['ta.t_a_test_type_id'=> $this->pending_test_type_id])
                ->orderBy('ta.'.$this->column_order, $this->order_by)
                ->limit($this->per_page)
                ->get()
                ->toArray();
                
        }
        // dd( $this->pending_applicant_data );

    }   

    public function accepted(){

        $this->dispatchBrowserEvent('swal:redirect',[
            'position'          									=> 'center',
            'icon'              									=> 'success',
            'title'             									=> 'Accepted!',
            'showConfirmButton' 									=> 'true',
            'timer'             									=> '1500',
            'link'              									=> '#'
         ]);
         
         if($this->selected_all){
            dd($this->selected);
        }else{
            dd($this->selected);
        }
        
        
    }
    public function declined(){
        $this->dispatchBrowserEvent('swal:redirect',[
            'position'          									=> 'center',
            'icon'              									=> 'success',
            'title'             									=> 'Declined!',
            'showConfirmButton' 									=> 'true',
            'timer'             									=> '1500',
            'link'              									=> '#'
         ]);
        
 
    }

    public function search_applicant(){
        // last
        dd('nice');
    }





    

   


}
