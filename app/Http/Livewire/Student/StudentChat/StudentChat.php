<?php

namespace App\Http\Livewire\Student\StudentChat;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class StudentChat extends Component
{
    use WithFileUploads;
    public $title;
    public $user_details;

    public $chat_content;
    public $chat_box =[];
    public $chat_content_details;
    
    
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
        // dd( $this->user_details );
        $this->chat_box = DB::table('chat_box')
            ->where('chat_box_user_sender','=',$this->user_details['user_id'])
            ->first();
        if($this->chat_box){
            $this->chat_box =[
                'chat_box_id' => $this->chat_box->chat_box_id,
                'chat_box_admin' => $this->chat_box->chat_box_admin,
                'chat_box_status_id' => $this->chat_box->chat_box_status_id,
                'chat_box_user_sender' => $this->chat_box->chat_box_user_sender,
                'chat_box_user_receiver' => $this->chat_box->chat_box_user_receiver,
                'chat_box_sender_isread' => $this->chat_box->chat_box_sender_isread,
                'chat_box_receiver_isread' => $this->chat_box->chat_box_receiver_isread,
                'chat_box_cbc_id' => $this->chat_box->chat_box_cbc_id,
            ];
    
            if($this->chat_box){
                $this->chat_content = DB::table('chat_box_contents as cbc')
                    ->where('cbc_chat_box_id','=',$this->chat_box['chat_box_id'])
                    ->join('users as u','u.user_id','cbc.cbc_user_id')
                    ->orderBy('cbc.date_created','asc')
                    ->get()
                    ->toArray();
            }
        }
    }

    public function mount(Request $request){
        $this->user_details = $request->session()->all();
        $this->title = 'Chat';

        self::update_data();
    }

    public function render()
    {
        return view('livewire.student.student-chat.student-chat',[
            'user_details' => $this->user_details
            ])
            ->layout('layouts.student',[
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
                self::update_data();
                $this->dispatchBrowserEvent('chatScrollDown','chat_content');
            }
        }else{
            // create new chat box
            DB::table('chat_box')
                ->insert([
                    'chat_box_id' => NULL,
                    'chat_box_admin' => 1,
                    'chat_box_status_id' => 1,
                    'chat_box_user_sender' => $this->user_details['user_id'],
                    'chat_box_user_receiver' => 0,
                    'chat_box_sender_isread' => 0,
                    'chat_box_receiver_isread' => 0,
                    'chat_box_cbc_id' => 0,
                ]);
            
            $this->chat_box = DB::table('chat_box')
                ->where('chat_box_user_sender','=',$this->user_details['user_id'])
                ->first();

            $this->chat_box =[
                'chat_box_id' => $this->chat_box->chat_box_id,
                'chat_box_admin' => $this->chat_box->chat_box_admin,
                'chat_box_status_id' => $this->chat_box->chat_box_status_id,
                'chat_box_user_sender' => $this->chat_box->chat_box_user_sender,
                'chat_box_user_receiver' => $this->chat_box->chat_box_user_receiver,
                'chat_box_sender_isread' => $this->chat_box->chat_box_sender_isread,
                'chat_box_receiver_isread' => $this->chat_box->chat_box_receiver_isread,
                'chat_box_cbc_id' => $this->chat_box->chat_box_cbc_id,
            ];
    
       
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
            }
            self::update_data();
            $this->dispatchBrowserEvent('chatScrollDown','chat_content');
        }
        
    }
}

  
