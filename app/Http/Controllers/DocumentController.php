<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Document;

class DocumentController extends Controller
{
    public function index(){
        $documents = Document::all();
        
        return view('documents',compact('documents'));
    }
}
