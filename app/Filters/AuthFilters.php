<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilters implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $path = $request->getUri()->getPath();

        // Rute untuk guest (misalnya login, register)
        $guestRoutes = [
            'admin/auth/login',
        ];

        // Rute publik (misalnya dashboard, halaman umum)
        $publicRoutes = [
            'admin/dashboard',
        ];

        // Cek apakah pengguna sudah login (periksa session)
        $isLoggedIn = $session->get('isLoggedIn');

        // Jika user sudah login dan mencoba mengakses halaman login, arahkan ke halaman dashboard
        if ($isLoggedIn && in_array($path, $guestRoutes)) {
            return redirect()->to('/admin/dashboard');
        }

        // Jika user belum login dan mencoba mengakses halaman terproteksi, arahkan ke login page
        if (!$isLoggedIn && !in_array($path, $guestRoutes) && !in_array($path, $publicRoutes)) {
            return redirect()->to('/admin/auth/login');
        }

        // Jika rute valid, lanjutkan ke rute berikutnya
        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // TODO
    }
}