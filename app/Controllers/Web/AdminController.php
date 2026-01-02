<?php

namespace App\Controllers\Web;

use App\Models\Booking;

class AdminController
{
    private function checkAdmin()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            echo "<script>alert('Anda tidak memiliki akses'); window.location='/saas1/';</script>";
            exit;
        }
    }

    public function dashboard()
    {
        $this->checkAdmin();
        $bookingModel = new Booking();
        $bookings = $bookingModel->getAll();
        require_once __DIR__ . '/../../../views/admin/dashboard.php';
    }

    public function updateStatus()
    {
        $this->checkAdmin();
        $id = $_POST['id'];
        $status = $_POST['status'];
        $bookingModel = new Booking();
        $bookingModel->updateStatus($id, $status);
        header("Location: /saas1/admin");
        exit;
    }
}
