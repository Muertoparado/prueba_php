<?php

namespace App\Controllers;

use PDO;
use App\Models\pais_Model;

class pais_Controller{

/*     public function __construct(){

    } */

    

    public function GetPais(){
        try {
            $workReference = pais_Model::getpaisAll();
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function PostPais(){
        try {
            $datos = json_decode(file_get_contents('php://input'),true);
            $pReference = new pais_Model(...$datos);  
            echo json_encode($pReference->postPais());
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }   

    public function PutPais(){
        try {
            $_DATA = json_decode(file_get_contents('php://input'), true);
            $obj = new pais_Model($_DATA['id'],$_DATA['full_name'],$_DATA['cel_number'],$_DATA['relationship'],$_DATA['occupation'],);
            $res = $obj->putPais();
            print_r( ["Stado"=> 200, "Mensage"=> "Se ha actualizado el dato"]);
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function DeletePais(){
        try {   
            $datos = json_decode(file_get_contents('php://input'),true);
            $pReference = new pais_Model(...$datos['id']);  
            echo json_encode($pReference->deletePais());
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }


}
?>