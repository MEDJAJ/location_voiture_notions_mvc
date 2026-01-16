<?php
namespace App\Modeles;

use App\Core\Database;
use PDO;


class Reservation{
    private $date_debut;
    private $date_fin;
    private $lieu_prise;
    private $status;
    private $id_user;
    private $id_vehicule;

    public function __construct($date_debut,$date_fin,$lieu_prise,$status,$id_user,$id_vehicule){
        $this->date_dabut=$date_debut;
        $this->date_fin=$date_fin;
        $this->lieu_price=$lieu_prise;
        $this->status=$status;
        $this->id_user=$id_user;
        $this->id_vehicule=$id_vehicule;
    }


    public function ajauterReservation(){
        $conn = Database::getInstance()->getConnection();
        $sql="CALL AjouterReservation(:dateDebut,:dateFin,:lieuPrise,:status,:id_user,:id_vehicule)
        ";
         $stm=$conn->prepare($sql);
        return $stm->execute([
            ':dateDebut'=>$this->date_dabut,
         ':dateFin'=>$this->date_fin,
         ':lieuPrise'=>$this->lieu_price,
         ':status'=>  $this->status,
         ':id_user'=> $this->id_user,
         ':id_vehicule'=>$this->id_vehicule,
         ]);

    }

    public static function afficherReservations(){
        $conn = Database::getInstance()->getConnection();
        $sql="SELECT u.nom,u.email,v.modele,v.marque,r.dateDebut,r.dateFin,r.status,r.id_reservation FROM reservations r INNER JOIN users u ON r.id_user=u.id_user INNER JOIN vehicules v ON v.id_vehicule=r.id_vehicule";
        $stm=$conn->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);

    }


    public static function changerStatusReservation($id){
        $conn = Database::getInstance()->getConnection();
        $sql="UPDATE reservations SET status='confirmée' WHERE id_reservation=:id";
        $stm=$conn->prepare($sql);
       return $stm->execute([":id"=>$id]);
    } 


    public static function supprimerReservation($id){
        $conn = Database::getInstance()->getConnection();
        $sql="DELETE FROM reservations WHERE id_reservation=:id";
        $stm=$conn->prepare($sql);
       return $stm->execute([':id'=>$id]);

    }

    public static function getReservationParId($id){
        $conn = Database::getInstance()->getConnection();
        $sql="SELECT r.dateDebut,r.dateFin,r.status,r.lieuPrise,r.id_vehicule FROM reservations r WHERE r.id_reservation =:id";
        $stm=$conn->prepare($sql);
        $stm->execute([':id'=>$id]);
        return $stm->fetch(PDO::FETCH_ASSOC);
    }


    public function modifierReservation($id){
        $conn = Database::getInstance()->getConnection();
        $sql="UPDATE reservations SET dateDebut=:date_debut,dateFin=:date_fin,lieuPrise=:lieuprise,status=:statusreservation WHERE id_reservation=:id";
        $stm=$conn->prepare($sql);
    return    $stm->execute([
            ':date_debut'=>$this->date_dabut,
            ':date_fin'=>$this->date_fin,
            ':lieuprise'=>$this->lieu_price,
            ':statusreservation'=>$this->status,
            ':id'=>$id
        ]);
    }





    


public static function countReservations(){
    $conn = Database::getInstance()->getConnection();
    $stm=$conn->prepare("SELECT * FROM reservations");
    $stm->execute();
    return count($stm->fetchAll(PDO::FETCH_ASSOC));
}

public static function countReservationsConfirme(){
    $conn = Database::getInstance()->getConnection();
    $stm=$conn->prepare("SELECT * FROM reservations where status='confirmée'");
    $stm->execute();
    return count($stm->fetchAll(PDO::FETCH_ASSOC));
}

public static function countReservationsEnAttente(){
    $conn = Database::getInstance()->getConnection();
    $stm=$conn->prepare("SELECT * FROM reservations where status='en attente'");
    $stm->execute();
    return count($stm->fetchAll(PDO::FETCH_ASSOC));
}




}



?>