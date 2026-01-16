<?php

namespace App\Controllers;
use App\Modeles\Categorie;
class CategorieController
{


public function afficherCategories(){
$nom=$_SESSION['nom'];
$categories=Categorie::afficherCategories(); 
$role=$_SESSION['role'];
    require __DIR__ . '/../Views/'.$role.'/categorie.php';
}


public function ajauterCategories(){
    if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $noms = $_POST['nom'];
    $descriptions = $_POST['description'];
    $status = $_POST['status'];
    $images = $_FILES['image'];
    

    $data = [];

    foreach ($noms as $index => $nom) {

        $imageName = null;

        if (!empty($images['name'][$index])) {

            $extension = pathinfo($images['name'][$index], PATHINFO_EXTENSION);
            $imageName = uniqid() . '.' . $extension;

            $tmpPath = $images['tmp_name'][$index];
            $destination = __DIR__ . '/../assets/uploads/' . $imageName;

            move_uploaded_file($tmpPath, $destination);
        }

        $data[] = [
            'nom' => $nom,
            'description' => $descriptions[$index],
            'status' => $status[$index]=="1" ? "1" :"0",
            'image' => $imageName
        ];
    }

   
    Categorie::ajouterMasse($data);


    header('Location: /location_voiture_mvc/public/categorie');
    
}
}



public function supprimerCategorie(){


if (!isset($_GET['id'])) {
    header('Location: /location_voiture_mvc/public/categorie');
    exit;
}

$id = (int)$_GET['id'];


$cat = Categorie::getById($id);

if ($cat && !empty($cat['image'])) {

    $imagePath = __DIR__ . '/../assets/uploads/' . $cat['image'];

    if (file_exists($imagePath)) {
        unlink($imagePath);
    }
}


Categorie::supprimerCategorie( $id);

 header('Location: /location_voiture_mvc/public/categorie');
exit;
}


public function modifierCategorie()
{
    if (!isset($_GET['id'])) {
        header('Location: /location_voiture_mvc/public/categorie');
        exit;
    }

    $id = (int) $_GET['id'];
    $cat = Categorie::getById($id);

    if (!$cat) {
        header('Location: /location_voiture_mvc/public/categorie');
        exit;
    }

   
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        require __DIR__ . '/../Views/admin/modifier_categorie.php';
        return;
    }

    
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $imageName = $cat['image']; 

    if (!empty($_FILES['image']['name'])) {

        
        $oldImagePath = __DIR__ . '/../assets/uploads/' . $cat['image'];
        if (!empty($cat['image']) && file_exists($oldImagePath)) {
            unlink($oldImagePath);
        }

        
        $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $imageName = uniqid() . '.' . $extension;

        $tmpPath = $_FILES['image']['tmp_name'];
        $destination = __DIR__ . '/../assets/uploads/' . $imageName;
        move_uploaded_file($tmpPath, $destination);
    }

    
    Categorie::modifierCategorie($id, $nom, $description, $status, $imageName);

    header('Location: /location_voiture_mvc/public/categorie');
    exit;
}





}

?>