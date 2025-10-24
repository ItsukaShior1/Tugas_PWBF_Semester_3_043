<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KodeTindakan;

class KodeTindakanController extends Controller
{
    public function index()
    {
        // Ambil semua data termasuk relasi
        $data = KodeTindakan::with(['kategori', 'kategoriKlinis'])->get();

        // Kirim ke view pakai variabel $data (biar sama dengan view lain)
        return view('admin.kode_tindakan.index', compact('data'));
    }
}
