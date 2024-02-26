<?php

namespace API\controllers;

use API\models\Users;

require_once('./helpers/responseHelper.php');
require_once('./models/Users.php');
require_once('./helpers/messageHelper.php');


class UsersController {

    public function createUser() {
        // Obtenir les données utilisateur de la requête
        $username = $_POST['username'] ?? null;
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;

        // Vérifier si toutes les données requises sont fournies
        if ($username && $email && $password) {
            // Appeler la méthode statique de création d'un utilisateur
            $user = Users::createUser($username, $email, $password);

            // Vérifier si l'utilisateur a été créé avec succès
            if ($user) {
                // Envoie la réponse JSON avec les informations de l'utilisateur créé
                sendJsonResponse(['success' => true, 'data' => $user], 200);
            } else {
                // En cas d'échec de création de l'utilisateur
                sendJsonResponse(['success' => false, 'erreur' => MESSAGE_USER_CREATION_FAILED], 500);
            }
        } else {
            // Les données requises sont manquantes
            sendJsonResponse(['success' => false, 'erreur' => MESSAGE_USER_CREATION_MISSING], 400);
        }
    }


    public function getAllUsers() {
        // Récupérer tous les utilisateurs depuis la base de données
        $users = Users::getAllUsers();
    
        // Vérifier si des utilisateurs ont été trouvés
        if ($users !== false) {
            // Envoie la réponse JSON avec les utilisateurs
            sendJsonResponse(['success' => true, 'data' => $users], 200);
        } else {
            // En cas d'erreur ou d'aucun utilisateur trouvé
            sendJsonResponse(['success' => false, 'erreur' => MESSAGE_USER_FAILED_TO_FRESH], 500);
        }
    }


    public function getUserById($id) {
        // Récupérer l'utilisateur par son ID depuis la base de données
        $user = Users::getUserById($id);
    
        // Vérifier si l'utilisateur a été trouvé
        if ($user !== false) {
            // Envoie la réponse JSON avec les informations de l'utilisateur
            sendJsonResponse(['success' => true, 'data' => $user], 200);
        } else {
            // En cas d'erreur ou si l'utilisateur n'existe pas
            sendJsonResponse(['success' => false, 'erreur' => MESSAGE_USER_NOT_FOUND], 404);
        }
    }
    
}

