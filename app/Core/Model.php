<?php

namespace App\Core;

class Model
{
    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function lastInsertId()
    {
        return $this->db->lastInsertId();
    }
}
