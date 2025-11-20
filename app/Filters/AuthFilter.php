<?php

namespace App\Filters;

use App\Models\UserModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Filter autentikasi - validasi user sudah login dan masih ada di database
 */
class AuthFilter implements FilterInterface
{
    /**
     * @param RequestInterface $request
     * @param mixed $arguments
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/auth');
        }

        $userModel = new UserModel();
        $user = $userModel->find(session()->get('user_id'));

        if (!$user) {
            session()->destroy();
            return redirect()->to('/auth')
                ->with('error', 'Sesi Anda telah berakhir. User tidak ditemukan.');
        }
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param mixed $arguments
     * @return void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
