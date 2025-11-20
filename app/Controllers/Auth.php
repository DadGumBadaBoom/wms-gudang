<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

/**
 * Controller autentikasi - login/logout dengan rate limiting (5x/5menit per IP)
 */
class Auth extends Controller
{
    /**
     * @return mixed
     */
    public function index()
    {
        if (session()->has('user_id')) {
            $userModel = new UserModel();
            $user = $userModel->find(session()->get('user_id'));
            
            if ($user) {
                return redirect()->to('/dashboard');
            } else {
                session()->destroy();
            }
        }

        return view('auth/login');
    }

    /**
     * @return mixed
     */
    public function login()
    {
        // Rate limiting: 5 percobaan per 5 menit per IP
        $maxAttempts = 5;
        $timeWindow = 300;
        $ip = $this->request->getIPAddress();
        $key = 'login_attempts_' . md5($ip);
        
        $attempts = session()->get($key);
        
        if ($attempts && $attempts['count'] >= $maxAttempts) {
            $timeElapsed = time() - $attempts['time'];
            
            if ($timeElapsed < $timeWindow) {
                $minutes = ceil(($timeWindow - $timeElapsed) / 60);
                return redirect()->back()
                    ->withInput()
                    ->with('error', "Terlalu banyak percobaan login. Silakan coba lagi dalam {$minutes} menit.");
            } else {
                session()->remove($key);
            }
        }

        $userModel = new UserModel();
        $username = trim($this->request->getPost('username') ?? '');
        $password = $this->request->getPost('password') ?? '';

        if (empty($username) || empty($password)) {
            $this->incrementLoginAttempts($key);
            return redirect()->back()
                ->withInput()
                ->with('error', 'Username dan Password harus diisi.');
        }

        $user = $userModel->authenticate($username, $password);

        if ($user) {
            // Validasi user masih ada di database
            if (!$userModel->find($user['id_user'])) {
                $this->incrementLoginAttempts($key);
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'User tidak ditemukan atau telah dihapus.');
            }

            session()->remove($key);
            session()->set([
                'user_id' => $user['id_user'],
                'username' => $user['username']
            ]);

            return redirect()->to('/dashboard');
        } else {
            $this->incrementLoginAttempts($key);
            return redirect()->back()
                ->withInput()
                ->with('error', 'Username atau Password salah.');
        }
    }

    /**
     * @param string $key
     * @return void
     */
    private function incrementLoginAttempts($key)
    {
        $attempts = session()->get($key) ?: ['count' => 0, 'time' => time()];
        $attempts['count']++;
        $attempts['time'] = time();
        session()->set($key, $attempts);
    }

    /**
     * @return mixed
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth');
    }
}
