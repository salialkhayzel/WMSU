<?php

namespace App\Http\Livewire\Components\Footer;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class HomepageFooter extends Component
{
    public $footer_data;
    public function mount(){
        $this->footer_data = DB::table('footer_types')
        ->select('*')
        ->orderBy('footer_type_order')
        ->get()
        ->toArray();
    }
    public function render()
    {
        return view('livewire.components.footer.homepage-footer');
    }
}
