<?php

namespace Core;

class Controller
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    protected function loadModel($model)
    {
        $modelPath = '../app/modules/' . $model . '/models/' . $model . '.php';
        if (file_exists($modelPath)) {
            require_once $modelPath;
            $modelClass = "App\\Modules\\" . ucfirst($model) . "\\Models\\" . ucfirst($model);
            return new $modelClass();
        } else {
            throw new \Exception("Model file $modelPath not found.");
        }
    }
}
