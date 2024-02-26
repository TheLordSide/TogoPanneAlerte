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

     public static function createSignaler($idservices, $idusers, $type,$date){



     }
}