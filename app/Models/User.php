<?php

namespace App\Models;
use App\Core\Model;

class User extends Model {
    public function getAllUsers(){
        $stmt = $this->db->query("SELECT * FROM users");
        return $stmt->fetchAll();
    }

    public function findEmail($email){
        $stmt = $this->db->query("SELECT * FROM users WHERE email = :email", ['email' => $email]);
        return $stmt->fetch();
    }
}
