<?php

namespace App\Modules\Buah\Controllers;

use Core\Controller;
use Core\Middleware;

class BuahController extends Controller
{
    public function __construct()
    {
        Middleware::webAuthenticate();
    }

    public function index()
    {
        $buahModel = $this->loadModel('Buah');
        $data['buah'] = $buahModel->getAll();
        $this->view->render('buah/index', $data);
    }

    public function create()
    {
        Middleware::webCheckRole('admin');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $buahModel = $this->loadModel('Buah');
            $buahModel->create($data);
            header('Location: /buah');
        } else {
            $this->view->render('buah/create');
        }
    }

    public function update($id)
    {
        Middleware::webCheckRole('admin');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $buahModel = $this->loadModel('Buah');
            $buahModel->update($id, $data);
            header('Location: /buah');
        } else {
            $buahModel = $this->loadModel('Buah');
            $data['buah'] = $buahModel->findById($id);
            $this->view->render('buah/update', $data);
        }
    }

    public function delete($id)
    {
        Middleware::webCheckRole('admin');
        $buahModel = $this->loadModel('Buah');
        $buahModel->delete($id);
        header('Location: /buah');
    }
}
