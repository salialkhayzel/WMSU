<?php

namespace App\Http\Livewire\Components\Navigation;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class StudentTestNav2 extends Component
{
    public $user_details;
    public function booted(Request $request){
        $this->user_details = $request->session()->all();
        if(!isset($this->user_details['user_id'])){
            return redirect('/login');
        }else{
            $user_status = DB::table('users as u')
            ->select('u.user_status_id','us.user_status_details','user_profile_picture')
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
    public function mount(Request $request){
        $this->user_details = $request->session()->all();
        $this->title = 'amin-management';
    }
    
    public function render()
    {
        return view('livewire.components.navigation.student-test-nav2');
    }
    public function undergrad(Request $request){

        $this->user_details = $request->session()->all();
        if(!isset($this->user_details['user_id'])){
            return redirect('/login');
        }
        if(isset($this->user_details['user_status_details']) && $this->user_details['user_status_details'] == 'deleted' ){
            return redirect('/deleted');
        }
        if(isset($this->user_details['user_status_details']) && $this->user_details['user_status_details'] == 'inactive' ){
            return redirect('/inactive');
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
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'You have already applied! <br> redirecting to aplication status',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '/student/status'
            ]);
        }else{
            return redirect()->route('student.cet.undergrad');

        }
    }
    public function grad(Request $request){
        $this->user_details = $request->session()->all();
        if(!isset($this->user_details['user_id'])){
            return redirect('/login');
        }
        if(isset($this->user_details['user_status_details']) && $this->user_details['user_status_details'] == 'deleted' ){
            return redirect('/deleted');
        }
        if(isset($this->user_details['user_status_details']) && $this->user_details['user_status_details'] == 'inactive' ){
            return redirect('/inactive');
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
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'You have already applied! <br> redirecting to aplication status',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '/student/status'
            ]);
        }else{
            return redirect()->route('student.cet.Grad');
        }
    }
    public function shiftee_tranferee(Request $request){
        $this->user_details = $request->session()->all();
        if(!isset($this->user_details['user_id'])){
            return redirect('/login');
        }
        if(isset($this->user_details['user_status_details']) && $this->user_details['user_status_details'] == 'deleted' ){
            return redirect('/deleted');
        }
        if(isset($this->user_details['user_status_details']) && $this->user_details['user_status_details'] == 'inactive' ){
            return redirect('/inactive');
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
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'You have already applied! <br> redirecting to aplication status',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '/student/status'
            ]);
        }else{
            return redirect()->route('student.cet.shiftee');

        }
    }
}
