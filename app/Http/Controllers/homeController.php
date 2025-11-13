<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class homeController extends Controller
{
    public function index()
    {
        // Jika Anda ingin melewatkan data dari server, letakkan di sini.
        // Saat ini view menangani data sampel di klien (Alpine.js).
        return view('home');
    }
}
