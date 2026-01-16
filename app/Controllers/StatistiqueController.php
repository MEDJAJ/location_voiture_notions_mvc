<?php

namespace App\Controllers;
use App\Modeles\Reservation;
use App\Modeles\Categorie;
use App\Modeles\Vehicle;
use App\Modeles\Avis;
use App\Modeles\Client;
class StatistiqueController{


public function getStatistique(){
    $coun_v=Vehicle::countVehicule();
$coun_v_disp=Vehicle::countVehiculeDisponble();
$coun_v_indisp=Vehicle::countVehiculeIndisponible();

$count_client=Client::countClients();

$count_reservations=Reservation::countReservations();
$count_reser_conf=Reservation::countReservationsConfirme();
$count_reser_atten=Reservation::countReservationsEnAttente();

$count_categories=Categorie::countCategorie();
$count_cat_dis=Categorie::countCategorieDisponble();
$count_cat_ind=Categorie::countCategorieIndisponible();


$nom=$_SESSION['nom'];

require __DIR__ . '/../Views/admin/Statistiques.php';
}
}