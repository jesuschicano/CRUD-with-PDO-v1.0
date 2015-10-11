<?php
class Database{
   //Atributos staticos
   private static $dbName = 'concesionario';
   private static $dbHost = 'localhost';
   private static $dbUser = 'root';
   private static $dbPass = 'root';
   // Atributo contador para comprobar que solo se hace una conexion por aplicación
   private static $cont  = null;

   // Nos aseguramos con el construct de que no se van a instanciar objetos de esta clase
   public function __construct() {
     die('La inicialización de esta clase no está permitida');
   }

   /**
   * Función pública para la conexión a la BD
   */
   public static function conectar(){
      // Una conexión para toda la aplicación
      if (self::$cont == null){
         try{
            self::$cont = new PDO("mysql:host=".self::$dbHost.";dbname=".self::$dbName.";charset=utf8", self::$dbUser, self::$dbPass);
            self::$cont->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            return self::$cont;
         }catch(PDOException $e){
            die($e->getMessage());
         }
      }
   }

   /**
   * Función pública para la desconexión a la BD
   */
   public static function desconectar(){
      self::$cont = null;
   }

   /**
   * Función pública para la inserción de coches a la BD
   */
   public static function insertaCoche($marca, $modelo, $color){
      /* Los marcadores conocidos es la forma más recomendable en el uso PDO
      * ya que a la hora usar bindParam y bindValue se puede especificar
      * el tipo de dato y la longitud máxima
      */

      try {
         // Los 'marcadores conocidos' se pueden insertar en forma de array asociativo
         $datos = array( 'marca' => $marca, 'modelo' => $modelo, 'color' => $color );

         /* Para ganar una capa más de seguridad siempre es recomendable
         * el uso de la función prepare() para inyectar las consultas SQL
         */
         $q = self::$cont->prepare("INSERT INTO coches (marca, modelo, color) VALUES (:marca, :modelo, :color)");
         // Fijarse que se pasa el array de datos en execute().
         $q->execute($datos);

         if($q->rowCount()>0){
            echo "<script>alert('Coche insertado correctamente');</script>";
         }
      } catch (PDOException $e) {
         echo "Error: ". $e->getMessage();
      }
   }

   public static function buscaCochePorId($id){
      // Preparamos marcadores
      $datos = array('id' => $id);

      // Queremos todos los datos del coche que corresponda con el ID facilitado
      $q = self::$cont->prepare("SELECT * FROM coches WHERE id = :id");
      $q->execute($datos);

      // Obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement
      // El parámetro fetch_style(en este caso FETCH_ASSOC) determina cómo PDO devuelve la fila.
      $coche = $q->fetch(PDO::FETCH_ASSOC);
      // Lo devuelve como un array asociativo

      return $coche;
   }

   /**
   * Función pública para la modificacion de coches en la BD
   */
   public static function modificaCoche($id,$marca,$modelo,$color){
      try {
         //array de 'marcadores conocidos'
         $datos = array('id' => $id,'marca' => $marca,'modelo' => $modelo,'color' => $color);

         //usamos prepare() para mayor seguiridad
         $q = self::$cont->prepare("UPDATE coches SET marca=:marca, modelo=:modelo, color=:color WHERE id=:id");
         //ejecutamos pasándole el array con los datos
         $q->execute($datos);

         //verificamos con mensaje
         if($q->rowCount()>0){
            echo "<script>alert('Coche modificado correctamente');window.location.href='leer.php';</script>";
         }
      } catch (PDOException $e) {
         echo "Error: ". $e->getMessage();
      }
   }

   /**
   * Función pública para la eliminación de un registro
   */
   public static function borrarCoche($id){
      try {
         $data = array('id' => $id);

         $q = self::$cont->prepare("DELETE FROM coches WHERE id=:id");
         $q->execute($data);

         if($q->rowCount()>0){
            echo "<script>alert('Coche eliminado correctamente');window.location.href='leer.php';</script>";
         }
      } catch (PDOException $e) {
         echo "Error: ". $e->getMessage();
      }
   }

}// end class
?>
