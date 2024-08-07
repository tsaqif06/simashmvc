<?php
require 'vendor/autoload.php';

use Core\Middleware;

// Route request
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';
$url = explode('/', $url);

if (isset($url[0]) && $url[0] === 'api') {
    $module = isset($url[1]) && !empty($url[1]) ? $url[1] : 'default_module'; // Default module
    $controller = isset($url[2]) ? $url[2] : 'ApiHewanController';
    $method = isset($url[3]) ? $url[3] : 'getAll';
    $params = array_slice($url, 4);

    // Construct controller path
    $controllerPath = 'app/modules/' . $module . '/api/' . $controller . '.php';
    echo "Controller Path: $controllerPath<br>"; // Debugging the controller path
    if (file_exists($controllerPath)) {
        require_once $controllerPath;
        $controllerClass = "App\\Modules\\" . ucfirst($module) . "\\Api\\" . ucfirst($controller);
        if (class_exists($controllerClass)) {
            $controller = new $controllerClass();
            if (method_exists($controller, $method)) {
                call_user_func_array([$controller, $method], $params);
            } else {
                http_response_code(404);
                echo json_encode(['error' => "Method $method not found"]);
            }
        } else {
            http_response_code(404);
            echo json_encode(['error' => "Controller class $controllerClass not found"]);
        }
    } else {
        http_response_code(404);
        echo json_encode(['error' => "Controller file $controllerPath not found"]);
    }
} else {
    $module = isset($url[0]) && !empty($url[0]) ? $url[0] : 'dashboard'; // Default module
    $controller = isset($url[1]) ? $url[1] : 'DashboardController'; // Default controller
    $method = isset($url[2]) ? $url[2] : 'index';
    $params = array_slice($url, 3);

    $controllerPath = 'app/modules/' . $module . '/controllers/' . $controller . '.php';
    if (file_exists($controllerPath)) {
        require_once $controllerPath;
        $controllerClass = "App\\Modules\\" . ucfirst($module) . "\\Controllers\\" . ucfirst($controller);
        if (class_exists($controllerClass)) {
            $controller = new $controllerClass();
            if (method_exists($controller, $method)) {
                call_user_func_array([$controller, $method], $params);
            } else {
                echo "Method $method not found in controller $controllerClass.";
            }
        } else {
            echo "Controller class $controllerClass not found.";
        }
    } else {
        echo "Controller file $controllerPath not found.";
    }
}
