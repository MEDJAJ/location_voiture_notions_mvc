<?php
session_start();

require_once __DIR__ . '/../app/Core/Autoloader.php';

use App\Controllers\AuthController;
use App\Controllers\CategorieController;
use App\Controllers\AvisController;
use App\Controllers\VehiculeController;
use App\Controllers\ReservationController;
use App\Controllers\StatistiqueController;


$auth = new AuthController();
$categorie = new CategorieController();
$avisController = new AvisController();
$vehiculeController = new VehiculeController();
$reservationController = new ReservationController();
$statistiqueController=new StatistiqueController();


$uri = $_SERVER['REQUEST_URI'];


$uri = strtok($uri, '?');


$prefix = '/location_voiture_mvc/public/';
$action = '/';
if (strpos($uri, $prefix) === 0) {
    $action = substr($uri, strlen($prefix));
}


if ($action === '') $action = 'login';


switch ($action){
    case '':
    case 'login':
        $auth->login();
        break;

    case 'register':
        $auth->registerClient();
        break;

    case 'categorie':
        $categorie->afficherCategories();
        break;

    case 'avis':
    case 'index':
        $avisController->index();
        break;

    case 'ajauter':
        $avisController->ajouter();
        break;
    case 'supprimer':
        $avisController->supprimerAvis();
        break;
    case 'restaurer':
        $avisController->restaurerAvi();
        break;
    case 'modifier':
        $avisController->modifierAvis();
        break;

    case 'vehicule':
        $vehiculeController->getNometIdCategorie();
        break;
    case 'vehiculefilter':
        $vehiculeController->getVehiculeFiltrer();
        break;
    case 'vehicule_details':
        $vehiculeController->details();
        break;

    case 'ajauter_reservation':
        $reservationController->ajauterReservation();
        break;
    case 'ajouter_categorie':
        $categorie->ajauterCategories();
        break;
    case 'categorie_supprimer':
        $categorie->supprimerCategorie();
        break;
    case 'categorie_modifier':
        $categorie->modifierCategorie();
        break;

    case 'vehicule_categorie_admin':
        $vehiculeController->afficherVehicule();
        break;
    case 'supprimer_vehicule':
        $vehiculeController->supprimerVehicule();
        break;
    case 'modifier_vehicule':
        $vehiculeController->modifierVehicule();
        break;
    case 'ajauter_vehicule':
        $vehiculeController->afficherVehicule();
        break;

    case 'reservations':
        $reservationController->afficherReservation();
        break;
    case 'supprimer_reservation':
        $reservationController->supprimerReservation();
        break;
    case 'changer_status_reservation':
        $reservationController->changerStatusReservation();
        break;
    case 'modifier_reservation':
        $reservationController->modifierReservation();
        break;

    case 'afficher_avis':
        $avisController->afficherAvis();
        break;
    case 'supprimer_avi':
        $avisController->supprimerAvis();
        break;
    case 'restaurer_avi':
        $avisController->restaurerAvi();
        break;
    case 'modifier_avi':
        $avisController->modifierAvis();
        break;
    case 'statistique':
           $statistiqueController->getStatistique();break;
    case 'logout':
        $auth->logout();break;

    default:
        http_response_code(404);
        echo "404 not found";
        break;
}
