<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

/**
 * Controller user management - CRUD user dengan secret key (setup: user.admin.secret di .env)
 */
class UserController extends Controller
{
    /**
     * @return bool
     */
    private function checkAdminAccess()
    {
        if (session()->has('admin_access') && session()->get('admin_access') === true) {
            return true;
        }
        
        $secretKey = getenv('user.admin.secret') ?: 'admin123456';
        $providedKey = $this->request->getGet('key') ?: $this->request->getPost('key');
        
        if ($providedKey !== $secretKey) {
            return false;
        }
        
        session()->set('admin_access', true);
        return true;
    }

    /**
     * Halaman index - redirect langsung ke admin panel
     * Memerlukan secret key untuk akses
     * 
     * @return mixed Redirect ke admin panel atau ke login jika key tidak valid
     */
    public function index()
    {
        if (!$this->checkAdminAccess()) {
            return redirect()->to('/auth')
                ->with('error', 'Akses ditolak. Secret key tidak valid.');
        }

        $secretKey = getenv('user.admin.secret') ?: 'admin123456';
        $currentKey = $this->request->getGet('key') ?: $secretKey;

        // Langsung redirect ke admin panel dengan key
        return redirect()->to('/user/admin?key=' . $currentKey);
    }

    /**
     * Halaman admin - menampilkan daftar semua user
     * Memerlukan secret key untuk akses
     * 
     * @return mixed View admin panel atau redirect jika key tidak valid
     */
    public function admin()
    {
        if (!$this->checkAdminAccess()) {
            return redirect()->to('/user/index')
                ->with('error', 'Akses ditolak. Secret key tidak valid.');
        }

        $userModel = new UserModel();
        $users = $userModel->findAll();

        $data = [
            'users' => $users
        ];

        return view('user/admin', $data);
    }

    /**
     * Halaman form tambah user baru
     * Memerlukan secret key untuk akses
     * 
     * @return mixed View form create atau redirect jika key tidak valid
     */
    public function create()
    {
        if (!$this->checkAdminAccess()) {
            return redirect()->to('/auth')
                ->with('error', 'Akses ditolak. Secret key tidak valid.');
        }

        $secretKey = getenv('user.admin.secret') ?: 'admin123456';
        $currentKey = $this->request->getGet('key') ?: $secretKey;
        $fromAdmin = session()->get('admin_access') || $this->request->getGet('key');
        
        return view('user/create', [
            'fromAdmin' => $fromAdmin,
            'currentKey' => $currentKey
        ]);
    }

    /**
     * Menyimpan user baru ke database
     * Validasi input, hash password, dan simpan data
     * 
     * @return mixed Redirect ke admin panel dengan pesan sukses/error
     */
    public function store()
    {
        $userModel = new UserModel();

        // Ambil data dari form
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $confirmPassword = $this->request->getPost('confirm_password');

        // Validasi input menggunakan CodeIgniter Validation
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => [
                'rules' => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
                'errors' => [
                    'required' => 'Username harus diisi',
                    'min_length' => 'Username minimal 3 karakter',
                    'max_length' => 'Username maksimal 50 karakter',
                    'is_unique' => 'Username sudah digunakan'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Password harus diisi',
                    'min_length' => 'Password minimal 6 karakter'
                ]
            ],
            'confirm_password' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Konfirmasi password harus diisi',
                    'matches' => 'Konfirmasi password tidak cocok'
                ]
            ]
        ]);

        $secretKey = getenv('user.admin.secret') ?: 'admin123456';
        $currentKey = $this->request->getGet('key') ?: $this->request->getPost('key') ?: $secretKey;

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/user/create?key=' . $currentKey)
                ->withInput()
                ->with('errors', $validation->getErrors());
        }

        // Hash password menggunakan BCRYPT untuk keamanan
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Siapkan data untuk disimpan
        $data = [
            'username' => $username,
            'password' => $hashedPassword
        ];

        // Simpan ke database
        if ($userModel->insert($data)) {
            // Redirect ke admin setelah berhasil
            return redirect()->to('/user/admin?key=' . $currentKey)
                ->with('success', 'User berhasil ditambahkan!');
        } else {
            return redirect()->to('/user/create?key=' . $currentKey)
                ->withInput()
                ->with('error', 'Gagal menambahkan user. Silakan coba lagi.');
        }
    }

    /**
     * Halaman form edit user
     * Memerlukan secret key untuk akses
     * 
     * @param int $id ID user yang akan diedit
     * @return mixed View form edit atau redirect jika key tidak valid atau user tidak ditemukan
     */
    public function edit($id)
    {
        if (!$this->checkAdminAccess()) {
            return redirect()->to('/auth')
                ->with('error', 'Akses ditolak. Secret key tidak valid.');
        }

        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            $secretKey = getenv('user.admin.secret') ?: 'admin123456';
            return redirect()->to('/user/admin?key=' . $secretKey)
                ->with('error', 'User tidak ditemukan.');
        }

        $secretKey = getenv('user.admin.secret') ?: 'admin123456';
        $currentKey = $this->request->getGet('key') ?: $secretKey;

        return view('user/edit', [
            'user' => $user,
            'currentKey' => $currentKey
        ]);
    }

    /**
     * Update data user
     * Validasi input, update username dan/atau password jika diisi
     * 
     * @param int $id ID user yang akan diupdate
     * @return mixed Redirect ke admin panel dengan pesan sukses/error
     */
    public function update($id)
    {
        if (!$this->checkAdminAccess()) {
            return redirect()->to('/auth')
                ->with('error', 'Akses ditolak. Secret key tidak valid.');
        }

        $userModel = new UserModel();
        $user = $userModel->find($id);

        // Validasi user exists
        if (!$user) {
            $secretKey = getenv('user.admin.secret') ?: 'admin123456';
            return redirect()->to('/user/admin?key=' . $secretKey)
                ->with('error', 'User tidak ditemukan.');
        }

        // Ambil data dari form
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $confirmPassword = $this->request->getPost('confirm_password');

        // Validasi username - cek unique hanya jika username berubah
        $usernameRules = 'required|min_length[3]|max_length[50]';
        if ($username !== $user['username']) {
            $usernameRules .= '|is_unique[users.username]'; // Cek unique jika username berbeda
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => [
                'rules' => $usernameRules,
                'errors' => [
                    'required' => 'Username harus diisi',
                    'min_length' => 'Username minimal 3 karakter',
                    'max_length' => 'Username maksimal 50 karakter',
                    'is_unique' => 'Username sudah digunakan'
                ]
            ],
            'password' => [
                'rules' => 'permit_empty|min_length[6]',
                'errors' => [
                    'min_length' => 'Password minimal 6 karakter'
                ]
            ],
            'confirm_password' => [
                'rules' => 'permit_empty|matches[password]',
                'errors' => [
                    'matches' => 'Konfirmasi password tidak cocok'
                ]
            ]
        ]);

        $secretKey = getenv('user.admin.secret') ?: 'admin123456';
        $currentKey = $this->request->getGet('key') ?: $this->request->getPost('key') ?: $secretKey;

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/user/edit/' . $id . '?key=' . $currentKey)
                ->withInput()
                ->with('errors', $validation->getErrors());
        }

        // Siapkan data untuk diupdate
        $data = ['username' => $username];
        
        // Update password hanya jika diisi (optional)
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_BCRYPT);
        }

        // Update ke database
        if ($userModel->update($id, $data)) {
            return redirect()->to('/user/admin?key=' . $currentKey)
                ->with('success', 'User berhasil diupdate!');
        } else {
            return redirect()->to('/user/edit/' . $id . '?key=' . $currentKey)
                ->withInput()
                ->with('error', 'Gagal mengupdate user. Silakan coba lagi.');
        }
    }

    /**
     * Menghapus user dari database
     * Memerlukan secret key untuk akses
     * 
     * @param int $id ID user yang akan dihapus
     * @return mixed Redirect ke admin panel dengan pesan sukses/error
     */
    public function delete($id)
    {
        if (!$this->checkAdminAccess()) {
            return redirect()->to('/auth')
                ->with('error', 'Akses ditolak. Secret key tidak valid.');
        }

        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            $secretKey = getenv('user.admin.secret') ?: 'admin123456';
            return redirect()->to('/user/admin?key=' . $secretKey)
                ->with('error', 'User tidak ditemukan.');
        }

        if ($userModel->delete($id)) {
            $secretKey = getenv('user.admin.secret') ?: 'admin123456';
            return redirect()->to('/user/admin?key=' . $secretKey)
                ->with('success', 'User berhasil dihapus!');
        } else {
            $secretKey = getenv('user.admin.secret') ?: 'admin123456';
            return redirect()->to('/user/admin?key=' . $secretKey)
                ->with('error', 'Gagal menghapus user. Silakan coba lagi.');
        }
    }

    /**
     * Halaman form ganti password
     * Memerlukan secret key untuk akses
     * 
     * @return mixed View form change password atau redirect jika key tidak valid
     */
    public function changePassword()
    {
        if (!$this->checkAdminAccess()) {
            return redirect()->to('/auth')
                ->with('error', 'Akses ditolak. Secret key tidak valid.');
        }

        $secretKey = getenv('user.admin.secret') ?: 'admin123456';
        $currentKey = $this->request->getGet('key') ?: $secretKey;

        return view('user/change_password', ['currentKey' => $currentKey]);
    }

    /**
     * Proses update password user
     * Validasi password lama, kemudian update dengan password baru
     * Memerlukan secret key untuk akses
     * 
     * @return mixed Redirect dengan pesan sukses/error
     */
    public function updatePassword()
    {
        if (!$this->checkAdminAccess()) {
            return redirect()->to('/auth')
                ->with('error', 'Akses ditolak. Secret key tidak valid.');
        }

        // Ambil data dari form
        $username = $this->request->getPost('username');
        $oldPassword = $this->request->getPost('old_password');
        $newPassword = $this->request->getPost('new_password');
        $confirmPassword = $this->request->getPost('confirm_password');

        $userModel = new UserModel();

        // Validasi input menggunakan CodeIgniter Validation
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => [
                'rules' => 'required',
                'errors' => ['required' => 'Username harus diisi']
            ],
            'old_password' => [
                'rules' => 'required',
                'errors' => ['required' => 'Password lama harus diisi']
            ],
            'new_password' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Password baru harus diisi',
                    'min_length' => 'Password baru minimal 6 karakter'
                ]
            ],
            'confirm_password' => [
                'rules' => 'required|matches[new_password]',
                'errors' => [
                    'required' => 'Konfirmasi password harus diisi',
                    'matches' => 'Konfirmasi password tidak cocok'
                ]
            ]
        ]);

        $secretKey = getenv('user.admin.secret') ?: 'admin123456';
        $currentKey = $this->request->getGet('key') ?: $this->request->getPost('key') ?: $secretKey;

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/user/change-password?key=' . $currentKey)
                ->withInput()
                ->with('errors', $validation->getErrors());
        }

        // Cek user dan password lama - validasi autentikasi
        $user = $userModel->authenticate($username, $oldPassword);

        if (!$user) {
            return redirect()->to('/user/change-password?key=' . $currentKey)
                ->withInput()
                ->with('error', 'Username atau password lama salah.');
        }

        // Hash password baru menggunakan BCRYPT
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        
        // Update password di database
        if ($userModel->update($user['id_user'], ['password' => $hashedPassword])) {
            return redirect()->to('/user/change-password?key=' . $currentKey)
                ->with('success', 'Password berhasil diubah!');
        } else {
            return redirect()->to('/user/change-password?key=' . $currentKey)
                ->withInput()
                ->with('error', 'Gagal mengubah password. Silakan coba lagi.');
        }
    }
}

