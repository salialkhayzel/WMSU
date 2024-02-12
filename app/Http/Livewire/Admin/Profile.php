<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Mail;

class Profile extends Component
{
    
    public $mail = true;

    use WithFileUploads;
    public $user_detais;
    public $title;

    public $photo;
    public $photo_id;
    public $current_password;
    public $new_password;
    public $confirm_password;
    public $modal_active;

    
    public $firstname;
    public $middlename;
    public $lastname;
    public $suffix;
    public $gender;
    public $sex;
    public $phone;
    public $address;
    public $birthdate;
    

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
        self::update_data();
    }


    public function update(){
        // dd($this->brgy_search_input);
    }

    public function update_province(){
        // dd('sdfasd');
    }
    public function update_data(){
       
        $this->brgy_data = DB::table('refbrgy')
            ->select('*')
            ->where('brgyDesc','LIKE',($this->user_details['user_addr_brgy'].'%'))
            ->limit(50)
            ->get()
            ->toArray();

        $this->mun_city_data = DB::table('refcitymun as cm')
            ->select('*')
            ->where('citymunDesc','LIKE',($this->user_details['user_addr_city_mun'].'%'))
            ->limit(25)
            ->get()
            ->toArray();
        
        if(count($this->mun_city_data) == 1){
            $mun_city_data = DB::table('refcitymun as cm')
            ->select('*')
            ->join('refprovince as p','cm.provCode','p.provCode')
            ->where('citymunDesc','LIKE',($this->user_details['user_addr_city_mun'].'%'))
            ->first();
            $this->user_details['user_addr_province'] = $mun_city_data->provDesc;
        }
        
        $this->province_data =  DB::table('refprovince')
            ->select('*')
            ->where('provDesc','LIKE',($this->user_details['user_addr_province'].'%'))
            ->limit(25)
            ->get()
            ->toArray();;
    }
    public function mount(Request $request){
        $this->user_details = $request->session()->all();
        $this->title = 'profile';
        $this->modal_active = 'photo';

        $user_details = DB::table('users as u')
        ->join('user_status as us', 'u.user_status_id', '=', 'us.user_status_id')
        ->join('user_sex as usex', 'u.user_sex_id', '=', 'usex.user_sex_id')
        ->join('user_genders as ug', 'u.user_gender_id', '=', 'ug.user_gender_id')
        ->join('user_roles as ur', 'u.user_role_id', '=', 'ur.user_role_id')
        ->where('user_id','=', $this->user_details['user_id'])
        ->first();

        $this->user_details = [
            'user_id' =>$this->user_details['user_id'],
            'user_status_id' => $user_details->user_status_id,
            'user_sex_id' =>$user_details->user_sex_id,
            'user_gender_id' =>$user_details->user_gender_id,
            'user_role_id' =>$user_details->user_role_id,
            'user_name' =>$user_details->user_name,
            'user_email' =>$user_details->user_email,
            'user_phone' =>$user_details->user_phone,
            'user_name_verified' =>$user_details->user_name_verified,
            'user_email_verified' =>$user_details->user_email_verified,
            'user_phone_verified' =>$user_details->user_phone_verified,
            'user_firstname' =>$user_details->user_firstname,
            'user_middlename' =>$user_details->user_middlename,
            'user_lastname' =>$user_details->user_lastname,
            'user_suffix' =>$user_details->user_suffix,

            'user_addr_street' =>$user_details->user_addr_street,
            'user_addr_brgy' =>$user_details->user_addr_brgy,
            'user_addr_city_mun' =>$user_details->user_addr_city_mun,
            'user_addr_province' =>$user_details->user_addr_province,
            'user_addr_zip_code' =>$user_details->user_addr_zip_code,
            

            'user_birthdate' =>$user_details->user_birthdate,
            'user_profile_picture' =>$user_details->user_profile_picture,
            'user_formal_id' =>$user_details->user_formal_id,

            'date_created' =>$user_details->date_created,
            'date_updated' =>$user_details->date_updated,

            'user_gender_details' =>$user_details->user_gender_details,
            'user_address' => $user_details->user_addr_street.', '.$user_details->user_addr_brgy.', '.$user_details->user_addr_city_mun.', '.$user_details->user_addr_province.', '.$user_details->user_addr_zip_code
        ];

        if(strlen($this->user_details['user_address'])<=8){
            $this->user_details['user_address'] = "";
        }

        self::update_data();
    }
    public function render(){
        return view('livewire.admin.profile',[
            'user_details' => $this->user_details
            ])
            ->layout('layouts.admin',[
                'title'=>$this->title]);
    }

    public function modal_active($modal_active){
        $this->modal_active = $modal_active;
    }

    public function save_photo(Request $request){
        if($this->photo&& file_exists(storage_path().'/app/livewire-tmp/'.$this->photo->getfilename())){
            $file_extension =$this->photo->getClientOriginalExtension();
            $tmp_name = 'livewire-tmp/'.$this->photo->getfilename();
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
                    $storage_file_path = storage_path().'/app/public/images/';
                    
                    // move
                    $new_file_name = md5($tmp_name);
                    while(DB::table('users')
                    ->where(['user_profile_picture'=> $new_file_name.'.'.$file_extension])
                    ->first()){
                        $new_file_name = md5($tmp_name.rand(1,10000000));
                    }
                    
                    if(!is_dir($storage_file_path)){
                        mkdir($storage_file_path);
                    }
                    if(!is_dir($storage_file_path.'original/')){
                        mkdir($storage_file_path.'original/');
                    }
                    if(!is_dir($storage_file_path.'resize/')){
                        mkdir($storage_file_path.'resize/');
                    }
                    if(!is_dir($storage_file_path.'thumbnail/')){
                        mkdir($storage_file_path.'thumbnail/');
                    }
                    $profilepic_dir = $storage_file_path.'original/';
                    switch($file_extension){
                        case 'png':
                            $img = imagecreatefrompng(storage_path().'/'.'app/'.$tmp_name);
                            // convert jpeg
                            imagejpeg($img,$profilepic_dir.$new_file_name.'.jpg',100);
                        break;
                        case 'bmp':
                            $img = imagecreatefrompng(storage_path().'/'.'app/'.$tmp_name);
                            // convert jpeg
                            imagejpeg($img,$profilepic_dir.$new_file_name.'.jpg',100);
                            break;
                        case 'jpg':
                            copy(storage_path().'/'.'app/'.$tmp_name, $storage_file_path.'original/'.$new_file_name.'.jpg');
                        break;
                    }
                    
                    $profile_resize_dir = $storage_file_path.'resize/';
                    $profile_thumbnail_dir = $storage_file_path.'thumbnail/';
                    // profile display

                    $sourceFilename  =$profilepic_dir;
                    $destination = $profile_resize_dir;
                    $filename = $new_file_name.'.jpg';
                    $newFilename =$new_file_name.'.jpg';
                    $quality = 80;
                    $newwidth = 500;
                    $newheight =500;
                    list($width, $height) = getimagesize($sourceFilename.$filename);
                    if($width/$height > 1){
                        $x = ($width - $height) / 2;
                        $y = 0;
                        $width= $width - ($x*2);
                        $height;
                    }else{
                        $y = ($height - $width) / 2;
                        $x = 0;
                        $width;
                        $height = $height - ($y*2);
                    }
                
                    // creating jpeg 
                    $img = imagecreatefromjpeg($sourceFilename.$filename);
                    $img =imagecrop($img, ['x' => $x, 'y' => $y, 'width' => $width, 'height' => $height]);
                    $thumb = imagecreatetruecolor($newwidth, $newheight);
                    if(imagecopyresized($thumb, $img, 0, 0, 0, 0,$newwidth, $newheight, $width, $height)){
                        if(imagejpeg($thumb,$destination.$filename,$quality)){
                        }else{
                            return false;
                        }
                    }else {
                        return false;
                    }

                    $sourceFilename  = $profilepic_dir;
                    $destination = $profile_thumbnail_dir;
                    $filename = $new_file_name.'.jpg';
                    $newFilename =$new_file_name.'.jpg';
                    $quality = 80;
                    $newwidth = 150;
                    $newheight =150;
                    list($width, $height) = getimagesize($sourceFilename.$filename);
                    if($width/$height > 1){
                        $x = ($width - $height) / 2;
                        $y = 0;
                        $width= $width - ($x*2);
                        $height;
                    }else{
                        $y = ($height - $width) / 2;
                        $x = 0;
                        $width;
                        $height = $height - ($y*2);
                    }
                
                    // creating jpeg 
                    $img = imagecreatefromjpeg($sourceFilename.$filename);
                    $img =imagecrop($img, ['x' => $x, 'y' => $y, 'width' => $width, 'height' => $height]);
                    $thumb = imagecreatetruecolor($newwidth, $newheight);
                    if(imagecopyresized($thumb, $img, 0, 0, 0, 0,$newwidth, $newheight, $width, $height)){
                        if(imagejpeg($thumb,$destination.$filename,$quality)){
                        }else{
                            return false;
                        }
                    }else {
                        return false;
                    }
                    
                  

                       
                    if($this->user_details['user_profile_picture'] != 'default.png'){
                        if(file_exists($profilepic_dir.$this->user_details['user_profile_picture'])){
                            unlink($profilepic_dir.$this->user_details['user_profile_picture']);
                        }
                        if(file_exists($profile_resize_dir.$this->user_details['user_profile_picture'])){
                            unlink($profile_resize_dir.$this->user_details['user_profile_picture']);
                        }
                        if(file_exists($profile_thumbnail_dir.$this->user_details['user_profile_picture'])){
                            unlink($profile_thumbnail_dir.$this->user_details['user_profile_picture']);
                        }
                    }
                        
                        // delete old photo
                        DB::table('users as u')
                        ->where(['u.user_id'=> $this->user_details['user_id']])
                        ->update(['u.user_profile_picture'=> $new_file_name.'.jpg']);

                        $request->session()->put('user_profile_picture', $new_file_name.'.jpg');
                        $this->user_details = $request->session()->all();
                        $this->photo = null;

                        $this->dispatchBrowserEvent('swal:redirect',[
                            'position'          									=> 'center',
                            'icon'              									=> 'success',
                            'title'             									=> 'Images updated!',
                            'showConfirmButton' 									=> 'true',
                            'timer'             									=> '1500',
                            'link'              									=> '#'
                        ]);
                        self::update_data();
                }else{
                    $this->dispatchBrowserEvent('swal:redirect',[
                        'position'          									=> 'center',
                        'icon'              									=> 'warning',
                        'title'             									=> 'Invalid image type!',
                        'showConfirmButton' 									=> 'true',
                        'timer'             									=> '1500',
                        'link'              									=> '#'
                    ]);
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
            }
            $this->photo_id = rand(0,1000000);
        }
    }
    public function change_password(Request $request){
        $user_details = $request->session()->all();
        if(strlen($this->new_password) < 8 ) {
            $this->password_error = 'new password must be >= 8';
            return false;
        }
        elseif(!preg_match("#[0-9]+#",$this->new_password)) {
            $this->password_error = 'new password must have number';
            return false;
        }
        elseif(!preg_match("#[A-Z]+#",$this->new_password)) {
            $this->password_error = 'new password must have upper case';
            return false;
        }
        elseif(!preg_match("#[a-z]+#",$this->new_password)) {
            $this->password_error = 'new password must have lower case';
            return false;
        }
        $this->password_error=null;
        if(strlen($this->confirm_password) < 8 ) {
            $this->password_error = 'Confirm password must be >= 8';
            return false;
        }
        elseif(!preg_match("#[0-9]+#",$this->confirm_password)) {
            $this->password_error = 'Confirm password must have number';
            return false;
        }
        elseif(!preg_match("#[A-Z]+#",$this->confirm_password)) {
            $this->password_error = 'Confirm password must have upper case';
            return false;
        }
        elseif(!preg_match("#[a-z]+#",$this->confirm_password)) {
            $this->password_error = 'Confirm password must have lower case';
            return false;
        }
        // good password
        if($this->new_password == $this->confirm_password){
            $user_details =DB::table('users as u')
            ->where(['u.user_id'=> $user_details['user_id']])
            ->first();
            if( $user_details && password_verify($this->current_password,$user_details->user_password)){
                if($this->current_password != $this->new_password){
                    $hash_password = password_hash($this->new_password, PASSWORD_ARGON2I);
                    if(DB::table('users as u')
                    ->where(['u.user_id'=> $user_details->user_id])
                    ->update(['u.user_password'=> $hash_password])){
                        $this->current_password = null;
                        $this->new_password = null;
                        $this->confirm_password = null;
                        $this->dispatchBrowserEvent('swal:redirect',[
                            'position'          									=> 'center',
                            'icon'              									=> 'success',
                            'title'             									=> 'Successfully changed password!',
                            'showConfirmButton' 									=> 'true',
                            'timer'             									=> '2000',
                            'link'              									=> '#'
                        ]);
                    }else{
                        $this->dispatchBrowserEvent('swal:redirect',[
                            'position'          									=> 'center',
                            'icon'              									=> 'warning',
                            'title'             									=> 'Error saving password!',
                            'showConfirmButton' 									=> 'true',
                            'timer'             									=> '2000',
                            'link'              									=> '#'
                        ]);
                    }
                    
                }else{
                    $this->dispatchBrowserEvent('swal:redirect',[
                        'position'          									=> 'center',
                        'icon'              									=> 'warning',
                        'title'             									=> 'New password must not be same as your old password!',
                        'showConfirmButton' 									=> 'true',
                        'timer'             									=> '2000',
                        'link'              									=> '#'
                    ]);
                }
            }else{
                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'icon'              									=> 'warning',
                    'title'             									=> 'Incorrect current password!',
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '2000',
                    'link'              									=> '#'
                ]);
            }
        }else{
            $this->password_error = 'Password doesn\'t match';
        }   
    }
    public function new_password(Request $request){
        $user_details = $request->session()->all();
        if(!isset($user_details['user_id'])){
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Unauthenticated!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '/login'
            ]);
        }
        if(isset($user_details['user_status_details']) && $user_details['user_status_details'] == 'deleted' ){
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Account deleted!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '/deleted'
            ]);
        }
        if(isset($user_details['user_status_details']) && $user_details['user_status_details'] == 'inactive' ){
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Account inactive!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '/inactive'
            ]);
        }
        if(strlen($this->new_password) < 8 ) {
            $this->password_error = 'new password must be >= 8';
            return false;
        }
        elseif(!preg_match("#[0-9]+#",$this->new_password)) {
            $this->password_error = 'new password must have number';
            return false;
        }
        elseif(!preg_match("#[A-Z]+#",$this->new_password)) {
            $this->password_error = 'new password must have upper case';
            return false;
        }
        elseif(!preg_match("#[a-z]+#",$this->new_password)) {
            $this->password_error = 'new password must have lower case';
            return false;
        }
        $this->password_error=null;
    }

    public function confirm_password(Request $request){
        $user_details = $request->session()->all();
        if(!isset($user_details['user_id'])){
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Unauthenticated!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '/login'
            ]);
        }
        if(isset($user_details['user_status_details']) && $user_details['user_status_details'] == 'deleted' ){
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Account deleted!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '/deleted'
            ]);
        }
        if(isset($user_details['user_status_details']) && $user_details['user_status_details'] == 'inactive' ){
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'warning',
                'title'             									=> 'Account inactive!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1500',
                'link'              									=> '/inactive'
            ]);
        }
        if(strlen($this->confirm_password) < 8 ) {
            $this->password_error = 'Confirm password must be >= 8';
            return false;
        }
        elseif(!preg_match("#[0-9]+#",$this->confirm_password)) {
            $this->password_error = 'Confirm password must have number';
            return false;
        }
        elseif(!preg_match("#[A-Z]+#",$this->confirm_password)) {
            $this->password_error = 'Confirm password must have upper case';
            return false;
        }
        elseif(!preg_match("#[a-z]+#",$this->confirm_password)) {
            $this->password_error = 'Confirm password must have lower case';
            return false;
        }
        // good password
        if($this->new_password == $this->confirm_password){
            $this->password_error = null;
            
        }else{
            $this->password_error = 'Password doesn\'t match';
        }
    }
    public function save_profile_info(Request $request){
        
       
        if(strlen($this->user_details['user_firstname']) < 1 && strlen($this->user_details['user_firstname']) > 255){
            return false;
        }
        
        if(strlen($this->user_details['user_lastname']) < 1 && strlen($this->user_details['user_lastname']) > 255){
            return false;
        }
        if(strlen($this->user_details['user_middlename']) < 0 && strlen($this->user_details['user_middlename']) > 255){
            return false;
        }
        if(strlen($this->user_details['user_suffix']) < 0 && strlen($this->user_details['user_suffix']) > 255){
            return false;
        }


        if(strlen($this->user_details['user_addr_street']) < 0 && strlen($this->user_details['user_addr_street']) > 255){
            return false;
        }
        if(strlen($this->user_details['user_addr_brgy']) < 1 && strlen($this->user_details['user_addr_brgy']) > 255){
            return false;
        }
        if(strlen($this->user_details['user_addr_city_mun']) < 1 && strlen($this->user_details['user_addr_city_mun']) > 255){
            return false;
        }
        if(strlen($this->user_details['user_addr_province']) < 1 && strlen($this->user_details['user_addr_province']) > 255){
            return false;
        }
        if(intval($this->user_details['user_addr_zip_code']) < 0 ){
            return false;
        }
        

        // validate phone
        if(1){
            
        }
        
        if($gender_details = DB::table('user_genders')
        ->where('user_gender_details', $this->user_details['user_gender_details'])
        ->first()){
            $gender_id = $gender_details->user_gender_id;
        }else{
            DB::table('user_genders')->insert([
                'user_gender_details'=>$this->user_details['user_gender_details']
            ]);
            $gender_details = DB::table('user_genders')
                ->where('user_gender_details', $this->user_details['user_gender_details'])
                ->first();
            $gender_id = $gender_details->user_gender_id;
        }
        // update
        
        DB::table('users as u')
        ->where(['u.user_id'=> $this->user_details['user_id']])
        ->update([
            'u.user_firstname' => $this->user_details['user_firstname'],
            'u.user_middlename'=>$this->user_details['user_middlename'],
            'u.user_lastname'=>$this->user_details['user_lastname'],
            'u.user_suffix'=>$this->user_details['user_suffix'],
            'u.user_gender_id'=>$gender_id,
            'u.user_phone'=>$this->user_details['user_phone'],
            'u.user_birthdate'=>$this->user_details['user_birthdate'],  

            'u.user_addr_street' =>$this->user_details['user_addr_street'],
            'u.user_addr_brgy'=>$this->user_details['user_addr_brgy'],
            'u.user_addr_city_mun' =>$this->user_details['user_addr_city_mun'],
            'u.user_addr_province' =>$this->user_details['user_addr_province'],
            'u.user_addr_zip_code' =>$this->user_details['user_addr_zip_code'],
        ]);

       

        $this->dispatchBrowserEvent('swal:redirect',[
            'position'          									=> 'center',
            'icon'              									=> 'success',
            'title'             									=> 'Account details saved!',
            'showConfirmButton' 									=> 'true',
            'timer'             									=> '1500',
            'link'              									=> '#'
        ]);
        
    }
}
