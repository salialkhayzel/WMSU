<?php

namespace App\Http\Livewire\Authentication;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use Mail;

class ChangeEmail extends Component
{
    public $valid = false;
    public $title;

    protected $rules = [
        'email' => 'required|email',
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

    public function mount(Request $request){
        $this->title = 'Change Email';
        $user_details = $request->session()->all();
        
        $user_details = DB::table('users')
            ->where('user_id','=',$user_details['user_id'])
            ->get()
            ->first();
        $this->user_details = [
            "user_id" => $user_details->user_id,
            "user_status_id"=> $user_details->user_status_id,
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
            "user_citizenship"=> $user_details->user_citizenship,
            "user_addr_street"=> $user_details->user_addr_street,
            "user_addr_brgy"=> $user_details->user_addr_brgy,
            "user_addr_city_mun"=> $user_details->user_addr_city_mun,
            "user_addr_province"=> $user_details->user_addr_province,
            "user_addr_zip_code"=> $user_details->user_addr_zip_code,
            "user_birthdate"=> $user_details->user_birthdate,
            "user_profile_picture"=> $user_details->user_profile_picture,
            "user_formal_id"=> $user_details->user_formal_id,
            "user_code"=> NULL,
            "date_created"=> $user_details->date_created,
            "date_updated"=> $user_details->date_updated,
        ];
        if($this->user_details['user_email_verified']==1){
            $this->user_details['user_email']= null;
        }



    }
    public function render()
    {
        return view('livewire.authentication.change-email
        ')->layout('layouts.guest',[
            'title'=>$this->title]);
        
    }
    public function change_email(){
        if (filter_var($this->user_details['user_email'], FILTER_VALIDATE_EMAIL)) {
            if(DB::table('users')
            ->where('user_email',$this->user_details['user_email'])
            ->where('user_email_verified', 1)
            ->first()){
                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'icon'              									=> 'warning',
                    'title'             									=> 'Email address is used!',
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '2000',
                    'link'              									=> '#'
                ]);
            }else{
                $code = rand(100000,1000000);
                Mail::send('mail.code-verification-email', [
                        'code'=>$code,
                        'email'=>$this->user_details['user_email']], 
                        function($message) {
                    $message->to($this->user_details['user_email'], $this->user_details['user_email'])->subject
                        ('Account Verification');
                    $message->from('wmsutec@wmsutec.online','WMSU TESTING AND EVALUATION CENTER');
                    });
                $deleted = DB::table('user_activations')
                    ->where('user_activation_email', '=', $this->user_details['user_email'])
                    ->delete();
                DB::table('user_activations')->insert([
                    'user_activation_email' => $this->user_details['user_email'],
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
                $this->valid = true;
            }
           
        }else{
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Please enter a valid Email!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1000',
                'link'              									=> '#'
            ]);
        }
    }
    public function verify_code(Request $request){
        $user_details = $request->session()->all();
        $user_details = DB::table('users')
        ->where('user_id','=',$user_details['user_id'])
        ->get()
        ->first();
        
        if(isset( $user_details->user_id)){ 
            // $this->validate();
            $activation_details = DB::table('user_activations')
                ->select('user_activation_id', 'user_activation_email', 'user_activation_code','user_activation_count','date_created', 'date_updated',DB::raw('NOW() as time_now'))
                ->where('user_activation_email',  $this->user_details['user_email'])
                ->first();
            // // check how long
            if(1){
                if($activation_details && $activation_details->user_activation_code == $this->user_details['user_code']){
                    if($activation_details->user_activation_count<=4){
                            // save into session
                            
                            DB::table('users')
                                ->where('user_id','=',$user_details->user_id)
                                ->update([
                                    'user_email'=> $this->user_details['user_email'],
                                    'user_email_verified'=>1
                                ]);
                            $deleted = DB::table('user_activations')
                            ->where('user_activation_email', '=',  $this->user_details['user_email'])
                            ->delete();
                            $this->valid = false;

                            $this->dispatchBrowserEvent('swal:redirect',[
                                'position'          									=> 'center',
                                'icon'              									=> 'success',
                                'title'             									=> 'Successfully updated your email!',
                                'showConfirmButton' 									=> 'true',
                                'timer'             									=> '1000',
                                'link'              									=> 'admin/profile'
                            ]);
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
                        ->where('user_activation_email', '=',  $this->user_details['user_email'])
                        ->delete();
                        $this->valid = false;
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
                        ->where('user_activation_email', '=',   $this->user_details['user_email'])
                        ->delete();
                        $this->valid = false;
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
                    ->where('user_activation_email', '=',   $this->user_details['user_email'])
                    ->delete();
                    $this->valid = false;
            }         
        }
    }
}
