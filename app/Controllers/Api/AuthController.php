<?php

namespace App\Controllers\Api;

use App\Models\User;

class AuthController
{
    public function login()
    {
        $rawInput = file_get_contents('php://input');
        $input = json_decode($rawInput, true);

        $email = $input['email'] ?? '';
        $password = $input['password'] ?? '';

        $userModel = new User();
        $user = $userModel->findEmail($email);

        if ($user && $password === $user['password']) {

            $secret = "rahasia123";
            $payload = $user['id'] . ":" . $secret;

            $token = base64_encode($payload);

            echo json_encode([
                'status' => 'success',
                'message' => 'Login successful',
                'token' => $token,
                'data' => [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'role' => $user['role'],
                ]
            ]);
            exit;
        } else {
            http_response_code(401);
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid email or password'
            ]);
            exit;
        }
    }

}
