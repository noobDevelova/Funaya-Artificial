<?php

namespace App\Controllers\Auth\Admin;

use App\Controllers\BaseController;
use App\Core\Adapters\EnvAdapter;
use Config\Services;

class AuthController extends BaseController
{

    protected $auth_use_case;

    public function __construct()
    {
        $this->auth_use_case = Services::authUseCase();
    }

    public function login()
    {
        $ENV_ADAPTER = new EnvAdapter();

        $metadata = [
            'title' => 'Login - Admin | ' . $ENV_ADAPTER->getAppName(),
        ];

        if (session()->get('isLoggedIn')) {
            return redirect()->to('/admin/');
        }

        if ($this->request->getMethod() === 'POST') {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            try {
                $user = $this->auth_use_case->authenticate($email, $password);

                session()->set([
                    'id' => $user->id,
                    'username' => $user->username,
                    'role' => $user->role_name,
                    'isLoggedIn' => true
                ]);

                return redirect()->to('/admin/');
            } catch (\Exception $e) {
                redirect()->back()->with('error', $e->getMessage());
            }
        }

        return view('admin/auth/login', $metadata);
    }

    public function logout()
    {
        session()->remove('id');
        session()->remove('username');
        session()->remove('role');
        session()->remove('isLoggedIn');
        session()->destroy();

        return redirect()->to('admin/auth/login');
    }
}