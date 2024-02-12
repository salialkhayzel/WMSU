<?php

namespace App\Http\Livewire\Page\Services;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Services extends Component
{
    public $user_detais;
    public $title;

    public function update_data(){
        $this->services_data = DB::table('services as c')
            ->select('*')
            ->orderBy('service_order')
            ->get()
            ->toArray();
    }

    public function mount(Request $request){
        $this->user_details = $request->session()->all();
        $this->title = 'services';
        self::update_data();
    }
    public function render()
    {
        return view('livewire.page.services.services',[
            'user_details' => $this->user_details
            ])
            ->layout('layouts.guest-homepage',[
                'title'=>$this->title]);
    }
}
