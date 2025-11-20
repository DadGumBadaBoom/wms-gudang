<?php

/**
 * Entry point alternatif untuk menjalankan aplikasi dari root project
 * File ini memungkinkan akses aplikasi tanpa harus mengakses folder /public/
 * 
 * PENTING: File ini mengubah working directory ke folder public
 * dan memuat front controller dari public/index.php
 */

// Ubah working directory ke folder public
chdir(__DIR__ . DIRECTORY_SEPARATOR . 'public');

// Load front controller dari folder public
require_once __DIR__ . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'index.php';
