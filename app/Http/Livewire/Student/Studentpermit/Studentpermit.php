<?php

namespace App\Http\Livewire\Student\Studentpermit;

use Livewire\Component;

class Studentpermit extends Component
{
    public function mount(){
        $this->title = 'student-permit';
    }
    public function render()
    {
        return view('livewire.student.studentpermit.studentpermit',[
            ])
            ->layout('layouts.exam-permit',[
                'title'=>$this->title]);
        
    }
}
