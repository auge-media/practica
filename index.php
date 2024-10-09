<!DOCTYPE html>
<html>
  <head>
    <title>Example PHP page</title>
  </head>
  <body>
    <?php
      // Parámetros de conexión a la base de datos
      $servername = "mysql-practicas.alwaysdata.net";  // Dirección del servidor (generalmente "localhost" en un servidor local)
      $username = "practicas";   // Usuario de la base de datos
      $password = "coco12y7"; // Contraseña de la base de datos
      $dbname = "practicas_pruebas"; // Nombre de la base de datos

      // Crear conexión
      $conn = mysqli_connect($servername, $username, $password, $dbname);

      // Verificar la conexión
      if (!$conn) {
        die("Conexión fallida: " . mysqli_connect_error());
      }
      echo '<h1>Conexión exitosa a la base de datos</h1>';

      // Cerrar conexión
      mysqli_close($conn);

      // Información PHP
      echo '<p>This page uses PHP version ' . phpversion() . '.</p>';
    ?>
  </body>
</html>
