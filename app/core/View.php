<?php

namespace Core;

class View
{
    public function render($view, $data = [])
    {
        extract($data);
        $viewPath = "app/modules/" . $view . ".php";

        if (file_exists($viewPath)) {
            include $viewPath;
        } else {
            http_response_code(404);
            echo "View file not found: $viewPath";
        }
    }
}
