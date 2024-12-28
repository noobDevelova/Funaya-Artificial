<?php

namespace App\Controllers\Auth\Admin;

use App\Controllers\BaseController;
use App\Core\Adapters\EnvAdapter;
use App\Core\Domains\Auth\DTOs\LoginRequest;
use Config\Services;

class AuthController extends BaseController
{

    protected $auth_use_case;
    protected $unauth_use_case;

    protected $ENV_ADAPTER;

    public function __construct()
    {
        $this->auth_use_case = Services::authenticateUserUseCase();
        $this->unauth_use_case = Services::unAuthenticateUserUseCase();
        $this->ENV_ADAPTER = new EnvAdapter();
    }

    public function index()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/admin/');
        }

        $metadata = [
            'title' => 'Login - Admin | ' . $this->ENV_ADAPTER->getAppName(),
        ];

        return view('admin/auth/login', $metadata);
    }

    public function login()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/admin/');
        }

        $metadata = [
            'title' => 'Login - Admin | ' . $this->ENV_ADAPTER->getAppName(),
        ];


        $validation = Services::validation();

        $validation->setRules([
            'email' => 'required|valid_email',
            'password' => 'required|min_length[6]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return view('admin/auth/login', [
                'validation' => $validation
            ] + $metadata);
        }

        $request = (object)[
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
        ];

        $loginRequest = new LoginRequest($request->email, $request->password);

        try {
            $user = $this->auth_use_case->execute($loginRequest);

            session()->set([
                'id' => $user->id,
                'username' => $user->username,
                'role' => $user->role_id,
                'isLoggedIn' => true
            ]);

            return redirect()->to('/admin/');
        } catch (\Exception $e) {
            redirect()->back()->with('error', $e->getMessage());
        }

        return view('admin/auth/login', $metadata);
    }

    public function logout()
    {
        $userId = session()->get('id');
        $this->unauth_use_case->execute($userId);

        session()->remove('id');
        session()->remove('username');
        session()->remove('role');
        session()->remove('isLoggedIn');
        session()->destroy();

        return redirect()->to('admin/auth/login');
    }
}