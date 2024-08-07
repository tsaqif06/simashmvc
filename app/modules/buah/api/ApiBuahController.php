<?php

namespace App\Modules\Buah\Api;

use Core\Controller;
use App\Models\Buah;
use Core\Middleware;

class ApiBuahController extends Controller
{
    public function __construct()
    {
        Middleware::apiAuthenticate(); // Ensure user is authenticated
    }

    public function getAll()
    {
        $buahModel = new Buah();
        $data = $buahModel->getAll();
        echo json_encode($data);
    }

    public function get($id)
    {
        $buahModel = new Buah();
        $data = $buahModel->findById($id);
        if ($data) {
            echo json_encode($data);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Buah not found']);
        }
    }

    public function create()
    {
        Middleware::apiCheckRole('admin'); // Ensure user has admin role
        $data = json_decode(file_get_contents("php://input"), true);

        if ($this->validateData($data)) {
            $buahModel = new Buah();
            $buahModel->create($data);
            http_response_code(201); // Created
            echo json_encode(['message' => 'Buah created successfully']);
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
            $buahModel = new Buah();
            if ($buahModel->findById($id)) {
                $buahModel->update($id, $data);
                echo json_encode(['message' => 'Buah updated successfully']);
            } else {
                http_response_code(404); // Not Found
                echo json_encode(['error' => 'Buah not found']);
            }
        } else {
            http_response_code(400); // Bad Request
            echo json_encode(['error' => 'Invalid data']);
        }
    }

    public function delete($id)
    {
        Middleware::apiCheckRole('admin'); // Ensure user has admin role
        $buahModel = new Buah();
        if ($buahModel->findById($id)) {
            $buahModel->delete($id);
            echo json_encode(['message' => 'Buah deleted successfully']);
        } else {
            http_response_code(404); // Not Found
            echo json_encode(['error' => 'Buah not found']);
        }
    }

    private function validateData($data)
    {
        // Basic validation; adjust as needed
        return isset($data['name']) && !empty($data['name']) &&
            isset($data['type']) && !empty($data['type']) &&
            isset($data['quantity']) && is_numeric($data['quantity']);
    }
}
