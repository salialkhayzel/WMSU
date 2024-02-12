<?php

namespace App\Http\Livewire\Authentication;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AccountRecovery extends Component
{
    public $title;
    public $active;

    public $hash;
    public $valid;
    public $recover_button;

    public $password;
    public $confirm_password;

    public function mount(Request $request,$hash){
        $this->title = 'Account Recovery';
        $this->active = 'Account Recovery';
        $data = $request->session()->all();
        $this->$hash = $hash;
        $this->recover_button = 'Change Password';
        if(isset($data['user_email']) && $user_forgot_password_details = DB::table('user_forgot_passwords')
            ->select('user_forgot_password_id','user_forgot_password_hash', 'user_forgot_password_email','date_created','date_updated',DB::raw('NOW() as time_now'))
            ->where('user_forgot_password_hash', $this->$hash)
            ->where('user_forgot_password_email', $data['user_email'])
            ->first()
            ){
            // check how long is the 

            $time_created = strtotime($user_forgot_password_details->date_created);
            $time_now = strtotime($user_forgot_password_details->time_now);
            $diff = ($time_now - $time_created)/60;
            $max_time_in_minutes = 15;
            if($diff < $max_time_in_minutes){
                $this->valid = true;
                $request->session()->put('user_email', $user_forgot_password_details->user_forgot_password_email);
                $request->session()->put('user_hash', $user_forgot_password_details->user_forgot_password_hash);
            }else{
                $this->valid = false;
                $deleted = DB::table('user_forgot_passwords')
                    ->where('user_forgot_password_email', '=', $data['user_email'])
                    ->delete();
            }
        }else{
            $this->valid = false;
        }
        
    }
    public function render()
    {
        if($this->valid ){
            return view('livewire.authentication.account-recovery
            ')->layout('layouts.guest',[
                'title'=>$this->title]);
        }else{
            return view('livewire.authentication.account-recovery',[
            ])
            ->layout('layouts.account-disabled',[
                'title'=>$this->title]);
        }
        
    }

    public function verify_password(Request $request){
        $data = $request->session()->all();
        if(!isset($data['user_id']) && $user_forgot_password_details = DB::table('user_forgot_passwords')
            ->select('user_forgot_password_id','user_forgot_password_hash', 'user_forgot_password_email','date_created','date_updated',DB::raw('NOW() as time_now'))
            ->where('user_forgot_password_hash', $data['user_hash'])
            ->where('user_forgot_password_email', $data['user_email'])
            ->first()){
            $time_created = strtotime($user_forgot_password_details->date_created);
            $time_now = strtotime($user_forgot_password_details->time_now);
            $diff = ($time_now - $time_created)/60;
            $max_time_in_minutes = 15;
            if($diff < $max_time_in_minutes){
                if(strlen($this->password) < 8 ) {
                    $this->recover_button = 'Password must be >= 8';
                    return false;
                }
                elseif(!preg_match("#[0-9]+#",$this->password)) {
                    $this->recover_button = 'Password must have number';
                    return false;
                }
                elseif(!preg_match("#[A-Z]+#",$this->password)) {
                    $this->recover_button = 'Password must have upper case';
                    return false;
                }
                elseif(!preg_match("#[a-z]+#",$this->password)) {
                    $this->recover_button = 'Password must have lower case';
                    return false;
                }
                // good password
                $this->recover_button = 'Change Password';
                $request->session()->put('user_password', $this->password);
                return true; 
            }else{
                $this->valid = false;
                $deleted = DB::table('user_forgot_passwords')
                    ->where('user_forgot_password_email', '=', $data['user_email'])
                    ->delete();
                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'icon'              									=> 'success',
                    'title'             									=> 'Invalid token!',
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '2000',
                    'link'              									=> '/login'
                ]);      
            }
        }else{
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Invalid token!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '2000',
                'link'              									=> '/login'
            ]);   
        }
        
    }
    public function verify_confirm_password(Request $request){
        $data = $request->session()->all();
        if(!isset($data['user_id']) && $user_forgot_password_details = DB::table('user_forgot_passwords')
            ->select('user_forgot_password_id','user_forgot_password_hash', 'user_forgot_password_email','date_created','date_updated',DB::raw('NOW() as time_now'))
            ->where('user_forgot_password_hash', $data['user_hash'])
            ->where('user_forgot_password_email', $data['user_email'])
            ->first()){
            $time_created = strtotime($user_forgot_password_details->date_created);
            $time_now = strtotime($user_forgot_password_details->time_now);
            $diff = ($time_now - $time_created)/60;
            $max_time_in_minutes = 15;
            if($diff < $max_time_in_minutes){
                if(strlen($this->confirm_password) < 8 ) {
                    $this->recover_button = 'Confirm password must be >= 8';
                    return false;
                }
                elseif(!preg_match("#[0-9]+#",$this->confirm_password)) {
                    $this->recover_button = 'Confirm password must have number';
                    return false;
                }
                elseif(!preg_match("#[A-Z]+#",$this->confirm_password)) {
                    $this->recover_button = 'Confirm password must have upper case';
                    return false;
                }
                elseif(!preg_match("#[a-z]+#",$this->confirm_password)) {
                    $this->recover_button = 'Confirm password must have lower case';
                    return false;
                }
                // good password
                if($this->password == $this->confirm_password){
                    $this->recover_button = 'Change Password';
                    $request->session()->put('user_confirm_password', $this->confirm_password);
                }else{
                    $this->recover_button = 'Password doesn\'t match';
                }
                return true; 
            }else{
                $this->valid = false;
                $deleted = DB::table('user_forgot_passwords')
                    ->where('user_forgot_password_email', '=', $data['user_email'])
                    ->delete();
                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'icon'              									=> 'warning',
                    'title'             									=> 'Invalid token!',
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '2000',
                    'link'              									=> '/login'
                ]);      
            }
        }else{
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Invalid token!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '2000',
                'link'              									=> '/login'
            ]);   
        }
    }
    public function change_password(Request $request){
        $data = $request->session()->all();
        if(!isset($data['user_id']) && $user_forgot_password_details = DB::table('user_forgot_passwords')
            ->select('user_forgot_password_id','user_forgot_password_hash', 'user_forgot_password_email','date_created','date_updated',DB::raw('NOW() as time_now'))
            ->where('user_forgot_password_hash', $data['user_hash'])
            ->where('user_forgot_password_email', $data['user_email'])
            ->first()
            ){
            $time_created = strtotime($user_forgot_password_details->date_created);
            $time_now = strtotime($user_forgot_password_details->time_now);
            $diff = ($time_now - $time_created)/60;
            $max_time_in_minutes = 15;
            if($diff < $max_time_in_minutes){
                if(strlen($this->confirm_password) < 8 ) {
                    $this->recover_button = 'Confirm password must be >= 8';
                    return false;
                }
                elseif(!preg_match("#[0-9]+#",$this->confirm_password)) {
                    $this->recover_button = 'Confirm password must have number';
                    return false;
                }
                elseif(!preg_match("#[A-Z]+#",$this->confirm_password)) {
                    $this->recover_button = 'Confirm password must have upper case';
                    return false;
                }
                elseif(!preg_match("#[a-z]+#",$this->confirm_password)) {
                    $this->recover_button = 'Confirm password must have lower case';
                    return false;
                }
                if($this->password != $this->confirm_password){
                    return false;
                }
                $user_details =DB::table('users as u')
                ->join('user_status as us', 'u.user_status_id', '=', 'us.user_status_id')
                ->join('user_sex as usex', 'u.user_sex_id', '=', 'usex.user_sex_id')
                ->join('user_genders as ug', 'u.user_gender_id', '=', 'ug.user_gender_id')
                ->join('user_roles as ur', 'u.user_role_id', '=', 'ur.user_role_id')
                ->where(['u.user_email'=> $data['user_email'],'u.user_email_verified'=> 1])
                ->first();
               
                if(password_verify($this->password,$user_details->user_password)){
                    $this->dispatchBrowserEvent('swal:redirect',[
                        'position'          									=> 'center',
                        'icon'              									=> 'warning',
                        'title'             									=> 'Password should not be the same as your old password!',
                        'showConfirmButton' 									=> 'true',
                        'timer'             									=> '2000',
                        'link'              									=> '#'
                    ]);
                }else{
                    $this->password = password_hash($this->password, PASSWORD_ARGON2I);
                    if(DB::table('users')
                    ->where('user_id', $user_details->user_id)
                    ->update(['user_password' => $this->password])){
                        $deleted = DB::table('user_forgot_passwords')
                        ->where('user_forgot_password_email', '=', $data['user_email'])
                        ->delete();
                    }
                    $this->dispatchBrowserEvent('swal:redirect',[
                        'position'          									=> 'center',
                        'icon'              									=> 'success',
                        'title'             									=> 'Successfully changed your password!',
                        'showConfirmButton' 									=> 'true',
                        'timer'             									=> '2000',
                        'link'              									=> '/login'
                    ]);
                }
            }else{
                $this->valid = false;
                $deleted = DB::table('user_forgot_passwords')
                    ->where('user_forgot_password_email', '=', $data['user_email'])
                    ->delete();
                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'icon'              									=> 'warning',
                    'title'             									=> 'Invalid token!',
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '2000',
                    'link'              									=> '/login'
                ]);   
            }
        }else{
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Invalid token!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '2000',
                'link'              									=> '/login'
            ]);   
        }
    }
}
