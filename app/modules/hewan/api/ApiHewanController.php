<?php

namespace App\Modules\Hewan\Api;

use Core\Controller;
use App\Models\Hewan;
use Core\Middleware;

class ApiHewanController extends Controller
{
    public function __construct()
    {
        Middleware::apiAuthenticate(); // Ensure user is authenticated
    }

    public function getAll()
    {
        $hewanModel = new Hewan();
        $data = $hewanModel->getAll();
        echo json_encode($data);
    }

    public function get($id)
    {
        $hewanModel = new Hewan();
        $data = $hewanModel->findById($id);
        if ($data) {
            echo json_encode($data);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Hewan not found']);
        }
    }

    public function create()
    {
        Middleware::apiCheckRole('admin'); // Ensure user has admin role
        $data = json_decode(file_get_contents("php://input"), true);

        if ($this->validateData($data)) {
            $hewanModel = new Hewan();
            $hewanModel->create($data);
            http_response_code(201); // Created
            echo json_encode(['message' => 'Hewan created successfully']);
        } else {
            http_response_code(400); // Bad Request
            echo json_encode(['error' => 'Invalid data']);
        }
    }

    public function update($id)
    {
        Middleware::apiCheckRole('admin'); // Ensure user has admin role
        $data = json_decode(file_get_contents("php://input"), true);

        if ($this->validateData($data)) {
            $hewanModel = new Hewan();
            if ($hewanModel->findById($id)) {
                $hewanModel->update($id, $data);
                echo json_encode(['message' => 'Hewan updated successfully']);
            } else {
                http_response_code(404); // Not Found
                echo json_encode(['error' => 'Hewan not found']);
            }
        } else {
            http_response_code(400); // Bad Request
            echo json_encode(['error' => 'Invalid data']);
        }
    }

    public function delete($id)
    {
        Middleware::apiCheckRole('admin'); // Ensure user has admin role
        $hewanModel = new Hewan();
        if ($hewanModel->findById($id)) {
            $hewanModel->delete($id);
            echo json_encode(['message' => 'Hewan deleted successfully']);
        } else {
            http_response_code(404); // Not Found
            echo json_encode(['error' => 'Hewan not found']);
        }
    }

    private function validateData($data)
    {
        // Basic validation; adjust as needed
        return isset($data['name']) && !empty($data['name']) &&
            isset($data['species']) && !empty($data['species']) &&
            isset($data['age']) && is_numeric($data['age']);
    }
}
