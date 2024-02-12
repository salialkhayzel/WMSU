<?php

namespace App\Http\Livewire\Components\Header;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HeaderNavigation2 extends Component
{
    public $user_details;
    public $user_status;
    public $unread_notification_count = 0;
    public $prev_unread_notification_count;
    public $notifications = [];
    public function mount(Request $request){
        $user_details = $request->session()->all();
        if(isset($user_details['user_id'])){
            $this->user_details = DB::table('users as u')
            ->select('u.user_status_id','us.user_status_details', 'ur.user_role_id', 'ur.user_role_details','u.user_profile_picture')
            ->join('user_status as us', 'u.user_status_id', '=', 'us.user_status_id')
            ->join('user_roles as ur', 'u.user_role_id', '=', 'ur.user_role_id')
            ->where('user_id','=', $user_details['user_id'])
            ->first();

            $this->user_details = [
                'user_id' =>$user_details['user_id'],
                'user_status_id' => $this->user_details->user_status_id,
                'user_status_details' => $this->user_details->user_status_details,
                'user_role_id' => $this->user_details->user_role_id,
                'user_role_details' => $this->user_details->user_role_details,
                'user_profile_picture' =>$this->user_details->user_profile_picture
               
            ];
            $this->unread_notification_count = DB::table('notifications')
                ->select(DB::raw('COUNT(notification_id) as unread_notification_count'))
                ->where('notification_user_target','=',$user_details['user_id'])
                ->where('notiication_isread','=',1)
                ->get()
                ->first()->unread_notification_count;    

            $this->prev_unread_notification_count = $this->unread_notification_count ;

            $this->notifications =  DB::table('notifications as n')
                ->select(
                    'n.notification_id' ,
                    'n.notification_user_target' ,
                    'n.notification_user_creator' ,
                    'n.notification_icon_id' ,
                    'ni.notification_icon_icon' ,
                    'n.notification_title' ,
                    'n.notification_content' ,
                    'n.notiication_isread' ,
                    'n.notification_link' ,
                    'n.created_at' ,
                    'n.updated_at' ,
                )
                ->join('notification_icons as ni','ni.notification_icon_id','n.notification_icon_id')
                ->where('notification_user_target','=',$this->user_details['user_id'])
                ->where('notiication_isread','=',1)
                ->orderBy('n.created_at','DESC')
                ->limit('5')
                ->get()
                ->toArray();
        }
       
    }
    public function update_nofitication(){
        $this->prev_unread_notification_count = $this->unread_notification_count ;
        $this->unread_notification_count = DB::table('notifications')
        ->select(DB::raw('COUNT(notification_id) as unread_notification_count'))
        ->where('notification_user_target','=',$this->user_details['user_id'])
        ->where('notiication_isread','=',1)
        ->get()
        ->first()->unread_notification_count;    

     
        $this->notifications =  DB::table('notifications as n')
            ->select(
                'n.notification_id' ,
                'n.notification_user_target' ,
                'n.notification_user_creator' ,
                'n.notification_icon_id' ,
                'ni.notification_icon_icon' ,
                'n.notification_title' ,
                'n.notification_content' ,
                'n.notiication_isread' ,
                'n.notification_link' ,
                'n.created_at' ,
                'n.updated_at' ,
            )
            ->join('notification_icons as ni','ni.notification_icon_id','n.notification_icon_id')
            ->where('notification_user_target','=',$this->user_details['user_id'])
            ->where('notiication_isread','=',1)
            ->orderBy('n.created_at','DESC')
            ->limit('5')
            ->get()
            ->toArray();
        
    }
    public function render()
    {
        return view('livewire.components.header.header-navigation2');
    }
}
