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
      <title>Modificar</title>
   </head>
   <body>

      <form class="container" method="POST">
         <?php
         // Para cargar el formulario tenemos que haber leído la ID enviada desde el botón de modificar
         if( isset($_GET['id']) ){
            $link = Database::conectar();
            // guardamos en $link el coche que ha encontrado al método buscaCochePorId()
            $link = Database::buscaCochePorId($id);

            // Rellenamos el formulario con los datos recogidos del coche en $link
            echo '<div class="form-group">'.
               '<label>Marca</label>'.
               '<input type="text" class="form-control" name="marca" value="'.$link['marca'].'">'.
            '</div>';
            echo '<div class="form-group">'.
               '<label>Modelo</label>'.
               '<input type="text" class="form-control" name="modelo" value="'.$link['modelo'].'">'.
            '</div>';
            echo '<div class="form-group">'.
               '<label>Modelo</label>'.
               '<input type="text" class="form-control" name="color" value="'.$link['color'].'">'.
            '</div>';
            echo '<div class="form-group">'.
               '<input type="submit" class="btn btn-warning" name="mod" value="Modificar">'.
            '</div>';

            $link = Database::desconectar();
         }else{
            echo "Debe seleccionar un coche para modificarlo";
         }
         ?>
      </form>
      <ol class="breadcrumb">
        <li><a href="insertar.php">Insertar</a></li>
        <li><a href="leer.php">Leer</a></li>
        <li class="active">Modificar</li>
      </ol>

      <script src="node_modules/jquery/dist/jquery.min.js"></script>
      <script src="node_mosules/bootstrap/dist/js/bootstrap.min.js"></script>
   </body>
</html>
<?php
// Al pulsar el botón modificar
if( isset($_POST['mod']) ){
   // Recogemos los valores del formulario para pasarlos a la función
   $ma = $_POST['marca'];
   $mo = $_POST['modelo'];
   $co = $_POST['color'];

   $link = Database::conectar();
   $link = Database::modificaCoche($id,$ma,$mo,$co);
   $link = Database::desconectar();
}
?>
