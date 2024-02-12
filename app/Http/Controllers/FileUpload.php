<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUpload extends Controller
{
    public function upload_file(Request $request){
        // dd($request->file('file'));
        $path = $request->file('file')->storeAs('results','result.csv');
    }
}