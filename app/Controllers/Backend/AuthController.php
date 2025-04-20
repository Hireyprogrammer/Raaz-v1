<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;

use App\Models\Backend\AuthModel;

class AuthController extends BaseController
{
    public function index(): string
    {
        return view('admin/login', $this->viewData);
    }
    public function check_login()
    {
        // Disable any output buffering that might interfere with our response
        while (ob_get_level()) {
            ob_end_clean();
        }
        
        try {
            $session = session();
            
            // Debug the request method and accept any method temporarily for testing
            log_message('debug', 'Request method: ' . $this->request->getMethod());
            log_message('debug', 'Server vars: ' . print_r($_SERVER, true));
            
            // Force this method to always accept the login request regardless of method
            // This helps us debug if there's a method detection issue
            // if (true) { // Temporary override for testing
            
            // Accept any case for the method (POST, post, etc)
            if (strtolower($this->request->getMethod()) === 'post' || $_SERVER['REQUEST_METHOD'] === 'POST') {
                $model = new AuthModel();

                // Try to get post data multiple ways
                $username = $this->request->getVar('username') ?? $this->request->getPost('username') ?? '';
                $password = $this->request->getVar('password') ?? $this->request->getPost('password') ?? '';
                
                // Debug form data
                log_message('debug', 'Form data - Username: ' . ($username ?? 'not set') . ', Password length: ' . (strlen($password ?? '') > 0 ? 'set' : 'not set'));
                log_message('debug', 'Raw post data: ' . print_r($this->request->getPost(), true));
                log_message('debug', 'Server POST: ' . print_r($_POST, true));
                
                // Make sure we're getting POST variables
                if (empty($username) || empty($password)) {
                    return $this->response->setContentType('application/json')
                                        ->setJSON([
                                            'success' => 0,
                                            'message' => 'Username or password is empty'
                                        ]);
                }

                try {
                    $result = $model->login($username, $password, $this->request->getLocale());
                    
                    // Log the result
                    log_message('debug', 'Login result: ' . json_encode($result));

                    if ($result['success']) {
                        $session->set(['exp_date'=> '2024-12-24 12:00:00', 'status'=> true]);
                        $session->set($result['sess']);
                        $rs = [
                            'success' => 1,
                            'message' => 'Login Successful'
                        ];
                        
                        return $this->response->setContentType('application/json')
                                          ->setJSON($rs);
                    } else {
                        return $this->response->setContentType('application/json')
                                          ->setJSON($result);
                    }
                } catch (\Exception $e) {
                    log_message('error', 'Login error: ' . $e->getMessage());
                    return $this->response->setContentType('application/json')
                                      ->setJSON([
                                          'success' => 0,
                                          'message' => 'Database error: ' . $e->getMessage()
                                      ]);
                }
            }
            
            // Default response if we get here
            return $this->response->setContentType('application/json')
                              ->setJSON([
                                  'success' => 0,
                                  'message' => 'Invalid request method'
                              ]);
        } catch (\Exception $e) {
            log_message('error', 'Uncaught exception: ' . $e->getMessage());
            return $this->response->setContentType('application/json')
                              ->setJSON([
                                  'success' => 0,
                                  'message' => 'Server error: ' . $e->getMessage()
                              ]);
        }
    }

    public function signout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url($this->viewData['locale'].'/admin'));
    }
}
