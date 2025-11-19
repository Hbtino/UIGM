<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class ReviewerFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $allowedRoles = ['admin', 'reviewer'];
        if (!in_array(session()->get('role'), $allowedRoles)) {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak, hanya admin dan reviewer yang boleh!');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
