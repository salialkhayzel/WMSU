<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Mail;

class Announcement extends Component
{
    use WithFileUploads;

    public $mail = true;
    
    public $user_detais;
    public $title;

    public $announcement_id = null;

    public $announcement_title;
    public $announcement_type = 'text';
    public $announcement_content;
    public $announcement_content_image;
    public $announcement_content_image_id;
    public $announcement_start_date;
    public $announcement_end_date;
    public $announcement_is_active = 'active';


    public $announcement_data;

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

        if($this->access_role['C'] || $this->access_role['R'] || $this->access_role['U'] || $this->access_role['D']){

            $this->announcement_data = DB::table('announcements as a')
                ->get()
                ->toArray();
        }
    }
    
    public function mount(Request $request){
        $this->user_details = $request->session()->all();
        $this->title = 'announcement-management';

        $this->announcement_filter = [
            '#' =>true,
            'Title' =>true,
            'Image' =>true,
            'Type' =>true,
            'Content' =>true,
            'Start' =>true,
            'End' =>true,
            'Status' =>true,
            'Action' =>true
        ];

        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($this->access_role['C'] || $this->access_role['R'] || $this->access_role['U'] || $this->access_role['D']){

            $this->announcement_data = DB::table('announcements as a')
                ->get()
                ->toArray();
                // dd($this->announcement_data);
        }
    }

    
    public function render()
    {
        return view('livewire.admin.announcement',[
            'user_details' => $this->user_details
            ])
            ->layout('layouts.admin',[
                'title'=>$this->title]);
    }

    public function announcementfilterView(){
        $this->dispatchBrowserEvent('swal:redirect',[
            'position'          									=> 'center',
            'icon'              									=> 'success',
            'title'             									=> 'Successfully changed filter!',
            'showConfirmButton' 									=> 'true',
            'timer'             									=> '1000',
            'link'              									=> '#'
        ]);
    }

    public function add_announcement(){
        if(strlen($this->announcement_title)<=0){
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Invalid announcement title!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }
        if($this->announcement_type == 'image'){
            $announcement_type = true;
            // check if we have image
           
        }else{
            $announcement_type = false;
        }
        if($this->announcement_content_image && file_exists(storage_path().'/app/livewire-tmp/'.$this->announcement_content_image->getfilename())){
            $file_extension =$this->announcement_content_image->getClientOriginalExtension();
            $tmp_name = 'livewire-tmp/'.$this->announcement_content_image->getfilename();
            $size = Storage::size($tmp_name);
            $mime = Storage::mimeType($tmp_name);
            $max_image_size = 20 * 1024*1024; // 5 mb
            $file_extensions = array('image/jpeg','image/png','image/jpg');
            
            if($size<= $max_image_size){
                $valid_extension = false;
                foreach ($file_extensions as $value) {
                    if($value == $mime){
                        $valid_extension = true;
                        break;
                    }
                }
                if($valid_extension){
                    
                    // move
                    $new_file_name = md5($tmp_name).'.'.$file_extension;
                    while(DB::table('announcements')
                    ->where(['announcement_content_image'=> $new_file_name])
                    ->first()){
                        $new_file_name = md5($tmp_name.rand(1,10000000)).'.'.$file_extension;
                    }
                    if(Storage::move($tmp_name, 'public/content/announcement/'.$new_file_name)){

                        $this->announcement_content_image = $new_file_name;
                        // resize thumb nail
                        // resize 500x500 px

                    }
                }else{
                    $this->dispatchBrowserEvent('swal:redirect',[
                        'position'          									=> 'center',
                        'icon'              									=> 'warning',
                        'title'             									=> 'Invalid image type!',
                        'showConfirmButton' 									=> 'true',
                        'timer'             									=> '1500',
                        'link'              									=> '#'
                    ]);
                    return 0;
                }
            }else{
                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'icon'              									=> 'warning',
                    'title'             									=> 'Image is too large!',
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '1500',
                    'link'              									=> '#'
                ]);
                return 0;
            }  
            $this->announcement_content_image_id = rand(0,1000000);         
        }
        if(strlen($this->announcement_content)<=0){
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Invalid announcement content!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }
        $start_date=date_create($this->announcement_start_date);
        $end_date=date_create($this->announcement_end_date);
        $diff=date_diff($end_date,$start_date);
        if(intval($diff->format("%a"))<0){
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'End date must be later than start date!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }
        if($this->announcement_is_active =='active'){
            $announcement_is_active = true;
        }else{
            $announcement_is_active = false;
        }

        if(DB::table('announcements')
            ->insert([
                'announcement_id'=> NULL,
                'announcement_type'=> $announcement_type,
                'announcement_title'=> $this->announcement_title,
                'announcement_content'=> $this->announcement_content,
                'announcement_content_image'=> $this->announcement_content_image,
                'announcement_start_date'=> $this->announcement_start_date,
                'announcement_end_date'=> $this->announcement_end_date,
                'announcement_isactive'=> $announcement_is_active])){
                $this->announcement_title = null;
                $this->announcement_type = 'text';
                $this->announcement_content = null;
                $this->announcement_content_image= null;
                $this->announcement_content_image_id;
                $this->announcement_start_date= null;
                $this->announcement_end_date= null;
                $this->announcement_is_active = 'active';

                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'icon'              									=> 'success',
                    'title'             									=> 'Successfuly added an announcement!',
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '1500',
                    'link'              									=> '#'
                ]);

                $this->announcement_data = DB::table('announcements as a')
                ->get()
                ->toArray();

                $this->dispatchBrowserEvent('openModal','addAnnouncementModal');
        }
    }

    public function delete_announcement($announcement_id){
        $announcement_data = DB::table('announcements as a')
            ->where('announcement_id','=',$announcement_id)
            ->first();
        $image_path = storage_path().'/app/public/content/announcement/'.$announcement_data->announcement_content_image;
        if(file_exists($image_path)){
            unlink($image_path);
        }
        
        if(DB::table('announcements as a')
            ->where('announcement_id','=',$announcement_data->announcement_id)
            ->delete()){
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'success',
                'title'             									=> 'Successfuly deleted an announcement!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
            $this->announcement_data = DB::table('announcements as a')
                ->get()
                ->toArray();
        }
    }

    public function edit_announcement($announcement_id){
        $announcement_data = DB::table('announcements as a')
        ->where('announcement_id','=',$announcement_id)
        ->first();

        $this->announcement_id = $announcement_data->announcement_id;

        if($announcement_data->announcement_type){
        $this->announcement_type = 'image';
        }else{
        $this->announcement_type = 'text';
        }

        if($announcement_data->announcement_isactive){
        $this->announcement_is_active = 'active';
        }else{
        $this->announcement_is_active = 'disabled';
        }
        $this->announcement_title = $announcement_data->announcement_title; 
        $this->announcement_content = $announcement_data->announcement_content;
        $this->announcement_content_image = null;
        $this->announcement_content_image_id = rand(0,100000000);
        $this->announcement_start_date= $announcement_data->announcement_start_date;
        $this->announcement_end_date= $announcement_data->announcement_end_date;
        $this->dispatchBrowserEvent('openModal','editAnnouncementModal');
    }

    public function save_edit_announcement($announcement_id){
        $announcement_data = DB::table('announcements as a')
        ->where('announcement_id','=',$announcement_id)
        ->first();
        $this->announcement_id = $announcement_data->announcement_id;
        if(strlen($this->announcement_title)<=0){
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Invalid announcement title!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }
        if($this->announcement_type == 'image'){
            $announcement_type = true;
            // check if we have image
           
        }else{
            $announcement_type = false;
        }
        if($this->announcement_content_image && file_exists(storage_path().'/app/livewire-tmp/'.$this->announcement_content_image->getfilename())){
            $file_extension =$this->announcement_content_image->getClientOriginalExtension();
            $tmp_name = 'livewire-tmp/'.$this->announcement_content_image->getfilename();
            $size = Storage::size($tmp_name);
            $mime = Storage::mimeType($tmp_name);
            $max_image_size = 20 * 1024*1024; // 5 mb
            $file_extensions = array('image/jpeg','image/png','image/jpg');
            
            if($size<= $max_image_size){
                $valid_extension = false;
                foreach ($file_extensions as $value) {
                    if($value == $mime){
                        $valid_extension = true;
                        break;
                    }
                }
                if($valid_extension){
                    
                    // move
                    $new_file_name = md5($tmp_name).'.'.$file_extension;
                    while(DB::table('announcements')
                    ->where(['announcement_content_image'=> $new_file_name])
                    ->first()){
                        $new_file_name = md5($tmp_name.rand(1,10000000)).'.'.$file_extension;
                    }
                    if(Storage::move($tmp_name, 'public/content/announcement/'.$new_file_name)){

                        $image_path = storage_path().'/app/public/content/announcement/'.$announcement_data->announcement_content_image;
                        if(file_exists($image_path)){
                            unlink($image_path);
                        }
                        $this->announcement_content_image = $new_file_name;
                        // resize thumb nail
                        // resize 500x500 px

                    }
                }else{
                    $this->dispatchBrowserEvent('swal:redirect',[
                        'position'          									=> 'center',
                        'icon'              									=> 'warning',
                        'title'             									=> 'Invalid image type!',
                        'showConfirmButton' 									=> 'true',
                        'timer'             									=> '1500',
                        'link'              									=> '#'
                    ]);
                    return 0;
                }
            }else{
                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'icon'              									=> 'warning',
                    'title'             									=> 'Image is too large!',
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '1500',
                    'link'              									=> '#'
                ]);
                return 0;
            }  
            $this->announcement_content_image_id = rand(0,1000000);         
        }else{
            $this->announcement_content_image = $announcement_data->announcement_content_image;
        }
        if(strlen($this->announcement_content)<=0){
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Invalid announcement content!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }
        $start_date=date_create($this->announcement_start_date);
        $end_date=date_create($this->announcement_end_date);
        $diff=date_diff($end_date,$start_date);
        if(intval($diff->format("%a"))<0){
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'End date must be later than start date!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '#'
            ]);
        }
        if($this->announcement_is_active =='active'){
            $announcement_is_active = true;
        }else{
            $announcement_is_active = false;
        }

        if(DB::table('announcements')
            ->where('announcement_id','=',$this->announcement_id)
            ->update([
                'announcement_type'=> $announcement_type,
                'announcement_title'=> $this->announcement_title,
                'announcement_content'=> $this->announcement_content,
                'announcement_content_image'=> $this->announcement_content_image,
                'announcement_start_date'=> $this->announcement_start_date,
                'announcement_end_date'=> $this->announcement_end_date,
                'announcement_isactive'=> $announcement_is_active])){
                $this->announcement_title = null;
                $this->announcement_type = 'text';
                $this->announcement_content = null;
                $this->announcement_content_image= null;
                $this->announcement_content_image_id;
                $this->announcement_start_date= null;
                $this->announcement_end_date= null;
                $this->announcement_is_active = 'active';

                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'icon'              									=> 'success',
                    'title'             									=> 'Successfuly saved!',
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '1500',
                    'link'              									=> '#'
                ]);

                $this->announcement_data = DB::table('announcements as a')
                ->get()
                ->toArray();

                $this->dispatchBrowserEvent('openModal','editAnnouncementModal');
        }
    }
}
