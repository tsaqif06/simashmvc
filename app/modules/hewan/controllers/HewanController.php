<?php

namespace App\Modules\Hewan\Controllers;

use Core\Controller;
use Core\Middleware;

class HewanController extends Controller
{
    public function __construct()
    {
        Middleware::webAuthenticate();
    }

    public function index()
    {
        $hewanModel = $this->loadModel('Hewan');
        $data['hewan'] = $hewanModel->getAll();
        $this->view->render('hewan/index', $data);
    }

    public function create()
    {
        Middleware::webCheckRole('admin');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $hewanModel = $this->loadModel('Hewan');
            $hewanModel->create($data);
            header('Location: /hewan');
        } else {
            $this->view->render('hewan/create');
        }
    }

    public function update($id)
    {
        Middleware::webCheckRole('admin');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $hewanModel = $this->loadModel('Hewan');
            $hewanModel->update($id, $data);
            header('Location: /hewan');
        } else {
            $hewanModel = $this->loadModel('Hewan');
            $data['hewan'] = $hewanModel->findById($id);
            $this->view->render('hewan/update', $data);
        }
    }

    public function delete($id)
    {
        Middleware::webCheckRole('admin');
        $hewanModel = $this->loadModel('Hewan');
        $hewanModel->delete($id);
        header('Location: /hewan');
    }
}
