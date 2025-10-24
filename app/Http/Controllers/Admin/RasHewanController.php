<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RasHewan;

class RasHewanController extends Controller
{
    public function index()
    {
        $rasHewan = RasHewan::with('jenis')->get();
        return view('admin.ras_hewan.index', compact('rasHewan'));
    }
}
