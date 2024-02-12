<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Mail;

class Settings extends Component
{

    public $mail = true;

    
    use WithFileUploads;
    public $user_detais;
    public $title;

    public $active = 'Carousel';

    public $carousel_filter;
    public $carousel_data;
    public $edit_carousel_data;
    public $carousel_image_id ;
    public $carousel_id;
    public $carousel_header_title;
    public $carousel_content_image;
    public $carousel_paragraph_paragraph;

    // services
    public $services_filter;
    public $services_data;
    public $service = [
        'service_id'=> NULL,
        'service_logo'=>NULL,
        'service_header'=>'',
        'service_content'=> NULL
    ];

    // why choose us
    public $wcu_filter;
    public $wcu_data;
    public $wcu = [
        'wcu_id'=> NULL,
        'wcu_logo'=>NULL,
        'wcu_header'=>'',
        'wcu_content'=> NULL
    ];


    // faq
    public $faq_filter;
    public $faq_data;
    public $faq = [
        'faq_id'=> NULL,
        'faq_question'=>'',
        'faq_answer'=>'',
        'faq_order'=> NULL
    ];

    // feature
    public $feature_filter;
    public $feature_data;
    public $feature = [
        'feature_id'=> NULL,
        'feature_header'=>NULL,
        'feature_content'=>NULL,
        'feature_button_name'=> NULL,
        'feature_link'=> NULL
    ];

    // footer
    public $footer_filter;
    public $footer_data;
    public $footers;
    public $footer = [
        'footer_type_details'=> NULL,
        'footer_type_order'=> NULL
    ];
    public $footer_each =[
        'footer_id' => NULL,
        'footer_type_id' => NULL,
        'footer_icon' => NULL,
        'footer_content' => NULL,
        'footer_link' => NULL
    ];

    // about us
    public $aboutus_filter;
    public $aboutus_data;
    public $aboutus = [
        'au_id'=> NULL,
        'au_image'=> NULL,
        'au_header'=>NULL,
        'au_content'=>NULL,
    ];
    
    public $contactus_filter;
    public $contactus_data;
    public $contactus = [
        'cu_id' =>  NULL,
        'cu_icon' =>NULL,
        'cu_header' =>NULL,
        'cu_content' =>NULL,
        'cu_order' =>NULL
    ];
    // cta





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
        $this->carousel_data = DB::table('carousel as c')
                ->select('*')
                ->orderBy('carousel_order')
                ->get()
                ->toArray();

            $this->services_data = DB::table('services as c')
                ->select('*')
                ->orderBy('service_order')
                ->get()
                ->toArray();

            $this->faq_data = DB::table('faq as f')
                ->select('*')
                ->orderBy('faq_order')
                ->get()
                ->toArray();

            $this->wcu_data = DB::table('wcu')
                ->select('*')
                ->orderBy('wcu_order')
                ->get()
                ->toArray();

            $this->feature_data = DB::table('features')
                ->select('*')
                ->orderBy('feature_order')
                ->get()
                ->toArray();

            $this->aboutus_data = DB::table('aboutus')
                ->get()
                ->toArray();

            $this->footer_data = DB::table('footer_types')
                ->select('*')
                ->orderBy('footer_type_order')
                ->get()
                ->toArray();
            $this->contactus_data = DB::table('contact_us')
            ->select('*')
            ->orderBy('cu_order')
            ->get()
            ->toArray();
            

            
    }
    public function mount(Request $request){
        $this->user_details = $request->session()->all();
        $this->title = 'setting';
        
        $carousel_image_id = rand(0,1000000);
        $this->carousel_filter = [
            '#'=> true,
            'Carousel content'=> true,
            'Paragraphs'=> true,
            'Order'=> true,
            'Action'=> true,
        ];

        $this->services_filter = [
            '#'=> true,
            'Logo'=> true,
            'Header'=> true,
            'Content'=> true,
            'Order'=> true,
            'Action'=> true,
        ];

        // why choose us
        $this->wcu_filter = [
            '#'=> true,
            'Logo'=> true,
            'Header'=> true,
            'Content'=> true,
            'Order'=> true,
            'Action'=> true,
        ];  

        // faq
        $this->faq_filter = [
            '#'=> true,
            'Question'=> true,
            'Answer'=> true,
            'Order'=> true,
            'Action'=> true,
        ];

        $this->feature_filter = [
            '#'=> true,
            'Header'=> true,
            'Content'=> true,
            'Button name'=> true,
            'Link'=> true,
            'Order'=> true,
            'Action'=> true,
        ]; 

        // footer
        $this->footer_filter = [
            '#'=> true,
            'Header'=> true,
            'Content'=> true,
            'Order'=> false,
            'Action'=> true,
        ]; 
        

        // about us
        $this->aboutus_filter = [
            'Image'=> true,
            'Header'=> true,
            'Content'=> true,
            'Action'=> true,
        ]; 

        $this->contactus_filter = [
            '#'=> true,
            'Icon'=> true,
            'Header'=> true,
            'Content'=> true,
            'Order'=> true,
            'Action'=> true,
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
        return view('livewire.admin.settings',[
            'user_details' => $this->user_details
            ])
            ->layout('layouts.admin',[
                'title'=>$this->title]);
    }
    
    // carousel
    public function active_page($active){
        $this->active = $active;
        $this->edit_carousel_data = null;
    }
    public function view_carousel($carousel_id){
        $this->dispatchBrowserEvent('openModal','addRoomModal');
    }
    public function edit_carousel($carousel_id){
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($this->access_role['U'] ){
            $this->edit_carousel_data = DB::table('carousel as c')
            ->select('*')
            ->where('carousel_id','=',$carousel_id)
            ->get()
            ->toArray();

            $this->carousel_id = $this->edit_carousel_data[0]->carousel_id;
            $this->carousel_header_title = $this->edit_carousel_data[0]->carousel_header_title;
            $this->carousel_content_image = null;
            $this->carousel_paragraph_paragraph = $this->edit_carousel_data[0]->carousel_paragraph_paragraph;

        $this->dispatchBrowserEvent('openModal','EditCarouselModal');
        }
    }
    public function move_up_carousel($carousel_id){
        // get up
        $current_carousel = DB::table('carousel')
        ->where('carousel_id','=',$carousel_id)
        ->first();


        if($up_data = DB::table('carousel')
        ->where('carousel_order','<',$current_carousel->carousel_order)
        ->first()){
            DB::table('carousel as c')
                ->where('carousel_id','=',$current_carousel->carousel_id)
                ->update(['carousel_order'=>$up_data->carousel_order]);

            DB::table('carousel as c')
                ->where('carousel_id','=',$up_data->carousel_id)
                ->update(['carousel_order'=>$current_carousel->carousel_order]);

            $this->carousel_data = DB::table('carousel as c')
                ->select('*')
                ->orderBy('carousel_order')
                ->get()
                ->toArray();
        }

    }
    public function move_down_carousel($carousel_id){
        // get up
        $current_carousel = DB::table('carousel')
        ->where('carousel_id','=',$carousel_id)
        ->first();


        if($up_data = DB::table('carousel')
        ->where('carousel_order','>',$current_carousel->carousel_order)
        ->first()){
            DB::table('carousel as c')
                ->where('carousel_id','=',$current_carousel->carousel_id)
                ->update(['carousel_order'=>$up_data->carousel_order]);

            DB::table('carousel as c')
                ->where('carousel_id','=',$up_data->carousel_id)
                ->update(['carousel_order'=>$current_carousel->carousel_order]);

            $this->carousel_data = DB::table('carousel as c')
                ->select('*')
                ->orderBy('carousel_order')
                ->get()
                ->toArray();
        }

    }
    public function add_carousel(){
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($this->access_role['C'] ){
            // if(strlen())
            // validation

            // image
         
            if($this->carousel_content_image && file_exists(storage_path().'/app/livewire-tmp/'.$this->carousel_content_image->getfilename())){
                $file_extension =$this->carousel_content_image->getClientOriginalExtension();
                $tmp_name = 'livewire-tmp/'.$this->carousel_content_image->getfilename();
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
                        while(DB::table('carousel')
                        ->where(['carousel_content_image'=> $new_file_name,
                                'carousel_id'=>$this->carousel_id])
                        ->first()){
                            $new_file_name = md5($tmp_name.rand(1,10000000)).'.'.$file_extension;
                        }
                        if(Storage::move($tmp_name, 'public/content/carousel/'.$new_file_name)){

                            // delete old img
                            $this->carousel_content_image = $new_file_name;
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
                $this->carousel_image_id = rand(0,1000000);         
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
            
            $current_order = DB::table('carousel as c')
                ->select(DB::raw('count(*) as current_order'))
                ->first();

            if(DB::table('carousel')
                ->insert([
                    'carousel_header_title'=>$this->carousel_header_title,
                    'carousel_content_image' => $this->carousel_content_image,
                    'carousel_paragraph_paragraph' => $this->carousel_paragraph_paragraph,
                    'carousel_order' => ($current_order->current_order+1)
            ])){
                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'icon'              									=> 'success',
                    'title'             									=> 'Successfully updated carousel!',
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '1000',
                    'link'              									=> '#'
                ]);

                $this->carousel_header_title = null;
                $this->carousel_content_image = null;
                $this->carousel_paragraph_paragraph= null;
                $this->carousel_image_id = rand(0,1000000);         

                $this->carousel_data = DB::table('carousel as c')
                ->select('*')
                ->orderBy('carousel_order')
                ->get()
                ->toArray();

                $this->dispatchBrowserEvent('openModal','AddCarouselModal');
            }
        }
    }
    public function save_edit_carousel(){

        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($this->access_role['U'] ){
            // if(strlen())
            // validation

            // image
            $old_data = DB::table('carousel')
            ->where(['carousel_id'=>$this->carousel_id])
            ->first();
         
            if($this->carousel_content_image && file_exists(storage_path().'/app/livewire-tmp/'.$this->carousel_content_image->getfilename())){
                $file_extension =$this->carousel_content_image->getClientOriginalExtension();
                $tmp_name = 'livewire-tmp/'.$this->carousel_content_image->getfilename();
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
                        while(DB::table('carousel')
                        ->where(['carousel_content_image'=> $new_file_name,
                                'carousel_id'=>$this->carousel_id])
                        ->first()){
                            $new_file_name = md5($tmp_name.rand(1,10000000)).'.'.$file_extension;
                        }
                        if(Storage::move($tmp_name, 'public/content/carousel/'.$new_file_name)){

                            // delete old img
                           
                            $image_path = storage_path().'/app/public/content/carousel/'.$old_data->carousel_content_image;
                            if(file_exists($image_path)){
                                unlink($image_path);
                            }
                            $this->carousel_content_image = $new_file_name;
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
                $this->carousel_image_id = rand(0,1000000);         
            }else{
                $this->carousel_content_image =  $old_data->carousel_content_image;
            } 
            
           
            if(DB::table('carousel as c')
                ->where('carousel_id','=',$this->carousel_id)
                ->update([
                    'carousel_header_title'=>$this->carousel_header_title,
                    'carousel_content_image' => $this->carousel_content_image,
                    'carousel_paragraph_paragraph' => $this->carousel_paragraph_paragraph,
            ])){
                    $this->dispatchBrowserEvent('swal:redirect',[
                        'position'          									=> 'center',
                        'icon'              									=> 'success',
                        'title'             									=> 'Successfully updated carousel!',
                        'showConfirmButton' 									=> 'true',
                        'timer'             									=> '1000',
                        'link'              									=> '#'
                    ]);

                $this->carousel_data = DB::table('carousel as c')
                ->select('*')
                ->orderBy('carousel_order')
                ->get()
                ->toArray();

                $this->dispatchBrowserEvent('openModal','EditCarouselModal');
            }
        }
    }

    public function delete_carousel($carousel_id){ 
       

        if(                
            $current_carousel = DB::table('carousel')
            ->where('carousel_id','=',$carousel_id)
            ->first()

            ){ 
        
            DB::table('carousel')
            ->where('carousel_id','=',$carousel_id)
            ->delete();
            $image_path = storage_path().'/app/public/content/carousel/'.$current_carousel->carousel_content_image;
            if(file_exists($image_path)){
            unlink($image_path);
            }
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'success',
                'title'             									=> 'Successfully deleted carousel!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1000',
                'link'              									=> '#'
            ]);
        }
        // update order?
        $carousel_data = DB::table('carousel')
            ->orderBy('carousel_order')
            ->get()
            ->toArray();
        foreach ($carousel_data as $key => $value) {
            DB::table('carousel as c')
                ->where('carousel_id','=',$value->carousel_id)
                ->update(['carousel_order'=>$key ]);
        }

        $this->carousel_data = DB::table('carousel as c')
            ->select('*')
            ->orderBy('carousel_order')
            ->get()
            ->toArray();
        

    }
    public function carouselfilterView(){
        $this->dispatchBrowserEvent('swal:redirect',[
            'position'          									=> 'center',
            'icon'              									=> 'success',
            'title'             									=> 'Successfully changed filter!',
            'showConfirmButton' 									=> 'true',
            'timer'             									=> '1000',
            'link'              									=> '#'
        ]);
    }

    // services
    public function add_service(){
        $this->service = [
            'service_id'=> NULL,
            'service_logo'=>NULL,
            'service_header'=>'',
            'service_content'=> NULL
        ];
        $this->dispatchBrowserEvent('openModal','AddServiceModal');
    }
    public function save_add_service(){
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($this->access_role['C'] ){
            if(strlen($this->service['service_header'])<=0){
                return;
            }
            if(strlen($this->service['service_content'])<=0){
                return;
            }
            
            // validation

            // image
         
            if($this->service['service_logo'] && file_exists(storage_path().'/app/livewire-tmp/'.$this->service['service_logo']->getfilename())){
                $file_extension =$this->service['service_logo']->getClientOriginalExtension();
                $tmp_name = 'livewire-tmp/'.$this->service['service_logo']->getfilename();
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
                        while(DB::table('services')
                        ->where(['service_logo'=> $new_file_name])
                        ->first()){
                            $new_file_name = md5($tmp_name.rand(1,10000000)).'.'.$file_extension;
                        }
                        if(Storage::move($tmp_name, 'public/content/services/'.$new_file_name)){

                            // delete old img
                            $this->service['service_logo'] = $new_file_name;
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
                $this->carousel_image_id = rand(0,1000000);         
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
            
            $current_order = DB::table('services')
                ->select(DB::raw('count(*) as current_order'))
                ->first();

            if(DB::table('services')
                ->insert([
                    'service_logo'=>$this->service['service_logo'],
                    'service_header' => $this->service['service_header'],
                    'service_content' => $this->service['service_content'],
                    'service_order' => ($current_order->current_order+1)
            ])){
                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'icon'              									=> 'success',
                    'title'             									=> 'Successfully added!',
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '1000',
                    'link'              									=> '#'
                ]);
                $service = [
                    'service_id'=> NULL,
                    'service_logo'=>NULL,
                    'service_header'=>'',
                    'service_content'=> NULL
                ];

                self::update_data();
                $this->dispatchBrowserEvent('openModal','AddServiceModal');
            }
        }
    }
    public function edit_service($service_id){
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($this->access_role['U'] ){
            $service = DB::table('services')
                ->where('service_id','=',$service_id)
                ->first();
            $this->service = [
                'service_id'=> $service->service_id,
                'service_logo'=>NULL,
                'service_header'=>$service->service_header,
                'service_content'=> $service->service_content
            ];
            $this->dispatchBrowserEvent('openModal','EditServiceModal');
        }
    }
    public function save_edit_service($service_id){
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($this->access_role['C'] ){
            if(strlen($this->service['service_header'])<=0){
                return;
            }
            if(strlen($this->service['service_content'])<=0){
                return;
            }
            
            $current = DB::table('services')
                ->where('service_id','=',$service_id)
                ->first();

         
            if($this->service['service_logo'] && file_exists(storage_path().'/app/livewire-tmp/'.$this->service['service_logo']->getfilename())){
                $file_extension =$this->service['service_logo']->getClientOriginalExtension();
                $tmp_name = 'livewire-tmp/'.$this->service['service_logo']->getfilename();
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
                        while(DB::table('services')
                        ->where(['service_logo'=> $new_file_name])
                        ->first()){
                            $new_file_name = md5($tmp_name.rand(1,10000000)).'.'.$file_extension;
                        }
                        if(Storage::move($tmp_name, 'public/content/services/'.$new_file_name)){

                            // delete old img
                            $image_path = storage_path().'/app/public/content/services/'.$current->service_logo;;
                            if(file_exists($image_path)){
                                unlink($image_path);
                            }
                            $this->service['service_logo'] = $new_file_name;
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
                $this->carousel_image_id = rand(0,1000000);         
            }else{
                $this->service['service_logo'] = $current->service_logo;
            }
            if(DB::table('services')
                ->where('service_id','=',$service_id)
                ->update([
                    'service_logo'=>$this->service['service_logo'],
                    'service_header' => $this->service['service_header'],
                    'service_content' => $this->service['service_content'],
            ])){
                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'icon'              									=> 'success',
                    'title'             									=> 'Successfully updated!',
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '1000',
                    'link'              									=> '#'
                ]);
                $this->service = [
                    'service_id'=> NULL,
                    'service_logo'=>NULL,
                    'service_header'=>'',
                    'service_content'=> NULL
                ];

                self::update_data();
                $this->dispatchBrowserEvent('openModal','EditServiceModal');
            }
        }
    }
    public function delete_service($service_id){
        $current =  DB::table('services')
            ->where('service_id','=',$service_id)
            ->first();
        if( $current && 
            DB::table('services')
            ->where('service_id','=',$service_id)
            ->delete()
            ){

            $image_path = storage_path().'/app/public/content/services/'.$current->service_logo;;
            if(file_exists($image_path)){
                unlink($image_path);
            }
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'success',
                'title'             									=> 'Successfully deleted!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1000',
                'link'              									=> '#'
            ]);


            $services_data = DB::table('services as s')
                ->select('*')
                ->orderBy('service_order')
                ->get()
                ->toArray();

            foreach ($services_data as $key => $value) {
                DB::table('services as s')
                    ->where('service_id','=', $value->service_id)
                    ->update(['service_order'=>($key+1)]);
            }
            self::update_data(); 
        }
    }
    public function move_up_service($service_order){
        // get up
        $current = DB::table('services')
        ->where('service_order','=',$service_order)
        ->first();
     
        if($up_data = DB::table('services')
            ->where('service_order','<',$current->service_order)
            ->orderBy('service_order','desc')
            ->first()){
            DB::table('services')
                ->where('service_id','=',$current->service_id)
                ->update(['service_order'=>$up_data->service_order]);

            DB::table('services')
                ->where('service_id','=',$up_data->service_id)
                ->update(['service_order'=>$current->service_order]);

            self::update_data();
        }
    }
    public function move_down_service($service_order){
        // get up
        $current = DB::table('services')
        ->where('service_order','=',$service_order)
        ->first();
        
        if($down_data = DB::table('services')
        ->where('service_order','>',$current->service_order)
        ->orderBy('service_order')
        ->first()){
            DB::table('services')
                ->where('service_id','=',$current->service_id)
                ->update(['service_order'=>$down_data->service_order]);

            DB::table('services')
                ->where('service_id','=',$down_data->service_id)
                ->update(['service_order'=>$current->service_order]);

            self::update_data();
        }
    }



    // why choose us
    public function add_wcu(){
        $this->wcu = [
            'wcu_id'=> NULL,
            'wcu_logo'=>NULL,
            'wcu_header'=>'',
            'wcu_content'=> NULL
        ];
        $this->dispatchBrowserEvent('openModal','AddWCUModal');
    }
    public function save_add_wcu(){
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($this->access_role['C'] ){
            if(strlen($this->wcu['wcu_header'])<=0){
                return;
            }
            if(strlen($this->wcu['wcu_content'])<=0){
                return;
            }
            
            // validation

            // image
         
            if($this->wcu['wcu_logo'] && file_exists(storage_path().'/app/livewire-tmp/'.$this->wcu['wcu_logo']->getfilename())){
                $file_extension =$this->wcu['wcu_logo']->getClientOriginalExtension();
                $tmp_name = 'livewire-tmp/'.$this->wcu['wcu_logo']->getfilename();
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
                        while(DB::table('wcu')
                        ->where(['wcu_logo'=> $new_file_name])
                        ->first()){
                            $new_file_name = md5($tmp_name.rand(1,10000000)).'.'.$file_extension;
                        }
                        if(Storage::move($tmp_name, 'public/content/whychooseus/'.$new_file_name)){

                            // delete old img
                            $this->wcu['wcu_logo'] = $new_file_name;
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
                $this->carousel_image_id = rand(0,1000000);         
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
            
            $current_order = DB::table('wcu')
                ->select(DB::raw('count(*) as current_order'))
                ->first();

            if(DB::table('wcu')
                ->insert([
                    'wcu_logo'=>$this->wcu['wcu_logo'],
                    'wcu_header' => $this->wcu['wcu_header'],
                    'wcu_content' => $this->wcu['wcu_content'],
                    'wcu_order' => ($current_order->current_order+1)
            ])){
                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'icon'              									=> 'success',
                    'title'             									=> 'Successfully added!',
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '1000',
                    'link'              									=> '#'
                ]);
                $this->wcu = [
                    'wcu_id'=> NULL,
                    'wcu_logo'=>NULL,
                    'wcu_header'=>'',
                    'wcu_content'=> NULL
                ];

                self::update_data();
                $this->dispatchBrowserEvent('openModal','AddWCUModal');
            }
        }
    }
    public function edit_wcu($wcu_id){
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($this->access_role['U'] ){
            $wcu = DB::table('wcu')
                ->where('wcu_id','=',$wcu_id)
                ->first();
            $this->wcu = [
                'wcu_id'=> $wcu->wcu_id,
                'wcu_logo'=>NULL,
                'wcu_header'=>$wcu->wcu_header,
                'wcu_content'=> $wcu->wcu_content
            ];
            $this->dispatchBrowserEvent('openModal','EditWCUModal');
        }
    }
    public function save_edit_wcu($wcu_id){
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($this->access_role['C'] ){
            if(strlen($this->wcu['wcu_header'])<=0){
                return;
            }
            if(strlen($this->wcu['wcu_content'])<=0){
                return;
            }
            
            $current =  DB::table('wcu')
            ->where('wcu_id','=',$wcu_id)
            ->first();
         
            if($this->wcu['wcu_logo'] && file_exists(storage_path().'/app/livewire-tmp/'.$this->wcu['wcu_logo']->getfilename())){
                $file_extension =$this->wcu['wcu_logo']->getClientOriginalExtension();
                $tmp_name = 'livewire-tmp/'.$this->wcu['wcu_logo']->getfilename();
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
                        while(DB::table('wcu')
                        ->where(['wcu_logo'=> $new_file_name])
                        ->first()){
                            $new_file_name = md5($tmp_name.rand(1,10000000)).'.'.$file_extension;
                        }
                        if(Storage::move($tmp_name, 'public/content/whychooseus/'.$new_file_name)){

                            // delete old img
                            $image_path = storage_path().'/app/public/content/whychooseus/'.$current->wcu_logo;;
                            if(file_exists($image_path)){
                                unlink($image_path);
                            }
                            $this->wcu['wcu_logo'] = $new_file_name;
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
                $this->carousel_image_id = rand(0,1000000);         
            }else{
                $this->wcu['wcu_logo'] = $current->wcu_logo;
            }
            if(DB::table('wcu')
                ->where('wcu_id','=',$wcu_id)
                ->update([
                    'wcu_logo'=>$this->wcu['wcu_logo'],
                    'wcu_header' => $this->wcu['wcu_header'],
                    'wcu_content' => $this->wcu['wcu_content'],
            ])){
                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'icon'              									=> 'success',
                    'title'             									=> 'Successfully updated!',
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '1000',
                    'link'              									=> '#'
                ]);
                $this->wcu = [
                    'wcu_id'=> NULL,
                    'wcu_logo'=>NULL,
                    'wcu_header'=>'',
                    'wcu_content'=> NULL
                ];

                self::update_data();
                $this->dispatchBrowserEvent('openModal','EditWCUModal');
            }
        }
    }
    public function delete_wcu($wcu_id){
        $current =  DB::table('wcu')
            ->where('wcu_id','=',$wcu_id)
            ->first();
        if( $current && 
            DB::table('wcu')
            ->where('wcu_id','=',$wcu_id)
            ->delete()
            ){

            $image_path = storage_path().'/app/public/content/whychooseus/'.$current->wcu_logo;;
            if(file_exists($image_path)){
                unlink($image_path);
            }
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'success',
                'title'             									=> 'Successfully deleted!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1000',
                'link'              									=> '#'
            ]);

            $wcu_data = DB::table('wcu')
            ->select('*')
            ->orderBy('wcu_order')
            ->get()
            ->toArray();
            foreach ($wcu_data as $key => $value) {
                DB::table('wcu')
                    ->where('wcu_id','=', $value->wcu_id)
                    ->update(['wcu_order'=>($key+1)]);
            }

            self::update_data(); 
        }
    }
    public function move_up_wcu($wcu_order){
        // get up
        $current = DB::table('wcu')
        ->where('wcu_order','=',$wcu_order)
        ->first();
     
        if($up_data = DB::table('wcu')
            ->where('wcu_order','<',$current->wcu_order)
            ->orderBy('wcu_order','desc')
            ->first()){
            DB::table('wcu')
                ->where('wcu_id','=',$current->wcu_id)
                ->update(['wcu_order'=>$up_data->wcu_order]);

            DB::table('wcu')
                ->where('wcu_id','=',$up_data->wcu_id)
                ->update(['wcu_order'=>$current->wcu_order]);

            self::update_data();
        }
    }
    public function move_down_wcu($wcu_order){
        // get up
        $current = DB::table('wcu')
        ->where('wcu_order','=',$wcu_order)
        ->first();
        
        if($down_data = DB::table('wcu')
        ->where('wcu_order','>',$current->wcu_order)
        ->orderBy('wcu_order')
        ->first()){
            DB::table('wcu')
                ->where('wcu_id','=',$current->wcu_id)
                ->update(['wcu_order'=>$down_data->wcu_order]);

            DB::table('wcu')
                ->where('wcu_id','=',$down_data->wcu_id)
                ->update(['wcu_order'=>$current->wcu_order]);

            self::update_data();
        }
    }

    // faq
    public function add_faq(){
        $this->faq = [
            'faq_id'=> NULL,
            'faq_question'=>'',
            'faq_answer'=>'',
            'faq_order'=> NULL
        ];
        $this->dispatchBrowserEvent('openModal','AddFAQModal');
    }
    public function save_add_faq(){
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($this->access_role['C'] ){
            if(strlen($this->faq['faq_question'])<=0){
                return;
            }
            if(strlen($this->faq['faq_answer'])<=0){
                return;
            }

            $current_order = DB::table('faq as f')
            ->select(DB::raw('count(*) as current_order'))
            ->first();

            if(DB::table('faq')
                ->insert([
                'faq_id' => NULL,
                'faq_question' => $this->faq['faq_question'],
                'faq_answer' => $this->faq['faq_answer'],
                'faq_order' =>($current_order->current_order+1)
            ])){
                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'icon'              									=> 'success',
                    'title'             									=> 'Successfully added!',
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '1000',
                    'link'              									=> '#'
                ]);

                $this->faq = [
                    'faq_id'=> NULL,
                    'faq_question'=>'',
                    'faq_answer'=>'',
                    'faq_order'=> NULL
                ];

                self::update_data();
                $this->dispatchBrowserEvent('openModal','AddFAQModal');
            }
        }
    }
    public function edit_faq($faq_id){

        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($this->access_role['U'] ){
            $this->faq = DB::table('faq as f')
                ->select('*')
                ->where('f.faq_id','=',$faq_id)
                ->first();

                
            $this->dispatchBrowserEvent('openModal','EditFAQModal');
            $this->faq = [
                'faq_id'=> $this->faq->faq_id,
                'faq_question'=>$this->faq->faq_question,
                'faq_answer'=>$this->faq->faq_answer,
                'faq_order'=> NULL
            ];
        }
    }
    public function save_edit_faq($faq_id){
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($this->access_role['U'] ){
          
            if(DB::table('faq as f')
                ->where('faq_id','=',$faq_id)
                ->update([
                    'faq_question' => $this->faq['faq_question'],
                    'faq_answer' => $this->faq['faq_answer']
            ])){
                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'icon'              									=> 'success',
                    'title'             									=> 'Successfully saved!',
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '1000',
                    'link'              									=> '#'
                ]);
            }

            $this->faq = [
                'faq_id'=> NULL,
                'faq_question'=>'',
                'faq_answer'=>'',
                'faq_order'=> NULL
            ];

            self::update_data();
            $this->dispatchBrowserEvent('openModal','EditFAQModal');
        }
    }
    public function delete_faq($faq_id){
        if(
            
            $this->faq = DB::table('faq as f')
            ->select('*')
            ->where('f.faq_id','=',$faq_id)
            ->first()
            ){   
                
         

            $this->faq = [
                'faq_id'=> $this->faq->faq_id,
                'faq_question'=>$this->faq->faq_question,
                'faq_answer'=>$this->faq->faq_answer,
                'faq_order'=> NULL
            ];
            $this->dispatchBrowserEvent('openModal','DeleteFAQModal');
 
            $faq_data = DB::table('faq as f')
            ->select('*')
            ->orderBy('faq_order')
            ->get()
            ->toArray();
            foreach ($faq_data as $key => $value) {
                DB::table('faq')
                    ->where('faq_id','=', $value->faq_id)
                    ->update(['faq_order'=>($key+1)]);
            }
            self::update_data(); 
        }
    }
    public function confirm_delete_faq($faq_id)
    {
        if(
            DB::table('faq')
            ->where('faq_id','=',$faq_id)
            ->delete()
            ){
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'success',
                'title'             									=> 'Successfully deleted!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1000',
                'link'              									=> '#'
            ]);
            $this->dispatchBrowserEvent('openModal','DeleteFAQModal');
            $faq_data = DB::table('faq as f')
            ->select('*')
            ->orderBy('faq_order')
            ->get()
            ->toArray();
            foreach ($faq_data as $key => $value) {
                DB::table('faq')
                    ->where('faq_id','=', $value->faq_id)
                    ->update(['faq_order'=>($key+1)]);
            }
            self::update_data(); 
        }
    }

    public function move_up_faq($faq_order){
        // get up
        $current = DB::table('faq')
        ->where('faq_order','=',$faq_order)
        ->first();
     
        if($up_data = DB::table('faq')
            ->where('faq_order','<',$current->faq_order)
            ->orderBy('faq_order','desc')
            ->first()){
            DB::table('faq')
                ->where('faq_id','=',$current->faq_id)
                ->update(['faq_order'=>$up_data->faq_order]);

            DB::table('faq')
                ->where('faq_id','=',$up_data->faq_id)
                ->update(['faq_order'=>$current->faq_order]);

            self::update_data();
        }
    }
    public function move_down_faq($faq_order){
        // get up
        $current = DB::table('faq')
        ->where('faq_order','=',$faq_order)
        ->first();
        
        if($down_data = DB::table('faq')
        ->where('faq_order','>',$current->faq_order)
        ->orderBy('faq_order')
        ->first()){
            DB::table('faq')
                ->where('faq_id','=',$current->faq_id)
                ->update(['faq_order'=>$down_data->faq_order]);

            DB::table('faq')
                ->where('faq_id','=',$down_data->faq_id)
                ->update(['faq_order'=>$current->faq_order]);

            self::update_data();
        }
    }
    
    // feature
    public function add_feature(){
        $this->feature = [
            'feature_id'=> NULL,
            'feature_header'=>NULL,
            'feature_content'=>NULL,
            'feature_button_name'=> NULL,
            'feature_link'=> NULL
        ];
        $this->dispatchBrowserEvent('openModal','AddFeatureModal');
    }
    public function save_add_feature(){
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($this->access_role['C'] ){
            if(strlen($this->feature['feature_header'])<=0){
                return;
            }
            if(strlen($this->feature['feature_content'])<=0){
                return;
            }
            if(strlen($this->feature['feature_button_name'])<=0){
                return;
            }
            if(strlen($this->feature['feature_link'])<=0){
                return;
            }

            $current_order = DB::table('features')
            ->select(DB::raw('count(*) as current_order'))
            ->first();

            if(DB::table('features')
                ->insert([
                'feature_id'=> NULL,
                'feature_header'=>$this->feature['feature_header'],
                'feature_content'=>$this->feature['feature_content'],
                'feature_button_name'=> $this->feature['feature_button_name'],
                'feature_link'=> $this->feature['feature_link'],
                'feature_order' =>($current_order->current_order+1)
                ])){
                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'icon'              									=> 'success',
                    'title'             									=> 'Successfully added!',
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '1000',
                    'link'              									=> '#'
                ]);
                self::update_data();
                $this->dispatchBrowserEvent('openModal','AddFeatureModal');
            }
        }
    }
    public function edit_feature($feature_id){
        
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($this->access_role['U'] ){
            $this->feature = DB::table('features as f')
                ->select('*')
                ->where('f.feature_id','=',$feature_id)
                ->first();
            
            $this->feature = [
                'feature_id'=> $this->feature->feature_id,
                'feature_header'=>$this->feature->feature_header,
                'feature_content'=>$this->feature->feature_content,
                'feature_button_name'=> $this->feature->feature_button_name,
                'feature_link'=> $this->feature->feature_link
            ];
            $this->dispatchBrowserEvent('openModal','EditFeatureModal');
        }
        
    }
    public function save_edit_feature($feature_id){
        
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($this->access_role['U'] ){
            if(strlen($this->feature['feature_header'])<=0){
                return;
            }
            if(strlen($this->feature['feature_content'])<=0){
                return;
            }
            if(strlen($this->feature['feature_button_name'])<=0){
                return;
            }
            if(strlen($this->feature['feature_link'])<=0){
                return;
            }

            $current_order = DB::table('features')
            ->select(DB::raw('count(*) as current_order'))
            ->first();

            if(DB::table('features as f')
                ->where('f.feature_id','=',$feature_id)
                ->update([
                'feature_header'=>$this->feature['feature_header'],
                'feature_content'=>$this->feature['feature_content'],
                'feature_button_name'=> $this->feature['feature_button_name'],
                'feature_link'=> $this->feature['feature_link']
                ])){
                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'icon'              									=> 'success',
                    'title'             									=> 'Successfully updated!',
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '1000',
                    'link'              									=> '#'
                ]);
                self::update_data();
                $this->dispatchBrowserEvent('openModal','EditFeatureModal');
            }
        }
    }
    public function delete_feature($feature_id){
        if(
            // DB::table('features as f')
            // ->where('f.feature_id','=',$feature_id)
            // ->delete() bug fixed
            DB::table('features')
            ->where('feature_id', '=', $feature_id)
            ->delete()

            ){
            $this->dispatchBrowserEvent('swal:redirect',[
                'position'          									=> 'center',
                'icon'              									=> 'success',
                'title'             									=> 'Successfully deleted!',
                'showConfirmButton' 									=> 'true',
                'timer'             									=> '1000',
                'link'              									=> '#'
            ]);
            $feature_data = DB::table('features')
            ->select('*')
            ->orderBy('feature_order')
            ->get()
            ->toArray();
            foreach ($feature_data as $key => $value) {
                DB::table('features')
                    ->where('feature_id','=', $value->feature_id)
                    ->update(['feature_order'=>($key+1)]);
            }

            self::update_data(); 
        }
    }
    public function move_up_feature($feature_order){
        // get up
        $current = DB::table('features')
        ->where('feature_order','=',$feature_order)
        ->first();
     
        if($up_data = DB::table('features')
            ->where('feature_order','<',$current->feature_order)
            ->orderBy('feature_order','desc')
            ->first()){
            DB::table('features')
                ->where('feature_id','=',$current->feature_id)
                ->update(['feature_order'=>$up_data->feature_order]);

            DB::table('features')
                ->where('feature_id','=',$up_data->feature_id)
                ->update(['feature_order'=>$current->feature_order]);

            self::update_data();
        }
    }
    public function move_down_feature($feature_order){
        // get up
        $current = DB::table('features')
        ->where('feature_order','=',$feature_order)
        ->first();
        
        if($down_data = DB::table('features')
        ->where('feature_order','>',$current->feature_order)
        ->orderBy('feature_order')
        ->first()){
            DB::table('features')
                ->where('feature_id','=',$current->feature_id)
                ->update(['feature_order'=>$down_data->feature_order]);

            DB::table('features')
                ->where('feature_id','=',$down_data->feature_id)
                ->update(['feature_order'=>$current->feature_order]);

            self::update_data();
        }
    }

    // footer
    public function add_footer(){
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($this->access_role['C'] ){
            $this->footer = [
                'footer_type_details'=> NULL,
                'footer_type_order'=> NULL
            ];
            $this->dispatchBrowserEvent('openModal','AddFooterTypeModal');
        }
    }
    public function save_add_footer(){
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($this->access_role['C'] ){
            if(strlen($this->footer['footer_type_details'])<=0){
                return;
            }
            $current_order = DB::table('footer_types')
            ->select(DB::raw('count(*) as current_order'))
            ->first();

            if(DB::table('footer_types')
                ->insert([
                'footer_type_id' => NULL,
                'footer_type_details' => $this->footer['footer_type_details'], 
                'footer_type_order' =>($current_order->current_order+1)
            ])){
                self::update_data();
                $this->dispatchBrowserEvent('openModal','AddFooterTypeModal');
            }
            
        }
    }
    public function add_footer_in_type($footer_type_id){
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($this->access_role['C'] ){
            if($footer_type = DB::table('footer_types')
                ->where('footer_type_id','=',$footer_type_id)
                ->first()){
            }
            $this->footer = [
                'footer_type_details'=> $footer_type->footer_type_details,
                'footer_type_order'=> NULL
            ];

            $this->footer_each =[
                'footer_id' => NULL,
                'footer_type_id' => $footer_type->footer_type_id,
                'footer_icon' => NULL,
                'footer_content' => NULL,
                'footer_link' => NULL
            ];
            $this->dispatchBrowserEvent('openModal','AddFooterModal');
        }
    }
    public function save_add_footer_in_type($footer_type_id){
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($this->access_role['C'] ){
            if(strlen($this->footer_each['footer_content'])<=0){
                return;
            }
            if(intval($this->footer_each['footer_type_id'])<=0){
                return;
            }
            $current_order = DB::table('footer')
                ->where('footer_type_id','=',$footer_type_id)
                ->select(DB::raw('count(*) as current_order'))
                ->first();
            if(DB::table('footer')
                ->insert([
                    'footer_id' => NULL,
                    'footer_type_id' => $this->footer_each['footer_type_id'],
                    'footer_icon' => $this->footer_each['footer_icon'],
                    'footer_content' => $this->footer_each['footer_content'],
                    'footer_link' => $this->footer_each['footer_link'],
                    'footer_order' => ($current_order->current_order +1)
                    ])){
                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'icon'              									=> 'success',
                    'title'             									=> 'Successfully added!',
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '1500',
                    'link'              									=> '#'
                ]);
                    
                self::update_data();
                $this->dispatchBrowserEvent('openModal','AddFooterModal');
            }
        }
    }
    public function edit_footer_in_type($footer_type_id){
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($this->access_role['C'] ){
            if($footer = DB::table('footer_types')
                ->where('footer_type_id','=',$footer_type_id)
                ->first()){
                $this->footer = [
                    'footer_type_id' => $footer_type_id,
                    'footer_type_details'=> $footer->footer_type_details
                ];
                $this->dispatchBrowserEvent('openModal','EditFooterTypeModal');
            }
        }
    }
    public function save_edit_footer_in_type($footer_type_id){
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($this->access_role['C'] ){
            if(strlen($this->footer['footer_type_details'])<=0){
                return;
            }
            if(DB::table('footer_types')
                ->where('footer_type_id','=',$footer_type_id)
                ->update(['footer_type_details'=>$this->footer['footer_type_details']])){

                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'icon'              									=> 'success',
                    'title'             									=> 'Successfully updated!',
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '1500',
                    'link'              									=> '#'
                ]);
                    
                self::update_data();
                $this->dispatchBrowserEvent('openModal','EditFooterTypeModal');
            }
        }
    }
    public function delete_footer_in_type($footer_type_id){
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($this->access_role['D'] ){
            if($footer = DB::table('footer_types')
                ->where('footer_type_id','=',$footer_type_id)
                ->first()){
                $this->footer = [
                    'footer_type_id' => $footer_type_id,
                    'footer_type_details'=> $footer->footer_type_details
                ];
                self::update_data();
                $this->dispatchBrowserEvent('openModal','DeleteFooterTypeModal');
            }
        }
    }
    public function delete_footer($footer_type_id){
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($this->access_role['D'] ){
            $footers = DB::table('footer')
            ->where('footer_type_id','=',$footer_type_id)
            ->orderBy('footer_order')
            ->get()
            ->toArray();
            foreach ($footers as $key => $value) {
                DB::table('footer')
                    ->where('footer_id','=',$value->footer_id)
                    ->delete();
            }
            DB::table('footer_types')
            ->where('footer_type_id','=',$footer_type_id)
            ->delete();

            $this->footer_data = DB::table('footer_types')
            ->select('*')
            ->orderBy('footer_type_order')
            ->get()
            ->toArray();

            foreach ($this->footer_data  as $key => $value) {
                DB::table('footer_types')
                ->where('footer_type_id','=',$value->footer_type_id)
                ->update(['footer_type_order'=>($key+1)]);
            }
            self::update_data();
            $this->dispatchBrowserEvent('openModal','DeleteFooterTypeModal');
        }
    }
    public function edit_footer_each($footer_id){
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($this->access_role['U'] ){
            if($footer_each = DB::table('footer')
                ->where('footer_id','=',$footer_id)
                ->first()){
                $this->footer_each =[
                    'footer_id' => $footer_each->footer_id,
                    'footer_type_id' => $footer_each->footer_type_id,
                    'footer_icon' => $footer_each->footer_icon,
                    'footer_content' => $footer_each->footer_content,
                    'footer_link' => $footer_each->footer_link
                ];
                self::update_data();
                $this->dispatchBrowserEvent('openModal','EditFooterModal');
            }
        }
    }
    public function save_edit_footer_each($footer_id){
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($this->access_role['C'] ){
            if(strlen($this->footer_each['footer_content'])<=0){
                return;
            }
            if(intval($this->footer_each['footer_type_id'])<=0){
                return;
            }
            if(DB::table('footer')
                ->where('footer_id','=',$this->footer_each['footer_id'])
                ->update([
                    'footer_icon' => $this->footer_each['footer_icon'],
                    'footer_content' => $this->footer_each['footer_content'],
                    'footer_link' => $this->footer_each['footer_link']
                ])){
                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'icon'              									=> 'success',
                    'title'             									=> 'Successfully updated!',
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '1500',
                    'link'              									=> '#'
                ]);
                self::update_data();
                $this->dispatchBrowserEvent('openModal','EditFooterModal');
            }
        }
    }
    public function delete_footer_each($footer_id){
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($this->access_role['D'] ){
            if($footer_each = DB::table('footer')
                ->where('footer_id','=',$footer_id)
                ->first()){
                $this->footer_each =[
                    'footer_id' => $footer_each->footer_id,
                    'footer_type_id' => $footer_each->footer_type_id,
                    'footer_icon' => $footer_each->footer_icon,
                    'footer_content' => $footer_each->footer_content,
                    'footer_link' => $footer_each->footer_link
                ];
                $this->dispatchBrowserEvent('openModal','DeleteFooterModal');
            }
        }
    }
    public function delete_edit_footer_each($footer_id){
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($this->access_role['D'] ){
            if(DB::table('footer')
                ->where('footer_id','=',$footer_id)
                ->delete()){
                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'icon'              									=> 'success',
                    'title'             									=> 'Successfully deleted!',
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '1500',
                    'link'              									=> '#'
                ]);
                $footer_each_data = DB::table('footer')
                    ->where('footer_type_id','=',$this->footer_each['footer_type_id'])
                    ->get()
                    ->toArray();
                foreach ($footer_each_data as $key => $value) {
                    DB::table('footer')
                        ->where('footer_id','=',$value->footer_id)
                        ->update(['footer_order'=>$key+1]);
                }
                self::update_data();
                $this->dispatchBrowserEvent('openModal','DeleteFooterModal');
            }
        }
    }


    // about us
    public function edit_aboutus($au_id){
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($this->access_role['U'] ){
            if($about_us = DB::table('aboutus')
            ->where('au_id','=',$au_id)
            ->first()){
        }
            $this->aboutus = [
                'au_id'=> $about_us->au_id,
                'au_image'=>NULL ,
                'au_header'=>$about_us->au_header,
                'au_content'=>$about_us->au_content,
            ];
            $this->dispatchBrowserEvent('openModal','EditAboutusModal');
        }
    }
    public function save_edit_aboutus($au_id){
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];
        $current = DB::table('aboutus')
            ->where('au_id','=',$au_id)
            ->first();
         

        if($this->access_role['U'] ){
            if($this->aboutus['au_image'] && file_exists(storage_path().'/app/livewire-tmp/'.$this->aboutus['au_image']->getfilename())){
                $file_extension =$this->aboutus['au_image']->getClientOriginalExtension();
                $tmp_name = 'livewire-tmp/'.$this->aboutus['au_image']->getfilename();
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
                        while(DB::table('aboutus')
                        ->where(['au_image'=> $new_file_name])
                        ->first()){
                            $new_file_name = md5($tmp_name.rand(1,10000000)).'.'.$file_extension;
                        }
                        if(Storage::move($tmp_name, 'public/content/about_us/'.$new_file_name)){

                            // delete old img
                            $image_path = storage_path().'/app/public/content/about_us/'.$current->au_image;;
                            if(file_exists($image_path)){
                                unlink($image_path);
                            }
                            $this->aboutus['au_image'] = $new_file_name;
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
                $this->carousel_image_id = rand(0,1000000);         
            }else{
                $this->aboutus['au_image'] = $current->au_image;
            }

            if(DB::table('aboutus')
                ->where('au_id','=',$au_id)
                ->update([
                    'au_image'=> $this->aboutus['au_image'] ,
                    'au_header'=> $this->aboutus['au_header'],
                    'au_content'=> $this->aboutus['au_content'],
                ])
                ){
                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'icon'              									=> 'success',
                    'title'             									=> 'Successfully updated!',
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '1500',
                    'link'              									=> '#'
                ]);
            }
            self::update_data();
            $this->dispatchBrowserEvent('openModal','EditAboutusModal');
        }
    }
        
    // cta

    public function add_contact(){
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($this->access_role['C'] ){
            $this->contactus = [
                'cu_id' =>  NULL,
                'cu_icon' =>NULL,
                'cu_header' =>NULL,
                'cu_content' =>NULL,
                'cu_order' =>NULL
            ];
            $this->dispatchBrowserEvent('openModal','AddContactModal');
        }
    }
    public function save_add_contact(){
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($this->access_role['C'] ){
            if(strlen($this->contactus['cu_header'])<=0){
                return;
            }
            if(strlen($this->contactus['cu_content'])<=0){
                return;
            }

            if($this->contactus['cu_icon'] && file_exists(storage_path().'/app/livewire-tmp/'.$this->contactus['cu_icon']->getfilename())){
                $file_extension =$this->contactus['cu_icon']->getClientOriginalExtension();
                $tmp_name = 'livewire-tmp/'.$this->contactus['cu_icon']->getfilename();
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
                        while(DB::table('contact_us')
                        ->where(['cu_icon'=> $new_file_name])
                        ->first()){
                            $new_file_name = md5($tmp_name.rand(1,10000000)).'.'.$file_extension;
                        }
                        if(Storage::move($tmp_name, 'public/content/contact_us/'.$new_file_name)){

                            // delete old img
                            $this->contactus['cu_icon'] = $new_file_name;
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
                $this->carousel_image_id = rand(0,1000000);         
            }else{
               
            }

            $current_order = DB::table('contact_us')
            ->select(DB::raw('count(*) as current_order'))
            ->first();

            if(DB::table('contact_us')
                ->insert([
                    'cu_id' =>  NULL,
                    'cu_icon' =>$this->contactus['cu_icon'],
                    'cu_header' =>$this->contactus['cu_header'],
                    'cu_content' =>$this->contactus['cu_content'],
                    'cu_order' =>($current_order->current_order+1)
                    ])){
                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'icon'              									=> 'success',
                    'title'             									=> 'Successfully added!',
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '1500',
                    'link'              									=> '#'
                ]);

                self::update_data();
                $this->dispatchBrowserEvent('openModal','AddContactModal');
            }
        }
    }
    public function edit_contact($cu_id){
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($this->access_role['U'] ){
            if($contactus = DB::table('contact_us')
                ->where('cu_id','=',$cu_id)
                ->first()){
                $this->contactus = [
                    'cu_id' =>  $contactus->cu_id,
                    'cu_icon' =>NULL,
                    'cu_header' =>$contactus->cu_header,
                    'cu_content' =>$contactus->cu_content,
                    'cu_order' =>NULL
                ];
                $this->dispatchBrowserEvent('openModal','EditContactModal');
            }
        }
    }
    public function save_edit_contact($cu_id){
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($this->access_role['U'] ){
            if(strlen($this->contactus['cu_header'])<=0){
                return;
            }
            if(strlen($this->contactus['cu_content'])<=0){
                return;
            }

            $contactus = DB::table('contact_us')
                ->where('cu_id','=',$cu_id)
                ->first();

            if($this->contactus['cu_icon'] && file_exists(storage_path().'/app/livewire-tmp/'.$this->contactus['cu_icon']->getfilename())){
                $file_extension =$this->contactus['cu_icon']->getClientOriginalExtension();
                $tmp_name = 'livewire-tmp/'.$this->contactus['cu_icon']->getfilename();
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
                        while(DB::table('contact_us')
                        ->where(['cu_icon'=> $new_file_name])
                        ->first()){
                            $new_file_name = md5($tmp_name.rand(1,10000000)).'.'.$file_extension;
                        }
                        if(Storage::move($tmp_name, 'public/content/contact_us/'.$new_file_name)){

                            // delete old img
                            $this->contactus['cu_icon'] = $new_file_name;
                          
                            $image_path = storage_path().'/app/public/content/contact_us/'.$contactus->cu_icon; 
                            if(file_exists($image_path)){
                                unlink($image_path);
                            }
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
                $this->carousel_image_id = rand(0,1000000);         
            }else{
                $this->contactus['cu_icon']  = $contactus->cu_icon; 
            }

            if(DB::table('contact_us')
                ->where('cu_id','=',$cu_id)
                ->update([
                    'cu_icon' =>$this->contactus['cu_icon'],
                    'cu_header' =>$this->contactus['cu_header'],
                    'cu_content' =>$this->contactus['cu_content'],
                    ])){
                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'icon'              									=> 'success',
                    'title'             									=> 'Successfully updated!',
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '1500',
                    'link'              									=> '#'
                ]);

                self::update_data();
                $this->dispatchBrowserEvent('openModal','EditContactModal');
            }
        }
    }
    public function delete_contact($cu_id){
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($this->access_role['D'] ){
            if($contactus = DB::table('contact_us')
                ->where('cu_id','=',$cu_id)
                ->first()){
                $this->contactus = [
                    'cu_id' =>  $contactus->cu_id,
                    'cu_icon' =>NULL,
                    'cu_header' =>$contactus->cu_header,
                    'cu_content' =>$contactus->cu_content,
                    'cu_order' =>NULL
                ];
                $this->dispatchBrowserEvent('openModal','DeleteContactModal');
            }
        }
    }
    public function save_delete_contact($cu_id){
        $this->access_role = [
            'C' => true,
            'R' => true,
            'U' => true,
            'D' => true
        ];

        if($this->access_role['D'] ){
            $contactus = DB::table('contact_us')
            ->where('cu_id','=',$cu_id)
            ->first();
            if(DB::table('contact_us')
                ->where('cu_id','=',$cu_id)
                ->delete()){

                $image_path = storage_path().'/app/public/content/contact_us/'.$contactus->cu_icon; 
                if(file_exists($image_path) && !is_dir($image_path)){
                    unlink($image_path);
                }
                $this->dispatchBrowserEvent('swal:redirect',[
                    'position'          									=> 'center',
                    'icon'              									=> 'success',
                    'title'             									=> 'Successfully deleted!',
                    'showConfirmButton' 									=> 'true',
                    'timer'             									=> '1500',
                    'link'              									=> '#'
                ]);

               

                foreach ($this->contactus_data as $key => $value) {
                    DB::table('contact_us')
                    ->where('cu_id','=',$value->cu_id)
                    ->update(['cu_order'=>$key+1]);    
                }
                $this->dispatchBrowserEvent('openModal','DeleteContactModal');
                self::update_data();
            }
        }
    }

    public function move_up_contact($cu_order){
        // get up
        $current = DB::table('contact_us')
        ->where('cu_order','=',$cu_order)
        ->first();
     
        if($up_data = DB::table('contact_us')
            ->where('cu_order','<',$current->cu_order)
            ->orderBy('cu_order','desc')
            ->first()){
            DB::table('contact_us')
                ->where('cu_id','=',$current->cu_id)
                ->update(['cu_order'=>$up_data->cu_order]);

            DB::table('contact_us')
                ->where('cu_id','=',$up_data->cu_id)
                ->update(['cu_order'=>$current->cu_order]);

            self::update_data();
        }
    }
    public function move_down_contact($cu_order){
        // get up
        $current = DB::table('contact_us')
        ->where('cu_order','=',$cu_order)
        ->first();
        
        if($down_data = DB::table('contact_us')
        ->where('cu_order','>',$current->cu_order)
        ->orderBy('cu_order')
        ->first()){
            DB::table('contact_us')
                ->where('cu_id','=',$current->cu_id)
                ->update(['cu_order'=>$down_data->cu_order]);

            DB::table('contact_us')
                ->where('cu_id','=',$down_data->cu_id)
                ->update(['cu_order'=>$current->cu_order]);

            self::update_data();
        }
    }
}
