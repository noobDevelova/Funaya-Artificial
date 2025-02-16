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
        $path = rtrim($request->getUri()->getPath(), '/');

        $guestRoutes = [
            '/auth/login',
        ];

        $protectedRoutes = [
            '/*',
            '/employee/*',
            '/products/*',
            '/categories/*',
        ];

        $isLoggedIn = $session->get('isLoggedIn');

        if ($isLoggedIn && in_array($path, $guestRoutes)) {
            return redirect()->to('/');
        }

        if (!$isLoggedIn && $this->isProtectedRoute($path, $protectedRoutes)) {
            return redirect()->to('/auth/login');
        }

        if (!$this->isValidRoute($path, $guestRoutes, $protectedRoutes)) {
            return redirect()->to('/404');
        }

        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // TODO
    }

    private function isProtectedRoute($path, $protectedRoutes)
    {
        $normalizedPath = rtrim($path, '/');

        foreach ($protectedRoutes as $route) {
            $normalizedRoute = rtrim($route, '/');

            if (substr($normalizedRoute, -2) === '/*') {
                $baseRoute = rtrim(substr($normalizedRoute, 0, -2), '/');

                if (strpos($normalizedPath, $baseRoute) === 0) {
                    return true;
                }
            } else {
                if ($normalizedPath === $normalizedRoute) {
                    return true;
                }
            }
        }

        return false;
    }

    private function isValidRoute($path, $guestRoutes, $protectedRoutes)
    {
        return in_array($path, $guestRoutes) || $this->isProtectedRoute($path, $protectedRoutes);
    }
}
