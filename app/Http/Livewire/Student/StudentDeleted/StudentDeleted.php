<?php

namespace App\Http\Livewire\Student\StudentDeleted;

use Livewire\Component;

class StudentDeleted extends Component
{
    public function mount(){
        $this->title = 'deleted';
    }
    public function render()
    {
        return view('livewire.student.student-deleted.student-deleted',[
        ])
        ->layout('layouts.account-disabled',[
            'title'=>$this->title]);
    }
}
