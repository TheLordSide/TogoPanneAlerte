<?php

namespace API\models;

use API\config\Database;
require_once('./config/Database.php');
require_once('./helpers/messageHelper.php');

class Services {

        // Propriétés
        private $id;
        private $designation;
        private $fournisseur;
        private $type;
        private $description;
        
        // Constructeur
        public function __construct($id, $designation, $fournisseur, $type, $description) {
            $this->id = $id;
            $this->designation = $designation;
            $this->fournisseur = $fournisseur;
            $this->type = $type;
            $this->description = $description;
        }

    public static function createService($designation, $fournisseur, $type,$description){

        try {
            // Connexion à la base de données
            $database = new Database();
            $pdo = $database->connect();

            //Verification de l'unicite du service
            $stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM services WHERE designation = :designation");
            $stmt->bindParam(':designation', $designation);
            $stmt->execute();
            $result = $stmt->fetch();
    
            // Si un service avec la même designation existe déjà, renvoyer une erreur
            if ($result['count'] > 0) {
                sendJsonResponse(['success' => false,'erreur' => MESSAGE_SERVICE_EXISTING], 409);
            }
    
            // Préparation de la requête d'insertion
            $stmt = $pdo->prepare("INSERT INTO services (designation, fournisseur, type, description) VALUES (:designation, :fournisseur, :type, :description)");
    
            // Liaison des paramètres avec les valeurs fournies
      -     $stmt->bindParam(':designation', $designation);
            $stmt->bindParam(':fournisseur', $fournisseur);
            $stmt->bindParam(':type', $type);
            $stmt->bindParam(':description', $description);
    
            // Exécution de la requête
            $stmt->execute();
    
            // Récupération de l'ID du nouvel utilisateur
            $id = $pdo->lastInsertId();
    
            // Création d'un tableau contenant les données de l'utilisateur
            $serviceData = [
                'id' => $id,
                'designation' => $designation,
                'fournisseur' => $fournisseur,
                'type' => $type,
                'description' =>$description
            ];
    
            // Retourner les données de l'utilisateur
            return $serviceData;
    
        } catch (\PDOException $e) {
            //sendJsonResponse(['success' => false, 'error' => $e->getMessage()], 500);
            return false;
        }

    }

    public static function getServiceById($id){
        try {
            // Connexion à la base de données
            $database = new Database();
            $pdo = $database->connect();
    
            // Préparation de la requête de sélection du service par son ID
            $stmt = $pdo->prepare("SELECT * FROM services WHERE id = :id");
            $stmt->bindParam(':id', $id);
            
            // Exécution de la requête
            $stmt->execute();
            
            // Récupération du service sous forme d'un tableau associatif
            $services = $stmt->fetch();
    
            // Retourner le service
            return $services;
        } catch (\PDOException $e) {
            // Gérer les exceptions PDO
            return false;
        }
    }
    
    public static function getAllServices() {
        try {
            // Connexion à la base de données
            $database = new Database();
            $pdo = $database->connect();
    
            // Préparation de la requête de sélection des utilisateurs
            $stmt = $pdo->prepare("SELECT * FROM services");
    
            // Exécution de la requête
            $stmt->execute();
    
            // Récupération de tous les utilisateurs sous forme de tableau associatif
            $services = $stmt->fetchAll();
    
            return $services;
        } catch (\PDOException $e) {
            // Gérer les exceptions PDO
            return false;
        }
    }

}