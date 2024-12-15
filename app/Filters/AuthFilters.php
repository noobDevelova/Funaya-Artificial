<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilters implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('isLoggedIn') && $request->getUri()->getPath() === '/admin/') {
            return redirect()->to('/admin/login');
        }
    }

    public function after(RequestInterface $requuest, ResponseInterface $response, $arguments = null)
    {
        // TODO
    }
}