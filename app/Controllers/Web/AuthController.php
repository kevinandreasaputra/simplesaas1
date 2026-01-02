<?php

namespace App\Controllers\Web;

use App\Models\User;

class AuthController
{
    public function loginPage()
    {
        if (isset($_SESSION['user'])) {
            header("Location: /saas1/");
            exit;
        }
        require_once __DIR__ . '/../../../views/auth/login.php';
    }

    public function loginProcess()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $userModel = new User();
        $user = $userModel->findEmail($email);

        if ($user) {
            if ($password === $user['password']) {
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'role' => $user['role']
                ];
                if ($user['role'] === 'admin') {
                    header("Location: /saas1/admin");
                } else {
                    header("Location: /saas1/");
                }
                exit;
            }
        }
        echo "<script>alert('Email atau password salah!'); window.location='/saas1/login';</script>";
    }

    public function logout()
    {
        session_destroy();
        header("Location: /saas1/login");
        exit;
    }
}
