<?php

namespace App\Http\Livewire\Admin\Imports;
use Illuminate\Support\Collection; //added this bullshit to work. TOOK ME ALMOST 2 FUCKING HOURS TO DEBUG THIS SHT
use Livewire\Component;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportResults implements ToCollection

{
    public function collection(Collection $rows)
    {
        dd($rows);
        foreach ($rows as $row) 
        {
            // User::create([
            //     'name' => $row[0],
            // ]);
        }
    }
}



