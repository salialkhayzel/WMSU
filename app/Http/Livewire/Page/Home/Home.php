<?php

namespace App\Http\Livewire\Page\Home;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Home extends Component
{
    public $user_detais;
    public $title;
    public $feature_data;
    public $aboutus_data;

    public function update_data(){
        $this->carousel_data = DB::table('carousel as c')
            ->select('*')
            ->orderBy('carousel_order')
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
        $this->wcu_data = DB::table('wcu')
            ->select('*')
            ->orderBy('wcu_order')
            ->get()
            ->toArray();
    }

    public function mount(Request $request){
        $this->user_details = $request->session()->all();
        $this->title = 'home';

        self::update_data();
    }
    public function render()
    {
        return view('livewire.page.home.home',[
            'user_details' => $this->user_details
            ])
            ->layout('layouts.guest-homepage',[
                'title'=>$this->title]);
    }
}
