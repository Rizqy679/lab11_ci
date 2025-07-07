<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Selamat Datang',
            'content' => 'Ini adalah halaman utama menggunakan View Layout.'
        ];
        return view('home', $data);
    }
}
