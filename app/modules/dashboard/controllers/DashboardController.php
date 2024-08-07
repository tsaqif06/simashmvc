<?php

namespace App\Modules\Dashboard\Controllers;

use Core\Controller;
use Core\Middleware;

class DashboardController extends Controller
{
    public function __construct()
    {
        Middleware::webAuthenticate();
    }

    public function index()
    {
        // Middleware::authenticate(); This line is redundant because it's already called in the constructor
        if ($_SESSION['user']['role'] === 'admin') {
            $this->view->render('dashboard/admin/dashboard');
        } else {
            $this->view->render('dashboard/user/dashboard');
        }
    }

    public function admin()
    {
        Middleware::webCheckRole('admin');
        $this->view->render('dashboard/admin/dashboard');
    }
}
