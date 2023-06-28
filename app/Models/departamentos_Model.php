<?php

namespace App\Models;

use Config\Database\Conexion;
use PDO;
use Exception;

class departamento_Model {
   // protected static $conx;   
    public $message;/* revisar */
    private $queryPost = 'INSTERT INT departamento(idDep, nombreDep, idPais) VALUES(:id,:nd,:idp)';
    private $queryGetAll = 'SELECT * FROM departamento';
    private $queryDelete = 'DELETE FROM departamento WHERE id = :id';
    private $queryUpdate = 'UPDATE departamento SET id=:idnombreDep=:nd WHERE id=:id';

    function __construct(private $Id, public $nombreDep, public $idPais){
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


    public static function postdepartamento(){
        try {
            $conx = new Conexion;
            $res = $conx->connect()->prepare(self::$queryPost);
            $res->bindValue("id", self::$Id);
            $res->bindValue("nd", self::nombreDep);
            $res->bindValue("idp", self::idPais);
            $res->execute();
            self::$message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            self::$message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r(self::$message);
        }
    }

    public static function getdepartamentoAll(){
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

    public function putdepartamento(){
        try {
            $conx = new Conexion;
            
            $res = $conx->connect()->prepare($queryUpdate);
            $res->bindValue('id',$this->id);
            $res->bindValue('nd', $this->nombreDep);
            $res->bindValue("idp", $this->idPais);
            $res->execute();
            $this->message =["Code"=> 200, "Message"=> $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }

    public static function deletedepartamento(){
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