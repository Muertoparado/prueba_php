<?php

namespace App\Controllers;

use PDO;
use App\Models\region_Model;

class region_Controller{
  

    public function GetRegion(){
        try {
            $workReference = region_Model::getRegionAll();
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function PostRegion(){
        try {
            $datos = json_decode(file_get_contents('php://input'),true);
            $pReference = new region_Model(...$datos);  
            echo json_encode($pReference->postRegion());
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }   

    public function PutRegion(){
        try {
            $_DATA = json_decode(file_get_contents('php://input'), true);
            $obj = new region_Model($_DATA['id'],$_DATA['full_name'],$_DATA['cel_number'],$_DATA['relationship'],$_DATA['occupation'],);
            $res = $obj->putRegion();
            print_r( ["Stado"=> 200, "Mensage"=> "Se ha actualizado el dato"]);
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function DeleteRegion(){
        try {   
            $datos = json_decode(file_get_contents('php://input'),true);
            $pReference = new region_Model(...$datos['id']);  
            echo json_encode($pReference->deleteRegion());
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }


}
?>