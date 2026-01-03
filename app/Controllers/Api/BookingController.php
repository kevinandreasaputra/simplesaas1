<?php

namespace App\Controllers\Api;

use App\Models\Booking;
use App\Models\Service;
use App\Models\User;


class BookingController
{
    public function process()
    {
        $rawInput = file_get_contents('php://input');
        $input = json_decode($rawInput, true);

        $bookingModel = new Booking();
        $bookingModel->create($input['user_id'], $input['service_id'], $input['booking_date']);

        $newId = $bookingModel->lastInsertId();

        echo json_encode([
            'status' => 'success',
            'message' => 'Booking berhasil',
            'data' => $bookingModel->getById($newId)
        ]);
        exit;
    }

    public function history()
    {
        $authHeader = null;
        if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $authHeader = $_SERVER['HTTP_AUTHORIZATION'];
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            $requestHeaders = array_change_key_case($requestHeaders, CASE_LOWER);
            if (isset($requestHeaders['authorization'])) {
                $authHeader = $requestHeaders['authorization'];
            }
        }
        $token = str_replace('Bearer ', '', $authHeader);

        $decoded = base64_decode($token);
        $parts = explode(':', $decoded);

        $userIdFromToken = $parts[0] ?? null;
        $secretFromToken = $parts[1] ?? null;



        if ($secretFromToken !== "rahasia123") {
            http_response_code(401);
            echo json_encode(['status' => 'error', 'message' => 'Invalid Token']);
            exit;
        }

        $bookingModel = new Booking();
        $bookings = $bookingModel->getByUser($userIdFromToken);
        echo json_encode([
            'status' => 'success',
            'message' => 'History retrieved successfully',
            'data' => $bookings
        ]);
        exit;
    }
}
