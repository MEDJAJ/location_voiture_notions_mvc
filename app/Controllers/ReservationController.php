<?php
namespace App\Controllers;
use App\Modeles\Reservation;
class ReservationController
{
public function ajauterReservation(){

 $id_user = $_SESSION['id_user'] ?? null;

 echo $_SESSION['nom'];

 $id = $_GET['id'] ?? 0;

 $id_c = $_GET['id_c'] ?? 0;
 
        if ($id == 0 || $id_c == 0) {
            echo "ID véhicule ou catégorie introuvable";
            exit;
        }

    $success = "";

        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id_user){

            $lieuprice = trim($_POST['pricecharge'] ?? '');
            $datedebut = trim($_POST['datedebut'] ?? '');
            $datefin   = trim($_POST['datefin'] ?? '');

            $reservation = new Reservation(
                $datedebut,
                $datefin,
                $lieuprice,
                'en attente',
                $id_user,
                $id
            );

            if ($reservation->ajauterReservation()) {
                $success = "1";
                header("Location: /location_voiture_mvc/public/vehicule_details?id=$id&id_c=$id_c");
                exit;
            } else {
                  $success = "0";
                header("Location: /location_voiture_mvc/public/vehicule_details?id=$id&id_c=$id_c");
              
            }
        }
}



public static function afficherReservation(){

$reservations=Reservation::afficherReservations();


$nom=$_SESSION['nom'];

require __DIR__ .'/../Views/admin/reservations.php';
}


public function supprimerReservation(){
    $id=isset($_GET['id']) ? $_GET['id'] : 0;
if($id==0){
    echo "probleme de id introvable";
    exit;
}


if(Reservation::supprimerReservation($id)){
     header("Location: /location_voiture_mvc/public/reservations");
}
}


public function changerStatusReservation(){
    $id=isset($_GET['id']) ? $_GET['id'] : 0;
if($id==0){
    echo "probleme de id introvable";
    exit;
}
$change=Reservation::changerStatusReservation($id);

header("Location: /location_voiture_mvc/public/reservations");

}


public function modifierReservation(){
    
$id = $_GET['id'] ?? 0;
if ($id == 0) {
    die("ID de réservation introuvable");
}
 $id_user = $_SESSION['id_user'];


$reservation = Reservation::getReservationParId($id);
if (!$reservation) {
    die("Réservation non trouvée");
}


if (isset($_POST['modifier'])){
    $date_debut = $_POST['date_debut'];
    $date_fin   = $_POST['date_fin'];
    $lieu_prise = $_POST['lieu_prise'];
    $status     = $_POST['status'];
    $id_vehicule= $_POST['id_vehicule'];
    
    $res = new Reservation($date_debut, $date_fin, $lieu_prise, $status,$id_user,$id_vehicule);
    $res->modifierReservation($id);

    header("Location: /location_voiture_mvc/public/reservations");
    exit;
}
require __DIR__ .'/../Views/admin/modifierReservation.php';
}
}











?>