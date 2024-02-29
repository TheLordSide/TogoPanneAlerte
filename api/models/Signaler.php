<?php

namespace API\models;

use API\config\Database;
require_once('./config/Database.php');
require_once('./helpers/messageHelper.php');

class Signaler{

     // Propriétés
     private $id;
     private $idservices;
     private $idusers;
     private $date;
     
     // Constructeur
     public function __construct($id, $idservices, $idusers, $date) {
         $this->id = $id;
         $this->idservices = $idservices;
         $this->idusers = $idusers;
         $this->date = $date;
     }

     public static function createSignaler($idservices, $idusers, $type) {
        // Créer une nouvelle instance de la classe Signaler
        $database = new Database();
        $pdo = $database->connect();
    
        // Requête SQL pour insérer un nouveau signalement dans la base de données
        $stmt = $pdo->prepare("INSERT INTO signalements (idservices, idusers, date, type) VALUES (:idservices, :idusers, NOW(), :type)");
    
        // Liaison des paramètres
        $stmt->bindParam(':idservices', $idservices);
        $stmt->bindParam(':idusers', $idusers);
        $stmt->bindParam(':type', $type);
    
        // Exécution de la requête
        if($stmt->execute()) {
            // Succès : retourner true
            $id = $pdo->lastInsertId();
    
            // Création d'un tableau contenant les données de l'utilisateur
            $signalerData = [
                'id' => $id,
                'idservice' => $idservices,
                'iduser' => $idusers,
                'date' => date('Y-m-d H:i:s')
            ];
    
            // Retourner les données de l'utilisateur
            return $signalerData;

        } else {
            // Erreur : retourner false
            return false;
        }
    }
    
}