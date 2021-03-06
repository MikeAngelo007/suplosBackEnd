<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/customColors.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/ion.rangeSlider.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/index.css"  media="screen,projection"/>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Formulario</title>
</head>

<body>
  <?php 
    $data=file_get_contents('data-1.json');
    $informacion=json_decode($data,true);


     
    include_once'funciones.php';
                    
    $guardados=consultaItem();
    
  ?>
  <video src="img/video.mp4" id="vidFondo"></video>

  <div class="contenedor">
    <div class="card rowTitulo">
      <h1>Bienes Intelcost</h1>
    </div>
    <div class="colFiltros">
      <form action="index.html" method="post" id="formulario">
        
      <?php $ciudades=array_unique(array_column($informacion,'Ciudad'));?>
      <?php $tipos=array_unique(array_column($informacion,'Tipo'));?>
        <div class="filtrosContenido">
          <div class="tituloFiltros">
            <h5>Filtros</h5>
          </div>
          <div class="filtroCiudad input-field">
            <p><label for="selectCiudad">Ciudad:</label><br></p>
            <select name="ciudad" id="selectCiudad">
              <option value="" selected>Elige una ciudad (Todas)</option>
              <?php foreach($ciudades as $ciudad){
                ?>
                <option value="<?php echo $ciudad?>" 
                <?php 
                if(!empty($_POST['ciudad'])){
                  echo $_POST['ciudad']==$ciudad? 'selected':'';
                  } ?>
                  >
                  <?php echo $ciudad?></option>
                <?php
              }?>
            </select>
          </div>
          <div class="filtroTipo input-field">
            <p><label for="selecTipo">Tipo:</label></p>
            <br>
            <select name="tipo" id="selectTipo">
              <option value="">Elige un tipo (Todos)</option>
              <?php foreach($tipos as $tipo){
                ?>
                <option value="<?php echo $tipo?>" 
                <?php 
                if(!empty($_POST['tipo'])){
                  echo $_POST['tipo']==$tipo? 'selected':'';
                  } ?>><?php echo $tipo?></option>
                <?php
              }?>
            </select>
          </div>
          <div class="filtroPrecio">
            <label for="rangoPrecio">Precio:</label>
            <input type="text" id="rangoPrecio" name="precio" value="" />
          </div>
          <div class="botonField">
            <input type="submit" class="btn white" value="Buscar" id="submitButton">
          </div>
        </div>
      </form>
    </div>
    <div id="tabs" style="width: 75%;">
      <ul>
        <li><a href="#tabs-1">Bienes disponibles</a></li>
        <li><a href="#tabs-2">Mis bienes</a></li>
      </ul>
      <div id="tabs-1">
        <?php
        if(!empty($_POST['ciudad']) or !empty($_POST['tipo'])){
          ?>
          <div class="colContenido" id="divResultadosBusqueda">
            <div class="tituloContenido card" style="justify-content: center;">
              <h5>Resultados de la búsqueda:</h5>
              <div class="divider"></div>
              <?php
                foreach($informacion as $item){
                  if((!empty($_POST['ciudad']) and !empty($_POST['tipo'])) and ($item['Ciudad']==$_POST['ciudad'] and $item['Tipo']==$_POST['tipo'])){
                    ?>
                    <div class="itemMostrado">
                      <img src="img/home.jpg" alt="Home">
                      <div class="card-stacked">
                        <h6><strong>Dirección:</strong> <?php echo $item['Direccion']?> </h6>
                        <h6><strong>Ciudad:</strong> <?php echo $item['Ciudad']?> </h6>
                        <h6><strong>Telefono:</strong> <?php echo $item['Telefono']?> </h6>
                        <h6><strong>Codigo postal:</strong> <?php echo $item['Codigo_Postal']?> </h6>
                        <h6><strong>Tipo:</strong> <?php echo $item['Tipo']?> </h6>
                        <h6 class="precioTexto"><strong>Precio:</strong> <?php echo $item['Precio']?> </h6>
                      </div>
                    </div>
                    <?php

                    if(in_array($item['Id'],array_column($guardados,'Id'))){
                      ?>
                      <button class="btn green" style="color: white;"><strong>Guardado</strong></button>
                      <?php
                    }else{
                      ?>
                      <form action="CRUD.php" method="post">
                        <input type="hidden" name="action" value="create">
                        <input type="hidden" name="id" value="<?php echo $item['Id']?>">
                        <input type="hidden" name="direccion" value="<?php echo $item['Direccion']?>">
                        <input type="hidden" name="ciudad" value="<?php echo $item['Ciudad']?>">
                        <input type="hidden" name="telefono" value="<?php echo $item['Telefono']?>">
                        <input type="hidden" name="codigoPostal" value="<?php echo $item['Codigo_Postal']?>">
                        <input type="hidden" name="tipo" value="<?php echo $item['Tipo']?>">
                        <input type="hidden" name="precio" value="<?php echo $item['Precio']?>">
  
                        <div class="botonField">
                          <input type="submit" class="btn white" value="Guardar" id="submitButton">
                        </div>
                      </form>
                      <?php
                    }
                    ?>
                    <div class="divider"></div>
                    <?php
                  }
                  elseif((!empty($_POST['ciudad']) and empty($_POST['tipo'])) and ($item['Ciudad']==$_POST['ciudad'])){
                    ?>
                    <div class="itemMostrado">
                      <img src="img/home.jpg" alt="Home">
                      <div class="card-stacked">
                        <h6><strong>Dirección:</strong> <?php echo $item['Direccion']?> </h6>
                        <h6><strong>Ciudad:</strong> <?php echo $item['Ciudad']?> </h6>
                        <h6><strong>Telefono:</strong> <?php echo $item['Telefono']?> </h6>
                        <h6><strong>Codigo postal:</strong> <?php echo $item['Codigo_Postal']?> </h6>
                        <h6><strong>Tipo:</strong> <?php echo $item['Tipo']?> </h6>
                        <h6 class="precioTexto"><strong>Precio:</strong> <?php echo $item['Precio']?> </h6>
                      </div>
                    </div>
                    <?php

                    if(in_array($item['Id'],array_column($guardados,'Id'))){
                      ?>
                      <button class="btn green" style="color: white;"><strong>Guardado</strong></button>
                      <?php
                    }else{
                      ?>
                      <form action="CRUD.php" method="post">
                        <input type="hidden" name="action" value="create">
                        <input type="hidden" name="id" value="<?php echo $item['Id']?>">
                        <input type="hidden" name="direccion" value="<?php echo $item['Direccion']?>">
                        <input type="hidden" name="ciudad" value="<?php echo $item['Ciudad']?>">
                        <input type="hidden" name="telefono" value="<?php echo $item['Telefono']?>">
                        <input type="hidden" name="codigoPostal" value="<?php echo $item['Codigo_Postal']?>">
                        <input type="hidden" name="tipo" value="<?php echo $item['Tipo']?>">
                        <input type="hidden" name="precio" value="<?php echo $item['Precio']?>">
  
                        <div class="botonField">
                          <input type="submit" class="btn white" value="Guardar" id="submitButton">
                        </div>
                      </form>
                      <?php
                    }
                    ?>
                    <div class="divider"></div>
                    <?php
                  }
                  elseif((!empty($_POST['tipo']) and empty($_POST['ciudad'])) and ($item['Tipo']==$_POST['tipo'])){
                    ?>
                    <div class="itemMostrado">
                      <img src="img/home.jpg" alt="Home">
                      <div class="card-stacked">
                        <h6><strong>Dirección:</strong> <?php echo $item['Direccion']?> </h6>
                        <h6><strong>Ciudad:</strong> <?php echo $item['Ciudad']?> </h6>
                        <h6><strong>Telefono:</strong> <?php echo $item['Telefono']?> </h6>
                        <h6><strong>Codigo postal:</strong> <?php echo $item['Codigo_Postal']?> </h6>
                        <h6><strong>Tipo:</strong> <?php echo $item['Tipo']?> </h6>
                        <h6 class="precioTexto"><strong>Precio:</strong> <?php echo $item['Precio']?> </h6>
                      </div>
                    </div>
                    <?php

                    if(in_array($item['Id'],array_column($guardados,'Id'))){
                      ?>
                      <button class="btn green" style="color: white;"><strong>Guardado</strong></button>
                      <?php
                    }else{
                      ?>
                      <form action="CRUD.php" method="post">
                        <input type="hidden" name="action" value="create">
                        <input type="hidden" name="id" value="<?php echo $item['Id']?>">
                        <input type="hidden" name="direccion" value="<?php echo $item['Direccion']?>">
                        <input type="hidden" name="ciudad" value="<?php echo $item['Ciudad']?>">
                        <input type="hidden" name="telefono" value="<?php echo $item['Telefono']?>">
                        <input type="hidden" name="codigoPostal" value="<?php echo $item['Codigo_Postal']?>">
                        <input type="hidden" name="tipo" value="<?php echo $item['Tipo']?>">
                        <input type="hidden" name="precio" value="<?php echo $item['Precio']?>">
  
                        <div class="botonField">
                          <input type="submit" class="btn white" value="Guardar" id="submitButton">
                        </div>
                      </form>
                      <?php
                    }
                    ?>
                    <div class="divider"></div>
                    <?php
                  }
                  ?>
                  <?php
                }
              ?>
            </div>
          </div>
          <?php
        }else{
          ?>
            <div class="tituloContenido card" style="justify-content: center;">
              <h5>Resultados de la búsqueda:</h5>
              <div class="divider"></div>
              <?php 
                foreach($informacion as $item){

                  ?>
                    <div class="itemMostrado">
                      <img src="img/home.jpg" alt="Home">
                      <div class="card-stacked">
                        <h6><strong>Dirección:</strong> <?php echo $item['Direccion']?> </h6>
                        <h6><strong>Ciudad:</strong> <?php echo $item['Ciudad']?> </h6>
                        <h6><strong>Telefono:</strong> <?php echo $item['Telefono']?> </h6>
                        <h6><strong>Codigo postal:</strong> <?php echo $item['Codigo_Postal']?> </h6>
                        <h6><strong>Tipo:</strong> <?php echo $item['Tipo']?> </h6>
                        <h6 class="precioTexto"><strong>Precio:</strong> <?php echo $item['Precio']?> </h6>
                      </div>
                    </div>
                    <?php

                    if(in_array($item['Id'],array_column($guardados,'Id'))){
                      ?>
                      <button class="btn green" style="color: white;"><strong>Guardado</strong></button>
                      <?php
                    }else{
                      ?>
                      <form action="CRUD.php" method="post">
                        <input type="hidden" name="action" value="create">
                        <input type="hidden" name="id" value="<?php echo $item['Id']?>">
                        <input type="hidden" name="direccion" value="<?php echo $item['Direccion']?>">
                        <input type="hidden" name="ciudad" value="<?php echo $item['Ciudad']?>">
                        <input type="hidden" name="telefono" value="<?php echo $item['Telefono']?>">
                        <input type="hidden" name="codigoPostal" value="<?php echo $item['Codigo_Postal']?>">
                        <input type="hidden" name="tipo" value="<?php echo $item['Tipo']?>">
                        <input type="hidden" name="precio" value="<?php echo $item['Precio']?>">
  
                        <div class="botonField">
                          <input type="submit" class="btn white" value="Guardar" id="submitButton">
                        </div>
                      </form>
                      <?php
                    }
                    ?>
                    <div class="divider"></div>
                  <?php
                }
              ?>
            </div>
          <?php
        }
        
        ?>
      </div>
      
      <div id="tabs-2" >
        <div class="colContenido" id="divResultadosBusqueda">
          <div class="tituloContenido card" style="justify-content: center;">
            <h5>Bienes guardados:</h5>
            <div class="divider"></div>
            <?php 
            foreach($guardados as $itemGuardado){
              ?>
                    <div class="itemMostrado">
                      <img src="img/home.jpg" alt="Home">
                      <div class="card-stacked">
                        <h6><strong>Dirección:</strong> <?php echo $itemGuardado['Direccion']?> </h6>
                        <h6><strong>Ciudad:</strong> <?php echo $itemGuardado['Ciudad']?> </h6>
                        <h6><strong>Telefono:</strong> <?php echo $itemGuardado['Telefono']?> </h6>
                        <h6><strong>Codigo postal:</strong> <?php echo $itemGuardado['Codigo_Postal']?> </h6>
                        <h6><strong>Tipo:</strong> <?php echo $itemGuardado['Tipo']?> </h6>
                        <h6 class="precioTexto"><strong>Precio:</strong> <?php echo $itemGuardado['Precio']?> </h6>
                      </div>
                    </div>
                    <form action="CRUD.php" method="post">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?php echo $itemGuardado['Id']?>">
  
                        <div class="botonField">
                          <input type="submit" style="color: white" class="btn red" value="Eliminar" id="submitButton">
                        </div>
                      </form>
                    <div class="divider"></div>
              <?php
            }

            ?>
          </div>
        </div>
      </div>
    </div>


    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    
    <script type="text/javascript" src="js/ion.rangeSlider.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
    <script type="text/javascript" src="js/buscador.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">
      $( document ).ready(function() {
          $( "#tabs" ).tabs();
      });
    </script>
  </body>
  </html>
