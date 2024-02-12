<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Mail;

class AdminManagement extends Component
{ 
    public $mail = true;
    
    public $user_detais;
    public $title;

    public $active= 'admin_management';
    public $admin_data;
    public $user_data;


    public $modules;
    public $roles_data;
    public $access_roles;
    public $access_role_name;
    public $access_role_description;
    public $role_name_details;
    public $view_access_role;
    public $edit_access_role;
    

    
    public $modal_open = false;
    public $admin_role_name_id = null;
    public $admin_access_role;

    public $sign_up_button ;
    public $admin_username;
    public $admin_email;
    public $admin_firstname;
    public $admin_middlename;
    public $admin_lastname;
    public $admin_suffix;
    public $admin_birthdate;
    public $admin_password;
    public $admin_confirm_password;
    public $admin_testing_centers =[];

    public $admin_fullname;
    public $view_admin_roles;
    public $view_admin_user_id;
    public $delete_admin_user_id;

    public $test_center_data;




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
            self::update_data();
        }
    }

    public function update_data(){
        $this->admin_data = DB::table('users as u')
            ->select(
                "user_id",
                "user_sex_id",
                "user_gender_id",
                "ur.user_role_id",
                "user_name",
                "user_email",
                "user_phone",
                "user_name_verified",
                "user_email_verified",
                "user_phone_verified",
                "user_firstname",
                "user_middlename",
                "user_lastname",
                "user_suffix",
                "user_birthdate",
                "user_profile_picture",
                "user_formal_id",
                "u.date_created",
                "u.date_updated",
                "user_status_details",
                "user_role_details",

                'user_addr_street' ,
                'user_addr_brgy' ,
                'user_addr_city_mun',
                'user_addr_province',
                'user_addr_zip_code' ,
                DB::raw('CONCAT(user_addr_street,", ",user_addr_brgy,", ",user_addr_city_mun,", ",user_addr_province,", ",user_addr_zip_code) as user_address')

            )
            ->join('user_status as us', 'us.user_status_id', '=', 'u.user_status_id')
            ->join('user_roles as ur', 'ur.user_role_id', '=', 'u.user_role_id')
            // ->where('user_id','!=', $this->user_details['user_id'])
            ->where('user_role_details','=', 'admin')
            ->get()
            ->toArray();
        // dd( $this->admin_data);

        $this->user_data = DB::table('users as u')
            ->select(
                "user_id",
                "user_sex_id",
                "user_gender_id",
                "ur.user_role_id",
                "user_name",
                "user_email",
                "user_phone",
                "user_name_verified",
                "user_email_verified",
                "user_phone_verified",
                "user_firstname",
                "user_middlename",
                "user_lastname",
                "user_suffix",
                "user_birthdate",
                "user_profile_picture",
                "user_formal_id",
                "u.date_created",
                "u.date_updated",
                "user_status_details",
                "user_role_details",
                DB::raw('CONCAT(user_addr_street,", ",user_addr_brgy,", ",user_addr_city_mun,", ",user_addr_province,", ",user_addr_zip_code) as user_address')
            )
            ->join('user_status as us', 'us.user_status_id', '=', 'u.user_status_id')
            ->join('user_roles as ur', 'ur.user_role_id', '=', 'u.user_role_id')
            // ->where('user_id','!=', $this->user_details['user_id'])
            ->where('user_role_details','=', 'student')
            ->get()
            ->toArray();

        $this->modules = DB::table('modules as m')
            ->select('*')
            ->orderBy('module_number')
            ->get()
            ->toArray();
       
        $this->roles_data = DB::table('admin_role_names as arn')
            ->get()
            ->toArray();

        $this->test_center_data = DB::table('test_centers')
            ->where('test_center_isactive','=','1')
            ->get()
            ->toArray();
        
    }

    public function mount(Request $request){
        $this->user_details = $request->session()->all();
        $this->title = 'admin-management';

        

        $this->admin_data_filter = [
            '#' => true,
            'Username' => true,
            'Full name' => true,
            'Email' => true,
            'CP#' => true,
            'Active' => false,
            'Verified' => true,
            'Status' => true,
            'Action' => true
        ];

        $this->user_data_filter = [
            '#' => true,
            'Username' => true,
            'Full name' => true,
            'Email' => true,
            'CP#' => true,
            'Active' => false,
            'Verified' => true,
            'Status' => true,
            'Action' => true
        ];

        $this->roles_data_filter = [
            '#' => true,
            'Role Name' => true,
            'Description' => true,
            'Action' => true
        ];

        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($this->access_role['C'] || $this->access_role['R'] || $this->access_role['U'] || $this->access_role['D']){
            self::update_data();
        }

    }

    public function render(){
        return view('livewire.admin.admin-management',[
            'user_details' => $this->user_details
            ])
            ->layout('layouts.admin',[
                'title'=>$this->title]);
    }

    public function admin_data_filterView(){
        $this->dispatchBrowserEvent('swal:redirect',[
            'position'          									=> 'center',
            'icon'              									=> 'success',
            'title'             									=> 'Successfully changed filter!',
            'showConfirmButton' 									=> 'true',
            'timer'             									=> '1000',
            'link'              									=> '#'
        ]);
    }

    public function user_data_filterView(){
        $this->dispatchBrowserEvent('swal:redirect',[
            'position'          									=> 'center',
            'icon'              									=> 'success',
            'title'             									=> 'Successfully changed filter!',
            'showConfirmButton' 									=> 'true',
            'timer'             									=> '1000',
            'link'              									=> '#'
        ]);
    }


    public function active_page($active){
        $this->active = $active;
        $this->modal_open = false;
    }

    public function view_admin($user_id){
        $this->view_admin_data = DB::table('users as u')
        ->select(
            "user_id",
            "user_sex_id",
            "user_gender_id",
            "ur.user_role_id",
            "user_name",
            "user_email",
            "user_phone",
            "user_name_verified",
            "user_email_verified",
            "user_phone_verified",
            "user_firstname",
            "user_middlename",
            "user_lastname",
            "user_suffix",
            DB::raw('CONCAT(user_addr_street,", ",user_addr_brgy,", ",user_addr_city_mun,", ",user_addr_province,", ",user_addr_zip_code) as user_address'),
            "user_birthdate",
            "user_profile_picture",
            "user_formal_id",
            "u.date_created",
            "u.date_updated",
            "user_status_details",
            "user_role_details"
            )
        ->join('user_status as us', 'us.user_status_id', '=', 'u.user_status_id')
        ->join('user_roles as ur', 'ur.user_role_id', '=', 'u.user_role_id')
        ->where('user_id','=', $user_id)
        ->where('user_role_details','=', 'admin')
        ->get()
        ->toArray();

        $this->admin_fullname = $this->view_admin_data[0]->user_firstname.' '.$this->view_admin_data[0]->user_middlename.' '.$this->view_admin_data[0]->user_lastname;

        $roles_data = DB::table('access_roles as ar')
                ->where('access_role_user_id','=',$user_id)
                ->get()
                ->toArray();
                $this->view_admin_roles = [];
                foreach ($roles_data as $key => $value) {
                    array_push($this->view_admin_roles,[
                        'access_role_module_id' =>$value->access_role_module_id,
                        'C'=>$value->access_role_create,
                        'R'=>$value->access_role_create,
                        'U'=>$value->access_role_update,
                        'D'=>$value->access_role_delete
                    ]);
                }

        $this->dispatchBrowserEvent('openModal','ViewAdminModal');
        
    }

    public function edit_admin($user_id){
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];        
        if($this->access_role['U'] ){
            $this->view_admin_data = DB::table('users as u')
            ->select(
                "user_id",
                "user_sex_id",
                "user_gender_id",
                "ur.user_role_id",
                "user_name",
                "user_email",
                "user_phone",
                "user_name_verified",
                "user_email_verified",
                "user_phone_verified",
                "user_firstname",
                "user_middlename",
                "user_lastname",
                "user_suffix",
                DB::raw('CONCAT(user_addr_street,", ",user_addr_brgy,", ",user_addr_city_mun,", ",user_addr_province,", ",user_addr_zip_code) as user_address'),
                "user_birthdate",
                "user_profile_picture",
                "user_formal_id",
                "u.date_created",
                "u.date_updated",
                "user_status_details",
                "user_role_details"
                )
            ->join('user_status as us', 'us.user_status_id', '=', 'u.user_status_id')
            ->join('user_roles as ur', 'ur.user_role_id', '=', 'u.user_role_id')
            ->where('user_id','=', $user_id)
            ->where('user_role_details','=', 'admin')
            ->get()
            ->toArray();

            $this->admin_fullname = $this->view_admin_data[0]->user_firstname.' '.$this->view_admin_data[0]->user_middlename.' '.$this->view_admin_data[0]->user_lastname;

            $this->view_admin_user_id = $this->view_admin_data[0]->user_id;
            $roles_data = DB::table('access_roles as ar')
                    ->where('access_role_user_id','=',$user_id)
                    ->get()
                    ->toArray();
                    $this->view_admin_roles = [];
                    foreach ($roles_data as $key => $value) {
                        array_push($this->view_admin_roles,[
                            'access_role_module_id' =>$value->access_role_module_id,
                            'C'=>$value->access_role_create,
                            'R'=>$value->access_role_create,
                            'U'=>$value->access_role_update,
                            'D'=>$value->access_role_delete
                        ]);
                    }
            
            $admin_testing_centers = DB::table('admin_testing_centers')
                ->where('user_id','=',$this->view_admin_user_id)
                ->get()
                ->toArray()
                ;
            $this->admin_testing_centers = [];
            foreach ($admin_testing_centers as $key => $value) {
                array_push($this->admin_testing_centers,['testing_center_id'=>$value->testing_center_id]);
            }            

            $this->dispatchBrowserEvent('openModal','EditAdminModal');
        }
    }

    public function save_edit_admin($user_id){
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];        
        if($this->access_role['U'] ){
            // dd($this->view_admin_roles);
            foreach ($this->view_admin_roles as $key => $value) {
                DB::table('access_roles')
                    ->where('access_role_user_id' ,'=',  $user_id)
                    ->where('access_role_module_id','=',$value['access_role_module_id'])
                    ->update([
                        'access_role_create' => $value['C'],
                        'access_role_read' =>$value['R'],
                        'access_role_update' => $value['U'],
                        'access_role_delete' => $value['D'],
                ]);
            }

            if(count($this->admin_testing_centers) <= 0){
                $this->sign_up_button = 'Testing center Invalid';
                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'title'             									=> 'Password doesn\'t match!',
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '1000',
                    'link'              									=> '#'
                ]);
                return false;
            }
            $valid = false;
            foreach ($this->admin_testing_centers as $key => $value) {
                if(intval($value['testing_center_id'])>0 ){
                    $valid = true;
                    break;
                }
            }
            if(!$valid){
                $this->sign_up_button = 'Testing center Invalid';
                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'title'             									=> 'Password doesn\'t match!',
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '1000',
                    'link'              									=> '#'
                ]);
                return false;
            }

            DB::table('admin_testing_centers')
                ->where('user_id','=',$user_id)
                ->delete();

            foreach ($this->admin_testing_centers as $key => $value) {
                if(intval($value['testing_center_id'])>0 ){
                    DB::table('admin_testing_centers')->insert([
                        'id' => NULL,
                        'user_id' =>$user_id,
                        'testing_center_id' =>$value['testing_center_id'],
                    ]);
                }
            }
            $this->dispatchBrowserEvent('swal:remove_backdrop',[
                'position'          									=> 'center',
                'icon'                                                  => 'success',
                'title'             									=> 'Admin role updated!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1000',
                'link'              									=> '#'
            ]);
        }
    }

    public function delete_admin($user_id){
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];        
        if($this->access_role['U'] ){
            $this->delete_admin_user_id = $user_id;
            $this->dispatchBrowserEvent('openModal','DeleteAdminModal');
        }
    }

    public function delete_admin_now($user_id){
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];        
        if($this->access_role['U'] ){
            DB::table('users')
                ->where('user_id' ,'=',  $user_id)
                ->update([
                    'user_status_id' => DB::table('user_status')
                    ->select('user_status_id')
                    ->where('user_status_details','=','deleted')
                    ->get()
                    ->toArray()[0]->user_status_id
            ]);

            self::update_data();

            $this->dispatchBrowserEvent('swal:remove_backdrop',[
                'position'          									=> 'center',
                'icon'                                                  => 'success',
                'title'             									=> 'User is set to deleted!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1000',
                'link'              									=> '#'
            ]);
            $this->dispatchBrowserEvent('openModal','DeleteAdminModal');
        }
    }

    

    public function activate_admin($user_id){
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];        
        if($this->access_role['U'] ){
            DB::table('users')
                ->where('user_id' ,'=',  $user_id)
                ->update([
                    'user_status_id' => DB::table('user_status')
                    ->select('user_status_id')
                    ->where('user_status_details','=','active')
                    ->get()
                    ->toArray()[0]->user_status_id
            ]);

            $this->admin_data = DB::table('users as u')
            ->select(
                "user_id",
                "user_sex_id",
                "user_gender_id",
                "ur.user_role_id",
                "user_name",
                "user_email",
                "user_phone",
                "user_name_verified",
                "user_email_verified",
                "user_phone_verified",
                "user_firstname",
                "user_middlename",
                "user_lastname",
                "user_suffix",
               DB::raw('CONCAT(user_addr_street,", ",user_addr_brgy,", ",user_addr_city_mun,", ",user_addr_province,", ",user_addr_zip_code) as user_address'),
                "user_birthdate",
                "user_profile_picture",
                "user_formal_id",
                "u.date_created",
                "u.date_updated",
                "user_status_details",
                "user_role_details"
                )
            ->join('user_status as us', 'us.user_status_id', '=', 'u.user_status_id')
            ->join('user_roles as ur', 'ur.user_role_id', '=', 'u.user_role_id')
            // ->where('user_id','!=', $this->user_details['user_id'])
            ->where('user_role_details','=', 'admin')
            ->get()
            ->toArray();

            $this->user_data = DB::table('users as u')
            ->select(
                "user_id",
                "user_sex_id",
                "user_gender_id",
                "ur.user_role_id",
                "user_name",
                "user_email",
                "user_phone",
                "user_name_verified",
                "user_email_verified",
                "user_phone_verified",
                "user_firstname",
                "user_middlename",
                "user_lastname",
                "user_suffix",
               DB::raw('CONCAT(user_addr_street,", ",user_addr_brgy,", ",user_addr_city_mun,", ",user_addr_province,", ",user_addr_zip_code) as user_address'),
                "user_birthdate",
                "user_profile_picture",
                "user_formal_id",
                "u.date_created",
                "u.date_updated",
                "user_status_details",
                "user_role_details"
                )
            ->join('user_status as us', 'us.user_status_id', '=', 'u.user_status_id')
            ->join('user_roles as ur', 'ur.user_role_id', '=', 'u.user_role_id')
            // ->where('user_id','!=', $this->user_details['user_id'])
            ->where('user_role_details','=', 'student')
            ->get()
            ->toArray();

            $this->dispatchBrowserEvent('swal:remove_backdrop',[
                'position'          									=> 'center',
                'icon'                                                  => 'success',
                'title'             									=> 'User is set to active!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1000',
                'link'              									=> '#'
            ]);
        }
    }

    

    // add admin
    public function update_admin_role(){

        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];        
        if($this->access_role['U'] ){
            if($this->admin_role_name_id >0){
                $roles_data = DB::table('admin_roles as ar')
                ->where('access_role_name_id','=',$this->admin_role_name_id)
                ->get()
                ->toArray();
            
                $this->admin_access_role = [];
                foreach ($roles_data as $key => $value) {
                    array_push($this->admin_access_role,[
                        'access_role_module_id' =>$value->access_role_module_id,
                        'C'=>$value->access_role_create,
                        'R'=>$value->access_role_create,
                        'U'=>$value->access_role_update,
                        'D'=>$value->access_role_delete
                    ]);
                }
            }else{
                $this->admin_access_role = [];
                foreach ($this->modules as $key => $value) {
                    array_push($this->admin_access_role,[
                        'access_role_module_id' =>$value->module_nav_name,
                        'C'=>false,
                        'R'=>false,
                        'U'=>false,
                        'D'=>false
                    ]);
                }
            }

        }
    }
    
    public function add_admin_modal(){
        $this->admin_testing_centers = [];
        array_push($this->admin_testing_centers,['testing_center_id'=>NULL]);
        $this->dispatchBrowserEvent('openModal','adminAddModal');
    }
    public function check_admin_testing_centers($p_key){
        foreach ($this->admin_testing_centers as $key => $value) {
            if($key != $p_key ){
                if($value['testing_center_id'] == $this->admin_testing_centers[$p_key]['testing_center_id']){
                    $this->dispatchBrowserEvent('swal:redirect',[
                        'position'          									=> 'center',
                        'icon'                                                  => 'warning',
                        'title'             									=> 'Testing center is selected!',
                        'showConfirmButton' 									=> 'true',
                        'timer'             									=> '1000',
                        'link'              									=> '#'
                    ]);
                    $this->admin_testing_centers[$p_key]['testing_center_id'] = NULL;
                }
            }
        }        
    }
    public function delete_testing_center($p_key){
        if(count($this->admin_testing_centers) == 1){
            return;
        }
        $admin_testing_centers = [];
        foreach ($this->admin_testing_centers as $key => $value) {
            if($key != $p_key ){
                array_push($admin_testing_centers,['testing_center_id'=>$value['testing_center_id']]);
            }
        }  
        $this->admin_testing_centers = $admin_testing_centers;
    }

    public function add_testing_center(){
        array_push($this->admin_testing_centers,['testing_center_id'=>NULL]);
    }

    public function add_admin(){
        // validate user cred

       

        // check if username is valid
        $this->sign_up_button= false;
        if (preg_match('/^[A-Za-z]{1}[A-Za-z0-9]{5,31}$/', $this->admin_username)
            && !DB::table('users')
            ->where('user_name', $this->admin_username)
            ->where('user_name_verified', 1)
            ->first()){
            // save into session
            $this->style = 'green';
        }else{
            $this->style = 'red';
            $this->sign_up_button ='Invalid Username';
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'title'             									=> 'Invalid username or username is less than 6 characters!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1000',
                'link'              									=> '#'
            ]);
            return;
        }     
        
        if(strlen($this->admin_firstname) < 1 || strlen($this->admin_firstname) > 255){
            $this->sign_up_button ='Invalid firstname';
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'title'             									=> 'Invalid firstname!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1000',
                'link'              									=> '#'
            ]);
            return false;
        }
        
        if(strlen($this->admin_lastname) < 1 || strlen($this->admin_lastname) > 255){
            $this->sign_up_button ='Invalid lastname';
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'title'             									=> 'Invalid lastname!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1000',
                'link'              									=> '#'
            ]);
            return false;
        }
        if(strlen($this->admin_middlename) < 0 || strlen($this->admin_middlename) > 255){
            $this->sign_up_button ='Invalid middlename';
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'title'             									=> 'Invalid middlename!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1000',
                'link'              									=> '#'
            ]);
            return false;
        }


        if(strlen($this->admin_password) < 8 ) {
            $this->sign_up_button = 'password must be >= 8';
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'title'             									=> 'password must be >= 8!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1000',
                'link'              									=> '#'
            ]);
            return false;
        }
        elseif(!preg_match("#[0-9]+#",$this->admin_password)) {
            $this->sign_up_button = 'password must have number';
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'title'             									=> 'password must have number!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1000',
                'link'              									=> '#'
            ]);
            return false;
        }
        elseif(!preg_match("#[A-Z]+#",$this->admin_password)) {
            $this->sign_up_button = 'password must have upper case';
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'title'             									=> 'password must have upper case!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1000',
                'link'              									=> '#'
            ]);
            return false;
        }
        elseif(!preg_match("#[a-z]+#",$this->admin_password)) {
            $this->sign_up_button = 'password must have lower case';
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'title'             									=> 'password must have lower case!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1000',
                'link'              									=> '#'
            ]);
            return false;
        }

        if(strlen($this->admin_confirm_password) < 8 ) {
            $this->sign_up_button = 'Confirm password must be >= 8';
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'title'             									=> 'Confirm password must be >= 8!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1000',
                'link'              									=> '#'
            ]);
            return false;
        }
        elseif(!preg_match("#[0-9]+#",$this->admin_confirm_password)) {
            $this->sign_up_button = 'Confirm password must have number';
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'title'             									=> 'Confirm password must have number!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1000',
                'link'              									=> '#'
            ]);
            return false;
        }
        elseif(!preg_match("#[A-Z]+#",$this->admin_confirm_password)) {
            $this->sign_up_button = 'Confirm password must have upper case';
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'title'             									=> 'Confirm password must have upper case!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1000',
                'link'              									=> '#'
            ]);
            return false;
        }
        elseif(!preg_match("#[a-z]+#",$this->admin_confirm_password)) {
            $this->sign_up_button = 'Confirm password must have lower case';
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'title'             									=> 'Confirm password must have lower case!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1000',
                'link'              									=> '#'
            ]);
            return false;
        }
        
        if($this->admin_password != $this->admin_confirm_password){
            $this->sign_up_button = 'Password doesn\'t match';
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'title'             									=> 'Password doesn\'t match!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1000',
                'link'              									=> '#'
            ]);
           
            return false;
        }

        if(count($this->admin_testing_centers) <= 0){
            $this->sign_up_button = 'Testing center Invalid';
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'title'             									=> 'Password doesn\'t match!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1000',
                'link'              									=> '#'
            ]);
            return false;
        }
        $valid = false;
        foreach ($this->admin_testing_centers as $key => $value) {
            if(intval($value['testing_center_id'])>0 ){
                $valid = true;
                break;
            }
        }
        if(!$valid){
            $this->sign_up_button = 'Testing center Invalid';
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'title'             									=> 'Password doesn\'t match!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1000',
                'link'              									=> '#'
            ]);
            return false;
        }

        
        $min_age = 15;
        $min_date = $min_age * 366;
        $diff= date_diff(date_create($this->admin_birthdate),date_create(date('Y-m-d', time())));
        $date_diff =  intval($diff->format("%R%a"));
       
        // if(!$date_diff>$min_date){
        //     dd($date_diff);
        //     $this->sign_up_button = 'You must be at least '.$min_age.' y/o';
        //     $this->dispatchBrowserEvent('swal:redirect',[
        //         'position'          									=> 'center',
        //         'title'             									=> 'Admin must be at least '.$min_age.' y/o',
        //         'showConfirmButton' 									=> 'true',
        //         'timer'             									=> '1000',
        //         'link'              									=> '#'
        //     ]);
           
        //     return false;
        // }

        // hash password
        $hash_password = password_hash($this->admin_confirm_password, PASSWORD_ARGON2I);
        // validate access_roles

        DB::table('users')->insert([
            'user_status_id' => 1,
            'user_sex_id' => 1,
            'user_gender_id' => 1,
            'user_role_id' => 2,
            'user_name' => $this->admin_username,
            'user_email' => $this->admin_email,
            'user_phone' => NULL,
            'user_password' => $hash_password ,
            'user_name_verified' => 1,
            'user_email_verified' => 0,
            'user_phone_verified' => 0,
            'user_firstname' => $this->admin_firstname,
            'user_middlename' => $this->admin_middlename,
            'user_lastname' => $this->admin_lastname,
            'user_suffix' => NULL,
            'user_birthdate' => $this->admin_birthdate,
           
        ]);

        $user_details = DB::table('users as u')
            ->select('user_id')
            ->where('u.user_name', $this->admin_username)
            ->where('u.user_name_verified', 1)
            ->first();
           
        foreach ($this->admin_access_role as $key => $value) {
            DB::table('access_roles')->insert([
                'access_role_user_id' =>  $user_details->user_id,
                'access_role_module_id' =>$value['access_role_module_id'],
                'access_role_create' => $value['C'],
                'access_role_read' =>$value['R'],
                'access_role_update' => $value['U'],
                'access_role_delete' => $value['D'],
            ]);
        }

        foreach ($this->admin_testing_centers as $key => $value) {
            if(intval($value['testing_center_id'])>0 ){
                DB::table('admin_testing_centers')->insert([
                    'id' => NULL,
                    'user_id' =>$user_details->user_id,
                    'testing_center_id' =>$value['testing_center_id'],
                ]);
            }
        }

        $this->dispatchBrowserEvent('swal:remove_backdrop',[
            'position'          									=> 'center',
            'icon'                                                  => 'success',
            'title'             									=> 'Successfully added an admin!',
            'showConfirmButton' 									=> 'true',
            'timer'             									=> '1000',
            'link'              									=> '#'
        ]);
        $this->dispatchBrowserEvent('openModal','adminAddModal');
        $this->admin_role_name_id =false;

        $this->admin_data = DB::table('users as u')
        ->select(
            "user_id",
            "user_sex_id",
            "user_gender_id",
            "ur.user_role_id",
            "user_name",
            "user_email",
            "user_phone",
            "user_name_verified",
            "user_email_verified",
            "user_phone_verified",
            "user_firstname",
            "user_middlename",
            "user_lastname",
            "user_suffix",
           DB::raw('CONCAT(user_addr_street,", ",user_addr_brgy,", ",user_addr_city_mun,", ",user_addr_province,", ",user_addr_zip_code) as user_address'),
            "user_birthdate",
            "user_profile_picture",
            "user_formal_id",
            "u.date_created", 
            "u.date_updated",
            "user_status_details",
            "user_role_details"
            )
        ->join('user_status as us', 'us.user_status_id', '=', 'u.user_status_id')
        ->join('user_roles as ur', 'ur.user_role_id', '=', 'u.user_role_id')
        // ->where('user_id','!=', $this->user_details['user_id'])
        ->where('user_role_details','=', 'admin')
        ->get()
        ->toArray();

    }


    // role management

    public function new_role(){

        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($this->access_role['U'] ){
            $this->access_roles = [];
            foreach ($this->modules as $key => $value) {
                array_push($this->access_roles,[
                    'C'=>false,
                    'R'=>false,
                    'U'=>false,
                    'D'=>false
                ]);
            }
            $this->roles_data = DB::table('admin_role_names as arn')
                ->get()
                ->toArray();

            $this->dispatchBrowserEvent('openModal','AddRoleModal');
            
        }
    }

    public function role_all_crud($index){
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];
        
        if($this->access_role['U'] ){
            foreach ($this->access_roles as $key => $value) {
                if($key == $index){
                    $value['C'] = true;
                    $value['R'] = true;
                    $value['U'] = true;
                    $value['D'] = true;
                }
            }
        }
    }

    public function add_new_role(){
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];
        
        if($this->access_role['U'] ){

            if(DB::table('admin_role_names')
                ->where('admin_role_name_name','=',$this->access_role_name)
                ->get()
                ->first()){
                    $this->dispatchBrowserEvent('swal:remove_backdrop',[
                        'position'          									=> 'center',
                        'title'             									=> 'Role name exist!',
                        'showConfirmButton' 									=> 'true',
                        'timer'             									=> '1000',
                        'link'              									=> '#'
                    ]);
                    return;
            }else{
                DB::table('admin_role_names')->insert([
                    'admin_role_name_name' => $this->access_role_name,
                    'admin_role_name_details' =>$this->access_role_description,
                ]);

                $role_name_details =DB::table('admin_role_names')
                ->where('admin_role_name_name','=',$this->access_role_name)
                ->get()
                ->first();
                $role_name_id = $role_name_details->admin_role_name_id;

                foreach ($this->modules as $key => $value) {
                    DB::table('admin_roles')->insert([
                        'access_role_name_id' => $role_name_id ,
                        'access_role_module_id' => $value->module_id,
                        'access_role_create' => $this->access_roles[$key]['C'] ,
                        'access_role_read' => $this->access_roles[$key]['R'],
                        'access_role_update' => $this->access_roles[$key]['U'],
                        'access_role_delete' => $this->access_roles[$key]['D'],
                    ]);
                }
            }

            $this->dispatchBrowserEvent('swal:remove_backdrop',[
                'position'          									=> 'center',
                'icon'                                                  => 'success',
                'title'             									=> 'Successfully added a new role!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1000',
                'link'              									=> '#'
            ]);
            $this->access_role_name = null;
            $this->access_role_description = null;

            $this->roles_data = DB::table('admin_role_names as arn')
                ->get()
                ->toArray();
        }
    }

    public function view_role($admin_role_name_id){
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];
        
        if($this->access_role['U'] ){
            $this->role_name_details = DB::table('admin_role_names as arn')
                ->where('admin_role_name_id','=',$admin_role_name_id)
                ->get()
                ->toArray();
            $roles_data = DB::table('admin_roles as ar')
                ->where('access_role_name_id','=',$admin_role_name_id)
                ->get()
                ->toArray();
            
            $this->view_access_role = [];
            foreach ($roles_data as $key => $value) {
                array_push($this->view_access_role,[
                    'access_role_module_id' =>$value->access_role_module_id,
                    'C'=>$value->access_role_create,
                    'R'=>$value->access_role_create,
                    'U'=>$value->access_role_update,
                    'D'=>$value->access_role_delete
                ]);
            }

            $this->dispatchBrowserEvent('openModal','ViewRoleModal');
        }
    }

    public function edit_role($admin_role_name_id){
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];
        
        if($this->access_role['U'] ){

            $this->role_name_details = DB::table('admin_role_names as arn')
            ->where('admin_role_name_id','=',$admin_role_name_id)
            ->get()
            ->toArray();
            $roles_data = DB::table('admin_roles as ar')
            ->where('access_role_name_id','=',$admin_role_name_id)
            ->get()
            ->toArray();
            
            $this->edit_access_role = [];
            foreach ($roles_data as $key => $value) {
                array_push($this->edit_access_role,[
                    'access_role_id' =>$value->access_role_id,
                    'access_role_module_id' =>$value->access_role_module_id,
                    'C'=>$value->access_role_create,
                    'R'=>$value->access_role_create,
                    'U'=>$value->access_role_update,
                    'D'=>$value->access_role_delete
                ]);
            }
            $this->dispatchBrowserEvent('openModal','EditRoleModal');
            
        }
    }

    public function edit_selected_role(){
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];
        if($this->access_role['U'] ){
            if(DB::table('admin_role_names')
                ->where('admin_role_name_name','=',$this->role_name_details[0]['admin_role_name_name'])
                ->where('admin_role_name_id','!=', $this->role_name_details[0]['admin_role_name_id'])
                ->get()
                ->first()){
                    $this->dispatchBrowserEvent('swal:remove_backdrop',[
                        'position'          									=> 'center',
                        'title'             									=> 'Role name exist!',
                        'showConfirmButton' 									=> 'true',
                        'timer'             									=> '1000',
                        'link'              									=> '#'
                    ]);
                    return;
            }else{
                DB::table('admin_role_names')
                    ->where(['admin_role_name_id'=> $this->role_name_details[0]['admin_role_name_id']])
                    ->update([
                    'admin_role_name_name'=> $this->role_name_details[0]['admin_role_name_name'],
                    'admin_role_name_details'=> $this->role_name_details[0]['admin_role_name_details']
                ]);
                foreach ($this->edit_access_role as $key => $value) {
                    DB::table('admin_roles')
                        ->where(['access_role_id'=> $value['access_role_id']])
                        ->update([
                            'access_role_create'=> $value['C'],
                            'access_role_read'=> $value['R'],
                            'access_role_update'=> $value['U'],
                            'access_role_delete'=> $value['D']
                        ]);
                }
            }
            
            $this->roles_data = DB::table('admin_role_names as arn')
                ->get()
                ->toArray();
                
            $this->dispatchBrowserEvent('swal:remove_backdrop',[
                'position'          									=> 'center',
                'icon'                                                  => 'success',
                'title'             									=> 'Successfully updated the role!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1000',
                'link'              									=> '#'
            ]);
            
        }
    }
    public function delete_role($admin_role_name_id){

        $this->role_name_details = DB::table('admin_role_names as arn')
            ->where('admin_role_name_id','=',$admin_role_name_id)
            ->get()
            ->toArray();
        $roles_data = DB::table('admin_roles as ar')
            ->where('access_role_name_id','=',$admin_role_name_id)
            ->get()
            ->toArray();
        DB::table('admin_role_names')->where('admin_role_name_id', $this->role_name_details[0]->admin_role_name_id)->delete();

        foreach ($roles_data as $key => $value) {
            DB::table('admin_roles')->where('access_role_id',$value->access_role_id )->delete();
        }

        $this->roles_data = DB::table('admin_role_names as arn')
            ->get()
            ->toArray();

        $this->dispatchBrowserEvent('swal:remove_backdrop',[
            'position'          									=> 'center',
            'icon'                                                  => 'success',
            'title'             									=> 'Successfully deleted role!',
            'showConfirmButton' 									=> 'true',
            'timer'             									=> '1000',
            'link'              									=> '#'
        ]);
        
    }


    
}
