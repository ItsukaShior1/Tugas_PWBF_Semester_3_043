<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KodeTindakan;

class KodeTindakanController extends Controller
{
    public function index()
    {
        
        $kodeTindakan = KodeTindakan::with(['kategori', 'kategoriKlinis'])->get();

        
        return view('admin.kode_tindakan.index', compact('kodeTindakan'));
    }
}
