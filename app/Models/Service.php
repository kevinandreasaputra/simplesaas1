<?php

namespace App\Models;
use App\Core\Model;

class Service extends Model {
    public function getAll(){
        return $this->db->query("SELECT * FROM services")->fetchAll();
    }
}