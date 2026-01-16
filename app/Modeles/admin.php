<?php
namespace App\Modeles;

class Admin extends User
{
    public function __construct($nom, $prenom, $email, $password)
    {
        parent::__construct($nom, $prenom, $email, $password);
        $this->role = 'admin';
    }
}
