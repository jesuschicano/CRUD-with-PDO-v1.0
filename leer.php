<?php require_once("database.php"); ?>
<!DOCTYPE html>
<html lang="es">
   <head>
      <meta charset="utf-8">
      <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
      <title>LISTAR COCHES</title>
   </head>
   <body>
      <table class="table table-condensed">
         <th>Id</th><th>Marca</th><th>Modelo</th><th>Color</th><th>Modificar</th><th>Borrar</th>
         <?php
         $link = Database::conectar();
         $consulta = "SELECT * FROM coches ORDER BY id ASC";
         foreach ($link->query($consulta) as $row) {
            echo "<tr>".
            "<td>".$row['id']."</td>".
            "<td>".$row['marca']."</td>".
            "<td>".$row['modelo']."</td>".
            "<td>".$row['color']."</td>".
            '<td><a class="btn btn-warning" href="modificar.php?id='.$row['id'].'">Modificar</a></td>'.
            '<td><a class="btn btn-danger" href="borrar.php?id='.$row['id'].'">Borrar</a></td>'.
            "</tr>";
         }
         $link = Database::desconectar();
         ?>
      </table>

      <ol class="breadcrumb">
         <li><a href="insertar.php">Insertar</a></li>
         <li class="active">Leer</li>
      </ol>

      <script src="node_modules/jquery/dist/jquery.min.js"></script>
      <script src="node_mosules/bootstrap/dist/js/bootstrap.min.js"></script>
   </body>
</html>
