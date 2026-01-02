<?php

namespace App\Controllers\Web;

use App\Models\Service;

class ServiceController
{
    public function index()
    {
        $serviceModel = new Service();
        $services = $serviceModel->getAll();
        require_once __DIR__ . '/../../../views/services/index.php';
    }
}
