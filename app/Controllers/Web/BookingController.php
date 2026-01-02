<?php

namespace App\Controllers\Web;

use App\Models\Booking;

class BookingController
{
    public function process()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: /saas1/login");
            exit;
        }

        $userId = $_SESSION['user']['id'];
        $serviceId = $_POST['service_id'] ?? '';
        $bookingDate = $_POST['booking_date'] ?? '';

        $bookingModel = new Booking();
        $bookingModel->create($userId, $serviceId, $bookingDate);

        echo "<script>alert('Booking berhasil!'); window.location='/saas1/';</script>";
    }

    public function history()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: /saas1/login");
            exit;
        }

        $userId = $_SESSION['user']['id'];
        $bookingModel = new Booking();
        $bookings = $bookingModel->getByUser($userId);

        require_once __DIR__ . '/../../../views/booking/history.php';
    }
}
