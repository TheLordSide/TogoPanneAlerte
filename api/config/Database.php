<?php

namespace API\config;

require_once('./vendor/autoload.php');
require_once('./helpers/responseHelper.php');
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

class Database {
    
    // Paramètres de connexion à la base de données
    private $host;
    private $username;
    private $password;
    private $dbname;
    private $charset = 'utf8mb4';
    //Constructeur de la classe
    public function __construct() {
        $this->host = $_ENV['DB_Host'];
        $this->username = $_ENV['DB_User'];
        $this->password = $_ENV['DB_Pass'];
        $this->dbname = $_ENV['DB_Name'];
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
           // sendJsonResponse(['success' => true, 'data' => 'ss'],200);
            return $pdo;
        } catch (\PDOException $e) {
           // sendJsonErrorResponse($e->getMessage(), $e->getCode());
        }
    }
}
