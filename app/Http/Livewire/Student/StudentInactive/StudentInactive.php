<?php

namespace App\Http\Livewire\Student\StudentInactive;

use Livewire\Component;

class StudentInactive extends Component
{    
    public function mount(){
        $this->title = 'inactive';
    }
    public function render()
    {
        return view('livewire.student.student-inactive.student-inactive',[
        ])
        ->layout('layouts.account-disabled',[
            'title'=>$this->title]);
    }
}
