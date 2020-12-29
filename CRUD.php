<?php 
if($_POST['action']=='create'){

    try{
        require_once('connection.php');
        $stmt = $conn->prepare("INSERT INTO casas (Id, Direccion, Ciudad, Telefono, Codigo_Postal, Tipo, Precio) VALUES (?,?,?,?,?,?,?)");
        $stmt->bind_param("issssss", $_POST['id'], $_POST['direccion'],$_POST['ciudad'], $_POST['telefono'], $_POST['codigoPostal'], $_POST['tipo'], $_POST['precio']);
        $stmt->execute();
    
        $ID_IN=$stmt->insert_id;
        $stmt->close();
        $conn->close();
        //header('Location:validar_registro.php?exitoso=1&nombre=' . $nombre .'&apellido=' . $apellido . '&email=' . $email . '&fecha=' . $fecha . '&pedido=' . $pedido . '&registro=' . $registro . '&regalo=' . $regalo . '&total=' . $total);
        //header('Location:validar_registro.php?exitoso=1&nombre=' . $nombre);
    }catch(\Exception $e){
        echo $e->getMesage();
    }

    header("Location: http://localhost/suplos/index.html");
}
?>