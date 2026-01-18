<?php
namespace App\Core;

use PDO;

class Database {
    private static $instance;
    private $conn;

    private function __construct(){
        $this->conn = new PDO("mysql:host=localhost;dbname=location_voiture", "root", "");
    }

    public static function getInstance(){
        if (!self::$instance) self::$instance = new self();
        return self::$instance;
    }

    public function getConnection(){
        return $this->conn;
    }
    
}
