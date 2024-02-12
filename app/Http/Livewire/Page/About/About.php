<?php

namespace App\Http\Livewire\Page\About;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class About extends Component
{
    public $user_detais;
    public $title;

    public $aboutus_data ;
    public function booted(){

    }
    public function hydrate(){
        
    }
    public function update_data(){
        $this->aboutus_data = DB::table('aboutus')
                ->get()
                ->toArray();
    }

    public function mount(Request $request){
        $this->user_details = $request->session()->all();
        $this->title = 'about';

        self::update_data();
    }
    public function render()
    {
        return view('livewire.page.about.about',[
            'user_details' => $this->user_details
            ])
            ->layout('layouts.guest-homepage',[
                'title'=>$this->title]);
    }
}
