<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        abort(404, 'Halaman tidak ditemukan atau dinonaktifkan.');
        // return view('settings.index');
    }
}
