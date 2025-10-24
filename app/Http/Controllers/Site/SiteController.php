<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function homeindex() {
        return view('home');
    }

    public function layananindex() {
        return view('layanan');
    }

    public function kontakindex() {
        return view('kontak');
    }

    public function loginindex() {
        return view('login');
    }
}
