<?php
namespace App\Modeles;

use App\Core\Database;
use PDO;

abstract class User
{
    protected $id;
    protected $nom;
    protected $prenom;
    protected $email;
    protected $password;
    protected $role;

    public function __construct($nom, $prenom, $email, $password)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->password = $password;
    }

    public function save()
    {
        $db = Database::getInstance()->getConnection();

        $sql = "INSERT INTO users (nom, prenom, email, password, role)
                VALUES (:nom, :prenom, :email, :password, :role)";

        $stmt = $db->prepare($sql);
        return $stmt->execute([
            ':nom' => $this->nom,
            ':prenom' => $this->prenom,
            ':email' => $this->email,
            ':password' => $this->password,
            ':role' => $this->role
        ]);
    }

    public static function findByEmail($email)
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
