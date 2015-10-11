<?php require_once("database.php"); ?>
<!DOCTYPE html>
<html lang="es">
   <head>
      <meta charset="utf-8">
      <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
      <title>INSERTAR COCHE</title>
   </head>
   <body>

      <form method="post" class="container">
         <div class="form-group">
            <label for="marca">Marca</label>
            <input type="text" class="form-control" name="marca">
         </div>
         <div class="form-group">
            <label for="modelo">Modelo</label>
            <input type="text" class="form-control" name="modelo">
         </div>
         <div class="form-group">
            <label for="color">Color</label>
            <input type="text" class="form-control" name="color">
         </div>
         <div class="form-group">
            <input type="submit" class="btn btn-default" value="Introducir" name="in">
         </div>
      </form>

      <ol class="breadcrumb">
        <li class="active">Insertar</li>
        <li><a href="leer.php">Leer</a></li>
      </ol>

      <script src="node_modules/jquery/dist/jquery.min.js"></script>
      <script src="node_mosules/bootstrap/dist/js/bootstrap.min.js"></script>
   </body>
</html>
<?php
if(isset($_POST['in'])){
   // Al pulsar en el botón de introducir
   // almacenamos los distintos elementos recogidos
   $marca = $_POST['marca'];
   $modelo = $_POST['modelo'];
   $color = $_POST['color'];

   $link = Database::conectar();
   $link = Database::insertaCoche($marca,$modelo,$color);
   $link = Database::desconectar();
}
?>
