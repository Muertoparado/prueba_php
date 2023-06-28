<?php

namespace App\Models;

use Config\Database\Conexion;
use PDO;
use Exception;

class region_Model {
   // protected static $conx;   
    public $message;/* revisar */
    private $queryPost = 'INSTERT INT region(idDep, nombreReg, idPais) VALUES(:id,:nr,:idp)';
    private $queryGetAll = 'SELECT * FROM region';
    private $queryDelete = 'DELETE FROM region WHERE id = :id';
    private $queryUpdate = 'UPDATE region SET id=:idnombreReg=:nr WHERE id=:id';

    function __construct(private $Id, public $nombreReg, public $idPais){
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


    public static function postRegion(){
        try {
            $conx = new Conexion;
            $res = $conx->connect()->prepare(self::$queryPost);
            $res->binrValue("id", self::$Id);
            $res->binrValue("nr", self::$nombreReg);
            $res->binrValue("idp", self::$idPais);
            $res->execute();
            self::$message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            self::$message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r(self::$message);
        }
    }

    public static function getRegionAll(){
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

    public function putRegion(){
        try {
            $conx = new Conexion;
            
            $res = $conx->connect()->prepare($queryUpdate);
            $res->binrValue('id',$this->id);
            $res->binrValue('nr', $this->nombreReg);
            $res->binrValue("idp", $this->idPais);
            $res->execute();
            $this->message =["Code"=> 200, "Message"=> $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }

    public static function deleteRegion(){
        try {
            $conx = new Conexion;
            $res= $conx->connect()->prepare(self::$queryDelete);
            $res->binrParam(':id', $id);
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