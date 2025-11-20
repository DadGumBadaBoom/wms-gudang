<?php

use CodeIgniter\Boot;
use Config\Paths;

/*
 *---------------------------------------------------------------
 * CHECK PHP VERSION
 *---------------------------------------------------------------
 * PENTING: Memeriksa versi PHP minimum yang diperlukan
 * CodeIgniter 4 memerlukan PHP 8.1 atau lebih tinggi
 */

$minPhpVersion = '8.1'; // PENTING: Jika update ini, jangan lupa update `spark` juga
if (version_compare(PHP_VERSION, $minPhpVersion, '<')) {
    $message = sprintf(
        'Your PHP version must be %s or higher to run CodeIgniter. Current version: %s',
        $minPhpVersion,
        PHP_VERSION,
    );

    // Return HTTP 503 jika versi PHP tidak memenuhi
    header('HTTP/1.1 503 Service Unavailable.', true, 503);
    echo $message;

    exit(1);
}

/*
 *---------------------------------------------------------------
 * SET THE CURRENT DIRECTORY
 *---------------------------------------------------------------
 * Mengatur path dan working directory untuk aplikasi
 */

// Path ke front controller (file ini)
// FCPATH digunakan untuk referensi path ke folder public
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

// Pastikan working directory mengarah ke folder front controller
if (getcwd() . DIRECTORY_SEPARATOR !== FCPATH) {
    chdir(FCPATH);
}

/*
 *---------------------------------------------------------------
 * BOOTSTRAP THE APPLICATION
 *---------------------------------------------------------------
 * Proses bootstrap aplikasi:
 * - Setup path constants
 * - Load dan register autoloader (aplikasi dan Composer)
 * - Load constants
 * - Jalankan environment-specific bootstrapping
 */

// LOAD OUR PATHS CONFIG FILE
// PENTING: Baris ini mungkin perlu diubah jika struktur folder berubah
require FCPATH . '../app/Config/Paths.php';
// ^^^ Ubah baris ini jika Anda memindahkan folder aplikasi

$paths = new Paths();

// LOAD THE FRAMEWORK BOOTSTRAP FILE
// Memuat file bootstrap framework CodeIgniter
require $paths->systemDirectory . '/Boot.php';

// Jalankan bootstrap web dan exit dengan return code
exit(Boot::bootWeb($paths));
