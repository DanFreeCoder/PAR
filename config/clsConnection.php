<?php

class clsConnection
{
   private $host = "localhost";
   private $dbname = "par_db";
   private $username = "root";
   private $password = "";

   private $conn;

   public function connect()
   {
      $this->conn = null; //initialize

      try {
         $this->conn = new PDO("mysql:host=" . $this->host . ";port=3306;dbname=" . $this->dbname, $this->username, $this->password); //open a conection
      } catch (PDOException $exception) {
         echo "Connection error: " . $exception->getMessage();   // Get errors;
      }

      return $this->conn;
   }
}
