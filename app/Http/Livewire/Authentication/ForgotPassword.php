<?php

namespace App\Http\Livewire\Authentication;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use Mail;

class ForgotPassword extends Component
{
    public $title;
    public $active;

    public $email;
    public $email_send;

    public function mount(){
        $this->title = 'Account Recovery';
        $this->active = 'Account Recovery';
        $email_send = true;  
    }

    protected $rules = [
        'email' => 'required|email',
    ];
    public function render()
    {
        return view('livewire.authentication.forgot-password')->layout('layouts.guest',['title'=>$this->title]);
    }
    public function recover_account(Request $request){
        $data = $request->session()->all();
        $this->validate();
        if(!isset($data['user_id'])){            
            $this->validate();
            if($user_details = DB::table('users')
                ->where('user_email', $this->email)
                ->where('user_email_verified', 1)
                ->first()){
                
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $randomString = '';
                $n = 20;
                for ($i = 0; $i < $n; $i++) {
                    $index = rand(0, strlen($characters) - 1);
                    $randomString .= $characters[$index];
                }
                $hash = md5($randomString);
                while(DB::table('user_forgot_passwords')
                ->where('user_forgot_password_hash', $hash)
                ->first()){
                    for ($i = 0; $i < $n; $i++) {
                        $index = rand(0, strlen($characters) - 1);
                        $randomString .= $characters[$index];
                    }
                    $hash = md5($hash);
                }
                Mail::send('mail.forgot-password-recovery', [
                        'hash'=>$hash,
                        'email'=>$this->email], 
                        function($message) {
                    $message->to($this->email, $this->email)->subject
                       ('Account Recovery');
                    $message->from('xyz@gmail.com','WMSU TESTING AND EVALUATION CENTER');
                });
                $deleted = DB::table('user_forgot_passwords')
                    ->where('user_forgot_password_email', '=', $this->email)
                    ->delete();
                DB::table('user_forgot_passwords')->insert([
                    'user_forgot_password_email' => $this->email,
                    'user_forgot_password_hash' => $hash,
                ]);
                $request->session()->put('user_email', $this->email);
                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'icon'              									=> 'success',
                    'title'             									=> 'Link has been emailed!',
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '1500',
                    'link'              									=> '#'
                ]);
            }else{
                sleep(5);
                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'icon'              									=> 'success',
                    'title'             									=> 'Link has been emailed!',
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '1500',
                    'link'              									=> '#'
                ]);
            }
        }
    }
}
