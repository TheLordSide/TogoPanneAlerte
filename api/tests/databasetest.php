<?php
class databasetest {
    
    // Paramètres de connexion à la base de données
    private $host;
    private $username;
    private $password;
    private $dbname;
    private $charset = 'utf8mb4';

    public function __construct() {
        $this->host = $_ENV['DB_Host'];
        $this->username = $_ENV['DB_User'];
        $this->password = $_ENV['DB_Pass'];
        $this->dbname = $_ENV['DB_Name'];
    }

    // Méthode getter pour récupérer la valeur de l'hôte
    public function getHost() {
        return $this->host;
    }

    // Méthode getter pour récupérer la valeur du nom d'utilisateur
    public function getUsername() {
        return $this->username;
    }

    // Méthode getter pour récupérer la valeur du mot de passe
    public function getPassword() {
        return $this->password;
    }

    // Méthode getter pour récupérer la valeur du nom de la base de données
    public function getDbname() {
        return $this->dbname;
    }

    // Méthode pour obtenir la connexion à la base de données
    public function connect() {
        $dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=$this->charset";
        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $pdo = new \PDO($dsn, $this->username, $this->password, $options);

            return $pdo;
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), $e->getCode());
        }
    }
}
