<?php

namespace Core;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;

class Middleware
{
    private static $SECRET_KEY = 'secret'; // Replace with a strong secret key

    public static function apiAuthenticate()
    {
        $headers = apache_request_headers();
        if (isset($headers['Authorization'])) {
            $authHeader = $headers['Authorization'];
            $token = str_replace('Bearer ', '', $authHeader);

            try {
                $decoded = JWT::decode($token, new Key(self::$SECRET_KEY, 'HS256'));
                if ($decoded instanceof \stdClass) {
                    $_SESSION['user'] = (array) $decoded;
                } else {
                    throw new \Exception('Invalid token format');
                }
            } catch (ExpiredException $e) {
                http_response_code(401);
                echo json_encode(['error' => 'Token expired']);
                exit;
            } catch (SignatureInvalidException $e) {
                http_response_code(401);
                echo json_encode(['error' => 'Invalid signature']);
                exit;
            } catch (\Exception $e) {
                http_response_code(401);
                echo json_encode(['error' => $e->getMessage()]);
                exit;
            }
        } else {
            http_response_code(401);
            echo json_encode(['error' => 'No token provided']);
            exit;
        }
    }

    public static function webAuthenticate()
    {
        session_start();
        if (!isset($_SESSION['user'])) {
            header('Location: ' . base_url('auth/login'));
            exit;
        }
    }

    public static function apiCheckRole($role)
    {
        if (!isset($_SESSION['user']['role']) || $_SESSION['user']['role'] !== $role) {
            http_response_code(403);
            echo json_encode(['error' => 'Forbidden']);
            exit;
        }
    }

    public static function webCheckRole($role)
    {
        if (!isset($_SESSION['user']['role']) || $_SESSION['user']['role'] !== $role) {
            header('HTTP/1.1 403 Forbidden');
            echo 'Access Denied';
            exit;
        }
    }
}
