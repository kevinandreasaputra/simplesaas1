<?php

namespace App\Controllers\Api;

use App\Models\Service;

class ServiceController
{

    public function index()
    {
        $serviceModel = new Service();
        $services = $serviceModel->getAll();

        $response = [
            'status' => 'success',
            'message' => 'List of services retrieved successfully',
            'data' => $services
        ];
        echo json_encode($response);
        exit;
    }
}
