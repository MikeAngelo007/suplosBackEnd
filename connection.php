<?php
    $conn = new mysqli('localhost','root','','intelcost_bienes');

    if($conn -> connect_error){
        echo $error -> $conn -> connect_error;
    }

?>