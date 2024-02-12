<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Mail;

class ChatSupport extends Component
{
    
    public $mail = true;
    

    public $chat_content;
    public $user_details;
    public $chat_box =[];
    public $chat_content_details;
    public $chat_box_list;
    public $admin_chat_details;
    
    
    public function booted(Request $request){
        $this->user_details = $request->session()->all();
        if(!isset($this->user_details['user_id'])){
            header("Location: /login");
            die();
        }else{
            $user_status = DB::table('users as u')
            ->select('u.user_status_id','us.user_status_details')
            ->join('user_status as us', 'u.user_status_id', '=', 'us.user_status_id')
            ->where('user_id','=', $this->user_details['user_id'])
            ->first();
        }

        if(isset($user_status->user_status_details) && $user_status->user_status_details == 'deleted' ){
            header("Location: /deleted");
            die();
        }

        if(isset($user_status->user_status_details) && $user_status->user_status_details == 'inactive' ){
            header("Location: /inactive");
            die();
        }
    }
    public function hydrate(){
        self::update_data();
    }
    public function update_data(){
  
        $this->chat_box_list =DB::table('chat_box as cb')
            ->select(
                // '*',
                'cbc_user_id',
                'u.user_firstname',
                'u.user_middlename',
                'u.user_lastname',
                'u.user_firstname',
                'u.user_profile_picture',
                'cbc.cbc_chat_content',
                'cbc.cbc_chat_box_id',
                DB::raw('TIME_FORMAT(cbc.date_created, "%h:%i %p") as date_created')
                )
            ->join('chat_box_contents as cbc','cbc.cbc_id','cb.chat_box_cbc_id')
            ->join('users as u','u.user_id','cbc_user_id')
            ->orderBy('cb.date_updated','desc')
            ->get()
            ->toArray();

        // dd($this->chat_box_list);
        
    }
    public function mount(Request $request){
        $this->user_details = $request->session()->all();
        $this->title = 'chat support';
        $this->chat_box =[
            'chat_box_id' => NULL,
            'chat_box_admin' => NULL,
            'chat_box_status_id' => NULL,
            'chat_box_user_sender' =>NULL,
            'chat_box_user_receiver' => NULL,
            'user_firstname' => NULL,
            'user_middlename' => NULL,
            'user_lastname' => NULL,
            'user_firstname' => NULL,
            'user_profile_picture' => NULL,
            
        ];

        $this->chat_content = [];
        self::update_data();
    }

    public function chat_box_selected($chat_box_id){
        $this->chat_box = DB::table('chat_box')
            ->select(
                'chat_box_id',
                'chat_box_admin',
                'chat_box_status_id',
                'chat_box_user_sender',
                'chat_box_user_receiver',
                'user_firstname',
                'user_middlename',
                'user_lastname',
                'user_firstname',
                'user_profile_picture',
                )
        ->join('users as u','u.user_id','chat_box_user_sender')
        ->where('chat_box_id','=',$chat_box_id)
        ->first();
        // $this->chat_box = null;
        // dd($this->chat_box);
        if($this->chat_box){
            $this->chat_box =[
                'chat_box_id' => $this->chat_box->chat_box_id,
                'chat_box_admin' => $this->chat_box->chat_box_id,
                'chat_box_status_id' => $this->chat_box->chat_box_status_id,
                'chat_box_user_sender' => $this->chat_box->chat_box_user_sender,
                'chat_box_user_receiver' => $this->chat_box->chat_box_user_receiver,
                'user_firstname' => $this->chat_box->user_firstname,
                'user_middlename' => $this->chat_box->user_middlename,
                'user_lastname' => $this->chat_box->user_lastname,
                'user_firstname' => $this->chat_box->user_firstname,
                'user_profile_picture' => $this->chat_box->user_profile_picture,
            ];

            if($this->chat_box){
                $this->chat_content = DB::table('chat_box_contents as cbc')
                    ->where('cbc_chat_box_id','=',$this->chat_box['chat_box_id'])
                    ->orderBy('cbc.date_created','asc')
                    ->get()
                    ->toArray();
                if($this->chat_content){
                    foreach ($this->chat_content as $key => $value) {
                        DB::table('chat_box_contents as cbc')
                            ->where('cbc_id','=',$value->cbc_id)
                            ->update(['chat_box_sender_isread'=>1]);
                    }
                }
            }
        }
        // dd($this->chat_content);
    }
    

    public function render()
    {
        return view('livewire.admin.chat-support',[
            'user_details' => $this->user_details
            ])
            ->layout('layouts.admin',[
                'title'=>$this->title]);
    }
    public function send_message(){
        if(isset($this->chat_box)){
            if($this->chat_box){
                if( strlen($this->chat_content_details) > 0){
                    DB::table('chat_box_contents')
                        ->insert([
                            'cbc_id' => NULL,
                            'cbc_user_id' => $this->user_details['user_id'],
                            'cbc_chat_box_id' =>  $this->chat_box['chat_box_id'],
                            'cbc_chat_content_type_id' => 1,
                            'cbc_chat_content' => $this->chat_content_details,
                    ]);
                    $last_chat_content = DB::table('chat_box_contents')
                        ->orderBy('cbc_id','desc')
                        ->first();
                    DB::table('chat_box')
                        ->where('chat_box_user_sender','=',$this->user_details['user_id'])
                        ->update([
                            'chat_box_cbc_id' => $last_chat_content->cbc_id
                        ]);
                    $this->chat_content_details= null;
                }else{
                    $this->dispatchBrowserEvent('swal:redirect',[
                        'position'          									=> 'center',
                        'icon'                                                  => 'warning',
                        'title'             									=> 'please input chat!',
                        'showConfirmButton' 									=> 'true',
                        'timer'             									=> '1000',
                        'link'              									=> '#'
                    ]);
                }  
                $this->chat_content = DB::table('chat_box_contents as cbc')
                    ->where('cbc_chat_box_id','=',$this->chat_box['chat_box_id'])
                    ->orderBy('cbc.date_created','asc')
                    ->get()
                    ->toArray();
                self::update_data();
                $this->dispatchBrowserEvent('chatScrollDown','chat_content');
            }
        }
    }
    public function update_content_data(){
        $this->chat_content = DB::table('chat_box_contents as cbc')
            ->where('cbc_chat_box_id','=',$this->chat_box['chat_box_id'])
            ->orderBy('cbc.date_created','asc')
            ->get()
            ->toArray();
        self::update_data();
        $this->dispatchBrowserEvent('chatScrollDown','chat_content');
    }
}

    
