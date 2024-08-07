<?php

namespace App\Modules\Auth\Controllers;

use Core\Controller;
use App\Models\User;
use Core\Middleware;
use Firebase\JWT\JWT;

class AuthController extends Controller
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $userModel = $this->loadModel('User');
            $user = $userModel->authenticate($data['username'], $data['password']);
            if ($user) {
                $token = JWT::encode([
                    'id' => $user['id'],
                    'role' => $user['role'],
                    'exp' => time() + 3600 // Token expires in 1 hour
                ], 'secret', 'HS256');
                echo json_encode(['token' => $token]);
            } else {
                http_response_code(401);
                echo json_encode(['error' => 'Invalid credentials']);
            }
        } else {
            $this->view->render('auth/views/login');
        }
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $userModel = $this->loadModel('User');
            $userModel->create($data);
            header('Location: /login');
        } else {
            $this->view->render('auth/register');
        }
    }

    public function logout()
    {
        // Implement logout functionality
        // Typically this involves removing the token or session data
        session_destroy();
        header('Location: /login');
    }
}
