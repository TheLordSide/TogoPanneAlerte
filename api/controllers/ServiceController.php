<?php

namespace API\controllers;

use API\models\Services;

require_once('./helpers/responseHelper.php');
require_once('./models/Services.php');
require_once('./helpers/messageHelper.php');


class ServicesController {

    public function createService() {
        // Obtenir les données utilisateur de la requête
        $designation = $_POST['designation'] ?? null;
        $fournisseur = $_POST['fournisseur'] ?? null;
        $type = $_POST['type'] ?? null;
        $description = $_POST['description']??null;

        // Vérifier si toutes les données requises sont fournies
        if ($designation && $fournisseur && $type && $description) {
            // Appeler la méthode statique de création d'un service
            $service = Services ::createService($designation,$fournisseur,$type,$description);

            // Vérifier si le service a été créé avec succès
            if ($service) {
                // Envoie la réponse JSON avec les informations du service créé
                sendJsonResponse(['success' => true, 'data' => $service], 200);
            } else {
                // En cas d'échec de création du service
                sendJsonResponse(['success' => false, 'error' => MESSAGE_SERVICE_CREATION_FAILED], 500);
            }
        } else {
            // Les données requises sont manquantes
            sendJsonResponse(['success' => false, 'error' => MESSAGE_SERVICE_CREATION_MISSING], 400);
        }
    }

    public function getServiceById($id) {
        // Vérifier si l'ID du service est fourni
        if ($id) {
            // Appeler la méthode statique pour récupérer le service par son ID
            $service = Services::getServiceById($id);

            // Vérifier si le service a été trouvé
            if ($service) {
                // Envoyer la réponse JSON avec les informations du service
                sendJsonResponse(['success' => true, 'data' => $service], 200);
            } else {
                // En cas d'échec de récupération du service
                sendJsonResponse(['success' => false, 'error' => MESSAGE_SERVICE_NOT_FOUND], 404);
            }
        } else {
            // L'ID du service est manquant
            sendJsonResponse(['success' => false, 'error' => 'Service ID is missing'], 400);
        }
    }

    public function getAllServices() {
        // Récupérer tous les utilisateurs depuis la base de données
        $services = Services::getAllServices();
    
        // Vérifier si des utilisateurs ont été trouvés
        if ($services !== false) {
            // Envoie la réponse JSON avec les utilisateurs
            sendJsonResponse(['success' => true, 'data' => $services], 200);
        } else {
            // En cas d'erreur ou d'aucun utilisateur trouvé
            sendJsonResponse(['success' => false, 'error' => 'Failed to fetch '], 500);
        }
    }

}