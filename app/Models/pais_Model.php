<?php

namespace App\Models;

use Config\Database\Conexion;
use PDO;
use Exception;

class pais_Model {
   // protected static $conx;   
    public $message;/* revisar */
    private $queryPost = 'INSTERT INTO pais(idPais,  nombrePais) VALUES(:id,:np)';
    private $queryGetAll = 'SELECT * FROM pais';
    private $queryDelete = 'DELETE FROM pais WHERE id = :id';
    private $queryUpdate = 'UPDATE pais SET id=:id,nombrePais=:np WHERE id=:id';

    function __construct(private $Id, public $nombrePais){
    }

    public function __set($name, $value)
    {
        if (property_exists($this, $name)) {
                $this->$name = $value;
        }
        throw new Exception("Propiedad invalida: " . $name);
    }

    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
        throw new Exception("Propiedad invalidaa: " . $name);
    }


    public static function postPais(){
        try {
            $conx = new Conexion;
            $res = $conx->connect()->prepare(self::$queryPost);
            $res->bindValue("id", self::$Id);
            $res->bindValue("np", self::$nombrePais);
            $res->execute();
            self::$message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            self::$message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r(self::$message);
        }
    }

    public static function getpaisAll(){
        try {
            $conx = new Conexion;
            $res = $conx->connect()->prepare(self::$queryGetAll);
            $res->execute();
            self::$message = ["Code"=> 200, "Message"=> $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch(\PDOException $e) {
            self::$message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r(self::$message);
        }
    }

    public function putPais(){
        try {
            $conx = new Conexion;
            
            $res = $conx->connect()->prepare($queryUpdate);
            $res->bindValue('id',$this->id);
            $res->bindValue('name', $this->full_name);
            $res->execute();
            $this->message =["Code"=> 200, "Message"=> $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }

    public static function deletePais(){
        try {
            $conx = new Conexion;
            $res= $conx->connect()->prepare(self::$queryDelete);
            $res->bindParam(':id', $id);
            $res->execute();
            self::$message = ["Code"=> 200, "Message"=> $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch(\PDOException $e) {
            self::$message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r(self::$message);
        }
    }
}

?>