<?php

namespace App\Controllers;

/**
 * Controller untuk halaman home/welcome
 * Menampilkan halaman selamat datang aplikasi
 */
class Home extends BaseController
{
    /**
     * Menampilkan halaman welcome message
     * 
     * @return string View welcome message
     */
    public function index(): string
    {
        return view('welcome_message');
    }
}
