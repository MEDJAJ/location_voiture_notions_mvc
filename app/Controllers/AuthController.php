<?php

namespace App\Controllers;

use App\Modeles\User;
use App\Modeles\Client;

class AuthController
{
    public function login()
    {
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            require __DIR__ . '/../Views/auth/login.php';
            return;
        }

    
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            $message = "Champs obligatoires";
            require __DIR__ . '/../Views/auth/login.php';
            return;
        }

        $user = User::findByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            $message = "Email ou mot de passe incorrect";
            require __DIR__ . '/../Views/auth/login.php';
            return;
        }

      
        $_SESSION['id_user'] = $user['id_user'];
        $_SESSION['nom'] = $user['nom'];
        $_SESSION['role'] = $user['role'];

        
        if ($_SESSION['role'] === "client"){
              header('Location: /location_voiture_mvc/public/categorie');
        } else {
          header('Location: /location_voiture_mvc/public/categorie');
        }
    }

    public function registerClient()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $message="";
            require __DIR__ . '/../Views/auth/register.php';
            return;
        }

        $data = $_POST;

        $passwordHash = password_hash($data['password'], PASSWORD_DEFAULT);

        $client = new Client(
            $data['nom'],
            $data['prenom'],
            $data['email'],
            $passwordHash
        );

        if($client->save()){
            
            $message="sucess";
              require __DIR__ . '/../Views/auth/register.php';
        }else{
            $message="error";
              require __DIR__ . '/../Views/auth/register.php';
        }
       
      
    }

    public function logout(){
        session_start();


        session_unset();


        session_destroy();


        header("Location: /location_voiture_mvc/public/login");
        exit;
    }
}
