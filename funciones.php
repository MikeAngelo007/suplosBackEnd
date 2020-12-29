<?php

function consultaItem(){
    $registros=array();
    try{
        require_once('connection.php');
        $sql = "SELECT * FROM `casas`";
        $resultado = $conn->query($sql);
      }catch(\Exception $e){
          echo $e->getMesage();
      }

      while($consultado = $resultado->fetch_assoc()){
        $registros[]=$consultado;
      };


            $conn->close();
      return $registros;
}
    
?>