<?php
include "conexion.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Agregar Cliente</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h1>Agregar Cliente</h1>
  <form method="post">
    <input class="form-control mb-2" type="text" name="cedula" placeholder="Cédula" pattern="\\d+" title="Solo se permiten números" required>
    <input class="form-control mb-2" type="text" name="nombre" placeholder="Nombre" required>
    <input class="form-control mb-2" type="text" name="apellido" placeholder="Apellido" required>
    <input class="form-control mb-2" type="text" name="direccion" placeholder="Dirección" required>
    <button class="btn btn-primary" type="submit" name="guardar">Guardar</button>
  </form>
  <a href="index.php" class="btn btn-secondary mt-2">Volver</a>

  <?php
  if (isset($_POST['guardar'])) {
    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $direccion = $_POST['direccion'];

    if (!is_numeric($cedula)) {
      echo '<div class="alert alert-danger mt-3">La cédula debe contener solo números.</div>';
    } else {
      if ($conn->query("INSERT INTO clientes (cedula, nombre, apellido, direccion) VALUES ('$cedula','$nombre','$apellido','$direccion')")) {
        header("Location: index.php?msg=Cliente agregado exitosamente");
        exit();
      } else {
        echo '<div class="alert alert-danger mt-3">Error al agregar cliente: ' . $conn->error . '</div>';
      }
    }
  }
  ?>
</div>
</body>
</html>
