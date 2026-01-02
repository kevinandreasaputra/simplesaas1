<?php

namespace App\Models;

use App\Core\Model;

class Booking extends Model
{
    public function create($userId, $serviceId, $date)
    {
        $sql = "INSERT INTO bookings (user_id, service_id, booking_date, status) VALUES (:uid, :sid, :bdate, 'pending')";
        return $this->db->query($sql, [
            'uid' => $userId,
            'sid' => $serviceId,
            'bdate' => $date
        ]);
    }

    public function getByUser($userId)
    {
        $sql = "SELECT b.*, s.name as service_name, s.price 
        FROM bookings b
        JOIN services s ON b.service_id = s.id
        WHERE b.user_id = :uid
        ORDER BY b.booking_date DESC";
        return $this->db->query($sql, [
            'uid' => $userId
        ])->fetchAll();
    }

    public function getAll()
    {
        $sql = "SELECT b.*, s.name as service_name, s.price, u.name as user_name 
        FROM bookings b
        JOIN services s ON b.service_id = s.id
        JOIN users u ON b.user_id = u.id  
        ORDER BY b.booking_date DESC";
        return $this->db->query($sql)->fetchAll();
    }

    public function updateStatus($id, $status)
    {
        $sql = "UPDATE bookings SET status = :status WHERE id = :id";
        return $this->db->query($sql, [
            'id' => $id,
            'status' => $status
        ]);
    }


    public function getById($id)
    {
        $sql = "SELECT b.*, s.name as service_name, s.price 
                FROM bookings b
                JOIN services s ON b.service_id = s.id
                WHERE b.id = :id";
        return $this->db->query($sql, ['id' => $id])->fetch();
    }
}
