<?php

namespace API\controllers;

use API\models\Signaler;

require_once('./helpers/responseHelper.php');
require_once('./models/Signaler.php');
require_once('./helpers/messageHelper.php');

class SignalerController{

    public function createSignaler() {
        // Obtenir les données utilisateur de la requête
        $idservices = $_POST['idservices'] ?? null;
        $idusers = $_POST['idusers'] ?? null;
        $type = $_POST['type'] ?? null;
    
        // Vérifier si toutes les données requises sont fournies
        if ($idservices && $idusers && $type) {
            // Appeler la méthode statique de création d'un signalement
            $signaler = Signaler::createSignaler($idservices, $idusers, $type);
    
            // Vérifier si le signalement a été créé avec succès
            if ($signaler !== false) {
                // Envoie la réponse JSON avec les informations du signalement créé
                sendJsonResponse(['success' => true, 'data' => $signaler], 200);
            } else {
                // En cas d'échec de création du signalement
                sendJsonResponse(['success' => false, 'erreur' => MESSAGE_SIGNAL_ERROR], 500);
            }
        } else {
            // Les données requises sont manquantes
                sendJsonResponse(['success' => false, 'erreur' => MESSAGE_SIGNAL_MISSING], 400);
        }
    }
    

}