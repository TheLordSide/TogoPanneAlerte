<?php

namespace API\controllers;

use API\models\Users;
require_once('./helpers/responseHelper.php');
require_once('./models/Users.php');
require_once('./helpers/messageHelper.php');

class AuthController {


    public function loginUser() {
        // Obtenir les données utilisateur de la requête
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;
    
        // Vérifier si les champs username et password sont renseignés
        if (empty($email) || empty($password)) {
            // En cas de champs manquants, renvoyer une réponse d'erreur
            sendJsonResponse(['success' => false, 'error' => MESSAGE_AUTH_MISSING], 400);
            return;
        }
    
        // Tenter de connecter l'utilisateur
        $user = Users::loginUser($email, $password);
    
        // Vérifier si la connexion a réussi
        if ($user !== false) {
            // La connexion a réussi, retourner les données de l'utilisateur connecté
            sendJsonResponse(['success' => true, 'user' => $user], 200);
        } else {
            // La connexion a échoué, renvoyer un message d'erreur
            sendJsonResponse(['success' => false, 'error' => MESSAGE_AUTH_INVALID], 401);
        }
    }
    
    // Méthode pour la déconnexion de l'utilisateur
    public static function logoutUser() {
        // Démarrer ou reprendre une session
        session_start();
    
        // Détruire toutes les données associées à la session courante
        session_destroy();
    
        // Renvoyer une réponse indiquant que l'utilisateur est déconnecté
        sendJsonResponse(['success' => true, 'message' => 'Déconnexion réussie.'], 200);
    }


 

}
