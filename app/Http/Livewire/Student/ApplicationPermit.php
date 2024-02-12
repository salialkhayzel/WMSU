<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ApplicationPermit extends Component
{
    public $user_detais;
    public $title;
    public function mount(Request $request){
        $this->user_details = $request->session()->all();
        $this->title = 'application-back';
    }
    public function render()
    {
        return view('livewire.student.application-permit',[
            'user_details' => $this->user_details
            ])
            ;
    }
}
