<?php

namespace App\Http\Livewire\Student\StudentNotification;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;


class StudentNotifications extends Component
{
    public $user_detais;
    public $title;

    public $notifications_list = [];
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
    public function update_data(){
        $this->notifications_list = DB::table('notifications as n')
        ->select('*'
            ,DB::raw('n.created_at as  notification_timestamp'))
        ->join('notification_icons as ni','ni.notification_icon_id','n.notification_icon_id')
        ->where('notification_user_target','=',$this->user_details['user_id'])
        ->orderBy('notification_timestamp','desc')
        ->get()
        ->toArray();

        $this->unread_notifications_list =  DB::table('notifications as n')
        ->select('*'
            ,DB::raw('n.created_at as  notification_timestamp'))
        ->join('notification_icons as ni','ni.notification_icon_id','n.notification_icon_id')
        ->where('notification_user_target','=',$this->user_details['user_id'])
        ->where('notiication_isread','=',1)
        ->orderBy('notification_timestamp','desc')
        ->get()
        ->toArray();
    }
    public function mount(Request $request){
        $this->user_details = $request->session()->all();
        $this->title = 'notifications';
        self::update_data();
        // dd($this->notifications_list );
    }
    public function render()
    {
        return view('livewire.student.student-notification.student-notifications',[
            'user_details' => $this->user_details
            ])
            ->layout('layouts.student',[
                'title'=>$this->title]);
    }
    public function mark_as_read($notification_id,$isread){
        DB::table('notifications as n')
        ->where('notification_id','=',$notification_id)
        ->update([
            'notiication_isread'=>$isread
        ]);
        self::update_data();
    }
}
