<?php

namespace App\Controllers;

use App\Modeles\Avis;

class AvisController
{

    public function index()
    {
     
        $id_user = $_SESSION['id_user'] ?? null;

       
        $vehicules = Avis::getNomVehiculeMarque();

        
        $avisParUser = [];
        if ($id_user) {
            $avisparuserconnecter = Avis::getAvisParUser($id_user);
        }
       $success="";
     
        require __DIR__ . '/../Views/client/mes_avis.php';
    }



    
    public function ajouter()
    {
        
        $id_user = $_SESSION['id_user'] ?? null;
        $success = "0";


        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id_user){

            $id_vehicule = trim($_POST['id_vehicule'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $number = trim($_POST['number'] ?? '');

            $avi = new Avis($number, $description, "1");

            if ($avi->ajauterAvis($id_user, $id_vehicule)) {
                echo "hhhh";
                $success = "1";
            } else {
                $success = "2";
            }

         
            header('Location: /location_voiture_mvc/public/avis');
            exit;
        }

        
        $vehicules = Avis::getNomVehiculeMarque();
        require __DIR__ . '/../Views/avis/ajouter_avis.php';
    }






    public function supprimerAvis(){

$id_avis=isset($_GET['id']) ? $_GET['id'] : 0;
if($id_avis==0){
    echo "cette id introvable";
    exit;
}

$role=$_SESSION['role'];
if(Avis::supprimerAvi($id_avis)){
    if($role=='client'){
header('Location: /location_voiture_mvc/public/avis');
exit;
    }else{
        header('Location: /location_voiture_mvc/public/afficher_avis');
        exit;
    }


}

    }





    
    public function restaurerAvi(){
      
$id_avis=isset($_GET['id']) ? $_GET['id'] : 0;
if($id_avis==0){
    echo "cette id introvable";
    exit;
}
$role=$_SESSION['role'];
if(Avis::modifierdeleteAt($id_avis)){
 if($role=='client'){
header('Location: /location_voiture_mvc/public/avis');
exit;
    }else{
        header('Location: /location_voiture_mvc/public/afficher_avis');
        exit;
    }
}


    }




    public function modifierAvis(){
      


if (!isset($_GET['id'])) {
    echo "Avis introuvable";
    exit;
}

$id_avis = $_GET['id'];


$avis = Avis::getAvisParId($id_avis);

if (!$avis){
    echo "Accès interdit ou avis inexistant";
    exit;
}
$success=false;
$role=$_SESSION['role'];
 require __DIR__ . '/../Views/'.$role.'/modifier_avis.php';
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $note = trim($_POST['note']);
    $description = trim($_POST['description']);
$avis=new Avis($note,$description,"1");
    if ($avis->modifierAvis($id_avis)){
        if($role=='client'){
 header('Location: /location_voiture_mvc/public/avis');
        exit;
        }else{
             header('Location: /location_voiture_mvc/public/afficher_avis');
        exit;
        }
       
    } else {
        $success = "Erreur lors de la modification";
    }
}

    }




    public function afficherAvis(){
        
$avis=Avis::afficherAvis();
$nom=$_SESSION['nom'];
require __DIR__ . '/../Views/admin/avis.php';

    }


   





}
