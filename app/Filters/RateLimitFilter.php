<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Filter untuk membatasi rate (kecepatan) request
 * Mencegah brute force attack dengan membatasi jumlah percobaan dalam waktu tertentu
 * Diterapkan pada route login
 */
class RateLimitFilter implements FilterInterface
{
    /**
     * Method yang dijalankan sebelum request diproses
     * Memeriksa jumlah percobaan berdasarkan IP address
     * Memblokir jika terlalu banyak percobaan dalam waktu window
     * 
     * @param RequestInterface $request Request object
     * @param mixed $arguments Arguments yang diteruskan ke filter
     * @return mixed Redirect dengan error jika melebihi limit, null jika masih dalam limit
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Konfigurasi rate limiting
        $maxAttempts = 5; // Maksimal 5 percobaan
        $timeWindow = 300; // 5 menit (300 detik) - waktu window untuk reset
        
        // Ambil IP address untuk tracking percobaan per IP
        $ip = $request->getIPAddress();
        // Generate key unik berdasarkan IP (dihash untuk keamanan)
        $key = 'login_attempts_' . md5($ip);
        
        // Ambil data percobaan dari session
        $attempts = session()->get($key);
        
        // Cek apakah sudah melebihi batas maksimal percobaan
        if ($attempts && $attempts['count'] >= $maxAttempts) {
            $timeElapsed = time() - $attempts['time'];
            
            // Jika masih dalam time window, blokir akses
            if ($timeElapsed < $timeWindow) {
                $remainingTime = $timeWindow - $timeElapsed;
                $minutes = ceil($remainingTime / 60);
                
                return redirect()->back()
                    ->withInput()
                    ->with('error', "Terlalu banyak percobaan login. Silakan coba lagi dalam {$minutes} menit.");
            } else {
                // Reset attempts setelah time window habis
                session()->remove($key);
            }
        }
    }

    /**
     * Method yang dijalankan setelah request diproses
     * Tidak melakukan apapun (kosong)
     * 
     * @param RequestInterface $request Request object
     * @param ResponseInterface $response Response object
     * @param mixed $arguments Arguments yang diteruskan ke filter
     * @return void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}

