<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisHewan;

class JenisHewanController extends Controller
{
    public function index()
    {
        $jenisHewan = JenisHewan::all();
        
        return view('admin.jenis_hewan.index', compact('jenisHewan'));
    }
}
