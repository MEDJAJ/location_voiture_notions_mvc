<?php
namespace App\Modeles;
use App\Core\Database;
use PDO;
class Vehicle{
     private $modele;
     private $marque;
     private $disponibilite;
     private $id_categorie;
     private $image;

     public function __construct($modele,$marque,$disponible,$id_categorie,$image){
        $this->modele=$modele;
        $this->marque=$marque;
        $this->disponible=$disponible;
        $this->id_categorie=$id_categorie;
        $this->image=$image;
     }


  public static function afficherVehicule()
{
    $db = Database::getInstance()->getConnection();

    $sql = "
        SELECT 
            v.*, 
            c.nom AS categorie_nom
        FROM vehicules v
        JOIN categories c ON c.id_categorie = v.id_categorie
    ";

    return $db->query($sql)->fetchAll();
}


   
    public static function supprimerVehicule($id){
        $conn = Database::getInstance()->getConnection();
        $stmt = $conn->prepare("DELETE FROM vehicules WHERE id_vehicule= ?");
        return $stmt->execute([$id]);
    }


    public static function modifierVehicule($id,$modele,$marque,$disponibilite,$id_categorie,$image,$prix) {
        $conn = Database::getInstance()->getConnection();
        $stmt = $conn->prepare("UPDATE vehicules SET modele = ?, marque = ?, disponibilite = ?,id_categorie= ?, image= ?,prix = ? WHERE id_vehicule = ?");
        return $stmt->execute([$modele, $marque, $disponibilite,$id_categorie, $image,$prix,$id]);
    }

    
    public static function ajouterMasse( $data){
        $conn = Database::getInstance()->getConnection();
        $stmt = $conn->prepare("INSERT INTO vehicules (modele, marque, disponibilite,id_categorie,image,prix) VALUES (?, ?, ?,?,?,?)");
        foreach ($data as $row) {
            $stmt->execute([$row['modele'],$row['marque'], $row['disponible'], $row['nom_categorie'],$row['image'],$row['prix']]);
        }
    } 

    public static function getById($idVehicule) {
        $conn = Database::getInstance()->getConnection();

    $stmt = $conn->prepare(
        "SELECT * 
         FROM ListeVehicules 
         WHERE id_vehicule = :idVehicule"
    );

  
    $stmt->execute([
        ':idVehicule' => $idVehicule
    ]);

   
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


public static function getvehiculesParCategorie($id){
    $conn = Database::getInstance()->getConnection();
    $sql="SELECT * FROM vehicules WHERE id_categorie=:id";
    $stm=$conn->prepare($sql);
  $stm->execute([':id'=>$id]);
  return $stm->fetchAll(PDO::FETCH_ASSOC);
}






public static function countVehiculesParCategorie( $id){
    $conn = Database::getInstance()->getConnection();
    $sql = "SELECT COUNT(*) FROM vehicules WHERE id_categorie = :id";
    $stm = $conn->prepare($sql);
    $stm->execute([':id' => $id]);
    return $stm->fetchColumn();
}












public static function countVehiculesFilter( $id, $marque, $dispo) {
    $conn = Database::getInstance()->getConnection();
    $sql = "SELECT COUNT(*) FROM vehicules WHERE id_categorie = :id";

    if ($marque !== '') {
        $sql .= " AND marque LIKE :marque";
    }
    if ($dispo !== '') {
        $sql .= " AND disponibilite = :dispo";
    }

    $stm = $conn->prepare($sql);
    $stm->bindValue(':id', $id);

    if ($marque !== '') {
        $stm->bindValue(':marque', "%$marque%");
    }
    if ($dispo !== '') {
        $stm->bindValue(':dispo', $dispo);
    }

    $stm->execute();
    return $stm->fetchColumn();
}


public static function getVehiculesFilterPaginated($id, $marque, $dispo, $limit, $offset) {
    $conn = Database::getInstance()->getConnection();
    $sql = "SELECT * FROM vehicules WHERE id_categorie = :id";

    if ($marque !== '') {
        $sql .= " AND marque LIKE :marque";
    }
    if ($dispo !== '') {
        $sql .= " AND disponibilite = :dispo";
    }

    $sql .= " LIMIT :limit OFFSET :offset";

    $stm = $conn->prepare($sql);
    $stm->bindValue(':id', $id, PDO::PARAM_INT);
    $stm->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stm->bindValue(':offset', $offset, PDO::PARAM_INT);

    if ($marque !== '') {
        $stm->bindValue(':marque', "%$marque%");
    }
    if ($dispo !== '') {
        $stm->bindValue(':dispo', $dispo);
    }

    $stm->execute();
    return $stm->fetchAll(PDO::FETCH_ASSOC);
}




public static function countVehicule(){
    $conn = Database::getInstance()->getConnection();
    $stm=$conn->prepare("SELECT * FROM vehicules");
    $stm->execute();
    return count($stm->fetchAll(PDO::FETCH_ASSOC));
}

public static function countVehiculeDisponble(){
    $conn = Database::getInstance()->getConnection();
    $stm=$conn->prepare("SELECT * FROM vehicules where disponibilite='1'");
    $stm->execute();
    return count($stm->fetchAll(PDO::FETCH_ASSOC));
}

public static function countVehiculeIndisponible(){
    $conn = Database::getInstance()->getConnection();
    $stm=$conn->prepare("SELECT * FROM vehicules where disponibilite='0'");
    $stm->execute();
    return count($stm->fetchAll(PDO::FETCH_ASSOC));
}


public static function getDispVehicule($id){
    $conn = Database::getInstance()->getConnection();
    $sql="SELECT disponibilite FROM vehicules WHERE id_vehicule=:id_vehicule";
    $stm=$conn->prepare($sql);
    $stm->execute([':id_vehicule'=>$id]);
    return $stm->fetch(PDO::FETCH_ASSOC);
}


}

?>