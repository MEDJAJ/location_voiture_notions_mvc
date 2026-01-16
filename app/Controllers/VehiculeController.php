<?php
namespace App\Controllers;

use App\Modeles\Categorie;
use App\Modeles\Vehicle;
use App\Modeles\Avis;
class VehiculeController
{

public function getNometIdCategorie(){
    $id = (int)($_GET['id'] ?? 0);
if ($id === 0) {
    die("ID catégorie invalide");
}
$name=$_GET['name'];
require __DIR__ . '/../Views/client/vehicules.php';
}


public function getVehiculeFiltrer(){
    $id     = (int)($_GET['id'] ?? 0);
$page   = max((int)($_GET['page'] ?? 1), 1);
$limit  = 3;
$offset = ($page - 1) * $limit;

$marque = trim($_GET['marque'] ?? '');
$dispo  = $_GET['disponibilite'] ?? '';

if ($id === 0) exit;


$total = Vehicle::countVehiculesFilter($id, $marque, $dispo);
$totalPages = ceil($total / $limit);


$vehicules = Vehicle::getVehiculesFilterPaginated(
    $id,
    $marque,
    $dispo,
    $limit,
    $offset
);
require __DIR__ . '/../Views/client/vehicule_filter.php';
}





 public function details()
    {
        
 
      
        $id = $_GET['id'] ?? 0;
        $id_c = $_GET['id_c'] ?? 0;

        if ($id == 0 || $id_c == 0) {
            echo "ID véhicule ou catégorie introuvable";
            exit;
        }

        $id_user = $_SESSION['id_user'] ?? null;

        
        $vehicules = Vehicle::getById($id, $id_c);

        if (!$vehicules) {
            echo "Véhicule introuvable";
            exit;
        }

       
        $avis = Avis::getAvisParVehicule($id);

     
    
   $success="";
        
        require __DIR__ .'/../Views/client/details.php';
    }





    public function afficherVehicule(){


        if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $modeles = $_POST['modele'];
    $marques = $_POST['marque'];
    $prix = $_POST['prix'];
    $images = $_FILES['image'];
    $nom_categorie=$_POST['categorie'];
    $disponible=$_POST['disponible'];
    $data = [];

    foreach ($modeles as $index => $modele) {

        $imageName = null;

        if (!empty($images['name'][$index])){

            $extension = pathinfo($images['name'][$index], PATHINFO_EXTENSION);
            $imageName = uniqid() . '.' . $extension;

            $tmpPath = $images['tmp_name'][$index];
            $destination = __DIR__ . '/../assets/uploads/' . $imageName;
            move_uploaded_file($tmpPath, $destination);
        }

        $data[] = [
            'modele' => $modele,
            'marque' => $marques[$index],
             'prix'=>$prix[$index],
             'nom_categorie'=>$nom_categorie[$index],
            'disponible' => $disponible[$index]=="1" ? "1" :"0",
            'image' => $imageName
        ];
    }

   
    Vehicle::ajouterMasse( $data);


     header('Location: /location_voiture_mvc/public/vehicule_categorie_admin');
    
}

$categories=Categorie::afficherCategories();

$vehicules=Vehicle::afficherVehicule();



$names=Categorie::getNamesC();
if(!$names){
    echo "aucun categorie";
    exit;
}

if(!$vehicules){
    echo "aucun categorie";
    exit;
}

$nom=$_SESSION['nom'];

require __DIR__ .'/../Views/admin/vehicules.php';

    }


    public function supprimerVehicule(){
    $id=$_GET['id'] ?? 0;

    if($id==0){
        die("cette id introvable");
    }

    Vehicle::supprimerVehicule($id);
     header('Location: /location_voiture_mvc/public/vehicule_categorie_admin');
    }





public function modifierVehicule(){

if (!isset($_GET['id']) || empty($_GET['id'])){
   header('Location: /location_voiture_mvc/public/vehicule_categorie_admin');
    exit;
}

$id = (int) $_GET['id'];


$vehicule = Vehicle::getById($id);
$categories = Categorie::getNamesC();

if (!$vehicule) {
    echo "Véhicule introuvable";
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $modele = $_POST['modele'];
    $marque = $_POST['marque'];
    $prix = $_POST['prix'];
    $disponibilite = $_POST['disponible'];
    $id_categorie = $_POST['categorie'];

   
    $imageName = $vehicule['image'];

  
   
        if (!empty($_FILES['image']['name'])){

            $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $imageName = uniqid() . '.' . $extension;

            $tmpPath = $images['tmp_name'];
            $destination = __DIR__ . '/../assets/uploads/' . $imageName;
            move_uploaded_file($tmpPath, $destination);
        }



    Vehicle::modifierVehicule( 
        $id,
        $modele,
        $marque,
        $disponibilite,
        $id_categorie,
        $imageName,
        $prix
    );

     header('Location: /location_voiture_mvc/public/vehicule_categorie_admin');
    exit;
}
$disponibilite=Vehicle::getDispVehicule($id);
require __DIR__ . '/../Views/admin/modifier_vehicule.php';
    }

}



?>