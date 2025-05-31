<?php
include "conexion.php";
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM clientes WHERE id=$id");
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Cliente</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h1>Editar Cliente</h1>
  <form method="post">
    <input class="form-control mb-2" type="text" name="cedula" value="<?= $row['cedula'] ?>" required>
    <input class="form-control mb-2" type="text" name="nombre" value="<?= $row['nombre'] ?>" required>
    <input class="form-control mb-2" type="text" name="apellido" value="<?= $row['apellido'] ?>" required>
    <input class="form-control mb-2" type="text" name="direccion" value="<?= $row['direccion'] ?>" required>
    <button class="btn btn-primary" type="submit" name="actualizar">Actualizar</button>
  </form>
  <a href="index.php" class="btn btn-secondary mt-2">Volver</a>
  <?php
  if (isset($_POST['actualizar'])) {
    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $direccion = $_POST['direccion'];
    if ($conn->query("UPDATE clientes SET cedula='$cedula', nombre='$nombre', apellido='$apellido', direccion='$direccion' WHERE id=$id")) {
      header("Location: index.php?msg=Cliente actualizado correctamente");
      exit();
    } else {
      echo '<div class="alert alert-danger mt-3">Error al actualizar cliente: ' . $conn->error . '</div>';
    }
  }
  ?>
</div>
</body>
</html>