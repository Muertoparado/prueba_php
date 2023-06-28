<?php

namespace Config\Database;

use PDO;

class Conexion {
    private $dbname;
    private $host;
    private $pdo;
    private $user;
    private $password;
    private $port;
    function __construct()
    {
        echo "asdasd";
        try {
            $this->host = $_ENV['HOST'];
            $this->dbname = $_ENV['DATABASE'];
            $this->user = $_ENV['USER'];
            $this->password = $_ENV['PASSWORD'];
         //   $this->port = $_ENV['PORT'];

         //metodo 1
         $this->flags = [
            // Turn off persistent connections
            \PDO::ATTR_PERSISTENT => false,
            // Enable exceptions
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            // Emulate prepared statements
            \PDO::ATTR_EMULATE_PREPARES => true,
            // Set default fetch mode to array
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            // Set character set
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci'
         ];    
         //metodo 2            
            $dsn = 'mysql:host=' . $this->host . ';dbname='. $this->dbname;
            $this->pdo = new PDO($dsn,$this->user,$this->password,);
           // $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           
           $this->pdo->setAttribute(this->flags);
            echo"ok";

           
        } catch (\PDOException $e) {
            echo "pailas";
            // echo ('message'=> 'error conexion');
            print_r('error'.$e->getMessage());
        }
        return $this->connect();
    }

    public function connect(){
        try {
            return $this->pdo;
        } catch (\PDOException $th) {
            $error = [
                'message' => 'Error al retornar la conexion',
                'error' => $th->getMessage()
            ];
            return $error;
        }
    }


    public function disconect(){
        $this->pdo=null;
    }
}
?>