<?php

namespace App\Http\Livewire\Authentication;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Livewire\Component;


use Mail;

class RegisterEmail extends Component
{
    public $title;
    public $active;

    public $error;
    public $email_send;
    public $validated_code;
    public $code;
    public $sign_up;

    public $style;
    public $sign_up_button;

    public $email;
    public $username;
    public $firstname;
    public $middlename;
    public $lastname;
    public $suffix;
    public $password;
    public $confirm_password;
    public $birthdate;

    public function mount(){
        $this->title = 'Register';
        $this->active = 'Register';
        $this->email_send = true;
        $this->sign_up = false;

        $this->style = 'red';
        $this->sign_up_button = 'Sign up';
    }

    protected $rules = [
        'email' => 'required|email',
    ];

    public function render()
    {
        return view('livewire.authentication.register-email')->layout('layouts.guest',['title'=>$this->title]);
    }

    public function send_verification_code(Request $request){
        $data = $request->session()->all();
        if(!isset($data['user_id'])){            
            $this->validate();
            if(DB::table('users')
                ->where('user_email', $this->email)
                ->where('user_email_verified', 1)
                ->first()){
    
                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'icon'              									=> 'danger',
                    'title'             									=> 'User Exist!',
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '1000',
                    'link'              									=> '#'
                ]);
            }else{
                // send code
                $this->email_send = false;
                $code = rand(100000,1000000);
                Mail::send('mail.code-verification-email', [
                        'code'=>$code,
                        'email'=>$this->email], 
                        function($message) {
                    $message->to($this->email, $this->email)->subject
                       ('Account Verification');
                    $message->from('wmsutec@wmsutec.online','WMSU TESTING AND EVALUATION CENTER');
                 });
                $deleted = DB::table('user_activations')
                    ->where('user_activation_email', '=', $this->email)
                    ->delete();
                DB::table('user_activations')->insert([
                    'user_activation_email' => $this->email,
                    'user_activation_code' => $code,
                    'user_activation_count' => 0
                ]);
                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'icon'              									=> 'success',
                    'title'             									=> 'Code has been sent to your email address!',
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '2000',
                    'link'              									=> '#'
                ]);
                $this->error ="";
            }
        }
    }

    public function verify_code(Request $request){
        $data = $request->session()->all();
        if(!isset($data['user_id'])){ 
            $this->validate();
            $activation_details = DB::table('user_activations')
                ->select('user_activation_id', 'user_activation_email', 'user_activation_code','user_activation_count','date_created', 'date_updated',DB::raw('NOW() as time_now'))
                ->where('user_activation_email',$this->email)
                ->first();
            // // check how long
        
            if(1){
                if($activation_details && $activation_details->user_activation_code == $this->code){
                    if($activation_details->user_activation_count<=4){
                            // save into session
                            $request->session()->put('user_email', $this->email);
                            $request->session()->put('sign_up', true);
                            $this->sign_up = true;
                    }else{
                        $this->dispatchBrowserEvent('swal:redirect',[
                            'position'          									=> 'center',
                            'icon'              									=> 'warning',
                            'title'             									=> 'Too many tries, code expires!',
                            'showConfirmButton' 									=> 'true',
                            'timer'             									=> '1000',
                            'link'              									=> '#'
                        ]);
                        $deleted = DB::table('user_activations')
                        ->where('user_activation_email', '=', $this->email)
                        ->delete();
                        $this->email_send =true;
                    }
                    
                }else{
                    if($activation_details && $activation_details->user_activation_count<4){
                        $this->dispatchBrowserEvent('swal:redirect',[
                            'position'          									=> 'center',
                            'icon'              									=> 'warning',
                            'title'             									=> 'Invalid code, you have '.(5-$activation_details->user_activation_count-1).' tries!',
                            'showConfirmButton' 									=> 'true',
                            'timer'             									=> '1000',
                            'link'              									=> '#'
                        ]);
                        $updated = DB::table('user_activations')
                        ->where('user_activation_id', $activation_details->user_activation_id)
                        ->update(['user_activation_count' =>  $activation_details->user_activation_count+1]);
                    }else{
                        $this->dispatchBrowserEvent('swal:redirect',[
                            'position'          									=> 'center',
                            'icon'              									=> 'warning',
                            'title'             									=> 'Too many tries, code expires!',
                            'showConfirmButton' 									=> 'true',
                            'timer'             									=> '1000',
                            'link'              									=> '#'
                        ]);
                        $deleted = DB::table('user_activations')
                        ->where('user_activation_email', '=', $this->email)
                        ->delete();
                        $this->email_send =true;
                    }
                } 
            }else{
                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'icon'              									=> 'warning',
                    'title'             									=> 'Code expires!',
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '1000',
                    'link'              									=> '#'
                ]);
                $deleted = DB::table('user_activations')
                    ->where('user_activation_email', '=', $this->email)
                    ->delete();
                $this->email_send =true;
            }         
        }
    }
    public function verify_username(Request $request){
        $data = $request->session()->all();
        if(!isset($data['user_id'])){ 
            if(isset($data['sign_up']) && $data['sign_up'] && isset($data['user_email']) && $data['user_email'] == $this->email){
                // validate username
                // check users db if username is taken
                if (preg_match('/^[A-Za-z]{1}[A-Za-z0-9]{5,31}$/', $this->username)
                    && !DB::table('users')
                    ->where('user_name', $this->username)
                    ->where('user_name_verified', 1)
                    ->first()){
                    // save into session
                    $request->session()->put('user_name', $this->username);
                    $this->style = 'green';
                    $this->sign_up_button = 'Sign up';
                }else{
                    $this->style = 'red';
                    $this->sign_up_button ='Invalid Username';
                }                
            }
        }
    }

    public function verify_password(Request $request){
        $data = $request->session()->all();
        if(isset($data['sign_up']) && $data['sign_up'] && isset($data['user_email']) && $data['user_email'] == $this->email){
            if(strlen($this->password) < 8 ) {
                $this->sign_up_button = 'Password must be >= 8';
                return false;
            }
            elseif(!preg_match("#[0-9]+#",$this->password)) {
                $this->sign_up_button = 'Password must have number';
                return false;
            }
            elseif(!preg_match("#[A-Z]+#",$this->password)) {
                $this->sign_up_button = 'Password must have upper case';
                return false;
            }
            elseif(!preg_match("#[a-z]+#",$this->password)) {
                $this->sign_up_button = 'Password must have lower case';
                return false;
            }
            // good password
            $this->sign_up_button = 'Sign up';
            $request->session()->put('user_password', $this->password);
            return true; 
        }
        
    }
    public function verify_confirm_password(Request $request){
        $data = $request->session()->all();
        if(isset($data['sign_up']) && $data['sign_up'] && isset($data['user_email']) && $data['user_email'] == $this->email){
            if(strlen($this->confirm_password) < 8 ) {
                $this->sign_up_button = 'Confirm password must be >= 8';
                return false;
            }
            elseif(!preg_match("#[0-9]+#",$this->confirm_password)) {
                $this->sign_up_button = 'Confirm password must have number';
                return false;
            }
            elseif(!preg_match("#[A-Z]+#",$this->confirm_password)) {
                $this->sign_up_button = 'Confirm password must have upper case';
                return false;
            }
            elseif(!preg_match("#[a-z]+#",$this->confirm_password)) {
                $this->sign_up_button = 'Confirm password must have lower case';
                return false;
            }
            // good password
            if($this->password == $this->confirm_password){
                $this->sign_up_button = 'Sign up';
                $request->session()->put('user_confirm_password', $this->confirm_password);
            }else{
                $this->sign_up_button = 'Password doesn\'t match';
            }
            return true; 
        }
    }
    public function verify_birthdate(Request $request){
        $data = $request->session()->all();
        if(isset($data['sign_up']) && $data['sign_up'] && isset($data['user_email']) && $data['user_email'] == $this->email){
            $min_age = 15;
            $min_date = $min_age * 366;
            $diff= date_diff(date_create($this->birthdate),date_create(date('Y-m-d', time())));
            $date_diff =  intval($diff->format("%R%a"));
            if($date_diff>$min_date){
                $this->sign_up_button = 'Sign up';
                $request->session()->put('user_birthdate', $this->birthdate);
            }else{
                $this->sign_up_button = 'You must be at least '.$min_age.' y/o';
            }
        }
    }
    public function sign_up(Request $request){
        // validate all
        $data = $request->session()->all();
        if(isset($data['sign_up']) && $data['sign_up'] && isset($data['user_email']) && $data['user_email'] == $this->email){
            $this->firstname =(trim($this->firstname));
            $this->lastname =(trim($this->lastname));
            $this->middlename =(trim($this->middlename));
            $this->suffix =(trim($this->suffix));

            if (preg_match('/^[A-Za-z]{1}[A-Za-z0-9]{5,31}$/', $this->username)
                && !DB::table('users')
                ->where('user_name', $this->username)
                ->where('user_name_verified', 1)
                ->first()){
                // save into session
                $request->session()->put('user_name', $this->username);
                $this->style = 'green';
                $this->sign_up_button = 'Sign up';
            }else{
                $this->style = 'red';
                $this->sign_up_button ='Invalid Username';
                return;
            }     
            
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

            // validate email
            $this->validate();
            if(DB::table('users')
            ->where('user_email', $this->email)
            ->where('user_email_verified', 1)
            ->first()){
                return false;
            }
            
            // validate username
            if (!preg_match('/^[A-Za-z]{1}[A-Za-z0-9]{5,31}$/', $this->username)
                    && DB::table('users')
                    ->where('user_name', $this->username)
                    ->where('user_name_verified', 1)
                    ->first()){
                return false;
            }

            if(strlen($this->confirm_password) < 8 ) {
                $this->sign_up_button = 'Confirm password must be >= 8';
                return false;
            }
            elseif(!preg_match("#[0-9]+#",$this->confirm_password)) {
                $this->sign_up_button = 'Confirm password must have number';
                return false;
            }
            elseif(!preg_match("#[A-Z]+#",$this->confirm_password)) {
                $this->sign_up_button = 'Confirm password must have upper case';
                return false;
            }
            elseif(!preg_match("#[a-z]+#",$this->confirm_password)) {
                $this->sign_up_button = 'Confirm password must have lower case';
                return false;
            }
            if($this->password != $this->confirm_password){
                $this->sign_up_button = 'Password doesn\'t match';
                return false;
            }
            $min_age = 15;
            $min_date = $min_age * 366;
            $diff= date_diff(date_create($this->birthdate),date_create(date('Y-m-d', time())));
            $date_diff =  intval($diff->format("%R%a"));
            if(!$date_diff>$min_date){
                $this->sign_up_button = 'You must be at least '.$min_age.' y/o';
                return false;
            }
            // hash password
            $this->password = password_hash($this->password, PASSWORD_ARGON2I);
            // insert data
            if(DB::table('users')->insert([
                'user_status_id' => 1,
                'user_sex_id' => 1,
                'user_gender_id' => 1,
                'user_role_id' => 1,
                'user_name' => $data['user_name'],
                'user_email' => $data['user_email'],
                'user_phone' => NULL,
                'user_password' => $this->password ,
                'user_name_verified' => 1,
                'user_email_verified' => 1,
                'user_phone_verified' => 0,
                'user_firstname' => $this->firstname,
                'user_middlename' => $this->middlename,
                'user_lastname' => $this->lastname,
                'user_suffix' => $this->suffix,
                'user_citizenship'  => NULL,

                'user_addr_street'  => NULL,
                'user_addr_brgy'  => NULL,
                'user_addr_city_mun'  => NULL,
                'user_addr_province' => NULL,
                'user_addr_zip_code'  => NULL,
                'user_birthdate' => $this->birthdate,
               
            ])){
                // get data 
                $user_details = DB::table('users as u')
                    ->join('user_status as us', 'u.user_status_id', '=', 'us.user_status_id')
                    ->join('user_sex as usex', 'u.user_sex_id', '=', 'usex.user_sex_id')
                    ->join('user_genders as ug', 'u.user_gender_id', '=', 'ug.user_gender_id')
                    ->join('user_roles as ur', 'u.user_role_id', '=', 'ur.user_role_id')
                    ->where('u.user_email', $this->email)
                    ->where('u.user_email_verified', 1)
                    ->first();


                $request->session()->regenerate();

                $request->session()->put('user_id', $user_details->user_id);
                
                //append it to session
                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'icon'              									=> 'success',
                    'title'             									=> 'Successfully signed up!',
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '1500',
                    'link'              									=> 'student/profile'
                ]);
            }else{
                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'icon'              									=> 'warning',
                    'title'             									=> 'Unable to sign up!',
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '2000',
                    'link'              									=> '#'
                ]);
            }

            
        }
    }
}
