<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Restrict implements FilterInterface
{
    /**
     * Filter to check if user is logged in
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        
        // Check if user is logged in
        if (!$session->has('isLoggedIn') || $session->get('isLoggedIn') !== true) {
            // User is not logged in, redirect to login page
            $locale = service('request')->getLocale();
            return redirect()->to(base_url($locale . '/admin/auth'));
        }
        
        // User is logged in, continue
        return $request;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing here
        return $response;
    }
}
