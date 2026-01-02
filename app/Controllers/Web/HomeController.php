<?php

namespace App\Controllers\Web;

use App\Models\User;

class HomeController
{
    public function index()
    {
        $userModel = new User();
        $users = $userModel->getAllUsers();
        require_once __DIR__ . '/../../../views/home.php';
    }

    public function about()
    {
        echo "Halaman About";
    }
}
