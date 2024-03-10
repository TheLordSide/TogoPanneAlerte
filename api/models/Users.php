<?php

namespace API\models;


use API\config\Database;
require_once('./config/Database.php');
require_once('./helpers/messageHelper.php');


class Users {

    // Propriétés
    private $id;
    private $username;
    private $email;
    private $password;
    private $created_on;
    
    // Constructeur
    public function __construct($id, $username, $email, $password, $created_on) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->created_on = $created_on;
    }

    // Méthode de création d'un nouvel utilisateur
    public static function createUser($username, $email, $password) {
        try {
            // Connexion à la base de données
            $database = new Database();
            $pdo = $database->connect();
    
            // Vérification de l'unicité du username
            $stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $result = $stmt->fetch();
    
            // Si un utilisateur avec le même username existe déjà, renvoyer une erreur
            if ($result['count'] > 0) {
                sendJsonResponse(['success' => false, 'erreur' => MESSAGE_USER_EXISTING], 409);
            }
    
            // Hacher le mot de passe
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
            // Préparation de la requête d'insertion
            $stmt = $pdo->prepare("INSERT INTO users (username, password, email, created_on) VALUES (:username, :password, :email, NOW())");
    
            // Liaison des paramètres avec les valeurs fournies
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $hashedPassword); // Utilisation du mot de passe haché
            $stmt->bindParam(':email', $email);
    
            // Exécution de la requête
            $stmt->execute();
    
            // Récupération de l'ID du nouvel utilisateur
            $id = $pdo->lastInsertId();
    
            // Création d'un tableau contenant les données de l'utilisateur
            $userData = [
                'id' => $id,
                'username' => $username,
                'email' => $email,
                'created_on' => date('Y-m-d H:i:s')
            ];
    
            // Retourner les données de l'utilisateur
            return $userData;
    
        } catch (\PDOException $e) {
            // Gérer les exceptions
            return false;
        }
    }
   

    public static function getAllUsers() {
        try {
            // Connexion à la base de données
            $database = new Database();
            $pdo = $database->connect();
    
            // Préparation de la requête de sélection des utilisateurs
            $stmt = $pdo->prepare("SELECT id, username, email, created_on FROM users");
    
            // Exécution de la requête
            $stmt->execute();
    
            // Récupération de tous les utilisateurs sous forme de tableau associatif
            $users = $stmt->fetchAll();
            //unset($users['password']);
            return $users;
        } catch (\PDOException $e) {
            // Gérer les exceptions PDO
            return false;
        }
    }



    //Methode pour recuperer un utilisateur 

    public static function getUserById($id) {
        try {
            // Connexion à la base de données
            $database = new Database();
            $pdo = $database->connect();
    
            // Préparation de la requête pour récupérer l'utilisateur par son ID
            $stmt = $pdo->prepare("SELECT id, username, email, created_on FROM users WHERE id = :id");
    
            // Liaison du paramètre avec la valeur fournie
            $stmt->bindParam(':id', $id);
    
            // Exécution de la requête
            $stmt->execute();
    
            // Récupération de l'utilisateur sous forme de tableau associatif
            $user = $stmt->fetch();
    
            // Vérifier si l'utilisateur existe
            if ($user) {
                // Retourner les données de l'utilisateur
                return $user;
            } else {
                // L'utilisateur n'existe pas
                return false;
            }
        } catch (\PDOException $e) {
            // Gérer les exceptions PDO
            return false;
        }
    }

    
    


      // Méthode pour la connexion de l'utilisateur
      public static function loginUser($email, $password) {
        try {
            // Connexion à la base de données
            $database = new Database();
            $pdo = $database->connect();
    
            // Requête pour récupérer les informations de l'utilisateur
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch();
    
            // Vérifier si l'utilisateur existe et si le mot de passe est correct
            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
    
                // Retourner les données de l'utilisateur connecté
                unset($user['password']);
                return $user;
            } else {
                // Identifiants incorrects
                //sendJsonResponse(['success' => false, 'erreur' => MESSAGE_AUTH_INVALID], 409);
                return false;
            }
        } catch (\PDOException $e) {
            // Gérer les exceptions PDO
            return false;
        }
    }
    

    // Méthode pour la déconnexion de l'utilisateur

    public static function logoutUser() {
        // Démarrer ou reprendre une session
        session_start();
    
        // Détruire toutes les données associées à la session courante
        session_destroy();
    }


} 


