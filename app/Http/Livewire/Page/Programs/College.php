<?php

namespace App\Http\Livewire\Page\Programs;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;


class College extends Component
{
    public $user_detais;
    public $title;

    public $college_data;
    public $college;
    public $college_id;
    public $department_data;

    public function booted(){

    }
    public function hydrate(){

    }
    public function update_data(){
        $this->college_data = DB::table('colleges')
            ->select('*')
            ->where('college_isactive','=',1)
            ->where('college_id','=',$this->college_id)
            ->orderBy('college_order')
            ->get()
            ->toArray();
        $this->department_data =DB::table('departments')
            ->where('department_college_id','=',$this->college_id)
            ->orderBy('department_order')
            ->get()
            ->toArray();
    }
    public function mount(Request $request, string $college_id){
        $this->college_id = $college_id;
        $this->user_details = $request->session()->all();
        $this->title = 'programs';

        self::update_data();
    }
    public function render()
    {
        return view('livewire.page.programs.college',[
            'user_details' => $this->user_details
            ]) 
            ->layout('layouts.guest-homepage',[
                'title'=>$this->title]);
    }
}
