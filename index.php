<?php
require 'vendor/autoload.php';
require 'app/helpers/url_helper.php';

$url = $_SERVER['REQUEST_URI'];
$url = parse_url($url, PHP_URL_PATH);
$baseUrl = '/simashmvc'; // Adjust this to your base URL
if (strpos($url, $baseUrl) === 0) {
    $url = substr($url, strlen($baseUrl));
}

$url = trim($url, '/'); // Remove leading and trailing slashes
$url = explode('/', $url);

// Debug output
// var_dump($url);

if (isset($url[0]) && $url[0] === 'api') {
    // Handle API requests
    $module = $url[1] ?? 'default';
    $controller = $url[2] ?? 'ApiDefaultController';
    $method = $url[3] ?? 'index';
    $params = array_slice($url, 4);
    handleRequest($module, $controller, $method, $params, 'api');
} else {
    // Handle web requests
    $module = !empty($url[0]) ? $url[0] : 'dashboard';
    $controller = $url[1] ?? 'DashboardController'; // Default controller if none provided
    $method = $url[2] ?? 'index'; // Default method if none provided
    $params = array_slice($url, 3);
    handleRequest($module, $controller, $method, $params, 'controllers');
}

function handleRequest($module, $controller, $method, $params, $type)
{
    if ($controller == 'login' || $controller == 'logout' || $controller == 'register') {

        if ($controller === 'login') {
            $method = 'login';
        } elseif ($controller === 'register') {
            $method = 'register';
        } elseif ($controller === 'logout') {
            $method = 'logout';
        }

        $controller = 'AuthController';
    } else {
        $controller = ucfirst($controller) . 'Controller';
    }
    // Adjust the path based on your folder structure
    $controllerPath = 'app/modules/' . $module . '/' . $type . '/' . $controller . '.php';

    // Ensure namespace and class name are correctly formatted
    $controllerClass = "App\\Modules\\" . ucfirst($module) . "\\" . ucfirst($type) . "\\" . ucfirst($controller);

    if (file_exists($controllerPath)) {
        require_once $controllerPath;
        if (class_exists($controllerClass)) {
            $controllerInstance = new $controllerClass();
            if (method_exists($controllerInstance, $method)) {
                call_user_func_array([$controllerInstance, $method], $params);
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
}
