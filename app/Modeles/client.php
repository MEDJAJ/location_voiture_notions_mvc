<?php
namespace App\Modeles;

use App\Core\Database;

class Client extends User
{
    public function __construct($nom, $prenom, $email, $password)
    {
        parent::__construct($nom, $prenom, $email, $password);
        $this->role = 'client';
    }

    public static function countClients()
    {
        $db = Database::getInstance()->getConnection();
        return $db->query(
            "SELECT COUNT(*) FROM users WHERE role='client'")->fetchColumn();
    }
}
