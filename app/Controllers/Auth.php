<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function index()
    {
        // Redirect jika sudah login
        if (session()->has('user_id')) {
            return redirect()->to('/dashboard');
        }

        return view('auth/login');
    }

    public function login()
    {
        $userModel = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $userModel->authenticate($username, $password);

        if ($user) {
            session()->set([
                'user_id' => $user['id_user'],
                'username' => $user['username']
            ]);

            return redirect()->to('/dashboard');
        } else {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Username atau Password salah.');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth');
    }
}
