<?php
require_once('database.php');
// Creamos una variable para almacenar el ID del coche durante todo el script
$id = null;
 if ( !empty($_GET['id'])) {
     $id = $_REQUEST['id'];
 }
?>
<!DOCTYPE html>
<html lang="es">
   <head>
      <meta charset="utf-8">
      <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
      <title>Borrar</title>
   </head>
   <body>

      <?php
      $link = Database::conectar();
      $link = Database::buscaCochePorId($id);

      echo '<div class="panel panel-danger">'.
         '<div class="panel-heading">Está a punto de eliminar el registro</div>'.
         "<div class='panel-body'>". $link['id']." - ".$link['marca']." - ".$link['modelo']." - ".$link['color']."</div>".
      '</div>';

      echo '<form method="POST"><div class="container">'.
         '<input type="submit" class="btn btn-danger" value="Borrar" name="btn-borra">'.
         '<a href="leer.php" class="btn btn-default">Cancelar</a>'.
      '</form></div>';

      if( isset($_POST['btn-borra']) ){
         $link = Database::borrarCoche($id);
         $link = Database::desconectar();
      }
      ?>

      </body>
      <ol class="breadcrumb">
        <li><a href="insertar.php">Insertar</a></li>
        <li><a href="leer.php">Leer</a></li>
        <li class="active">Borrar</li>
      </ol>

      <script src="node_modules/jquery/dist/jquery.min.js"></script>
      <script src="node_mosules/bootstrap/dist/js/bootstrap.min.js"></script>
   </body>
</html>
