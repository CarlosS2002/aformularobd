<?php include "conexion.php"; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Agregar Pedido</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h1>Agregar Pedido</h1>
  <form method="post" enctype="multipart/form-data">
    <input class="form-control mb-2" type="text" name="producto" placeholder="Nombre del producto" required>
    <textarea class="form-control mb-2" name="descripcion" placeholder="Descripción" required></textarea>
    <input class="form-control mb-2" type="file" name="imagen" required>
    <button class="btn btn-success" type="submit" name="guardar">Guardar</button>
  </form>
  <a href="index.php" class="btn btn-secondary mt-2">Volver</a>
  <?php
  if (isset($_POST['guardar'])) {
    $producto = $_POST['producto'];
    $descripcion = $_POST['descripcion'];
    $imagen = $_FILES['imagen']['name'];
    $ruta = "uploads/" . basename($imagen);

    // Crear la carpeta uploads si no existe
    if (!is_dir("uploads")) {
      mkdir("uploads", 0777, true);
    }

    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta)) {
      if ($conn->query("INSERT INTO pedidos (producto, descripcion, imagen) VALUES ('$producto','$descripcion','$imagen')")) {
        header("Location: index.php?msg=Pedido agregado exitosamente");
        exit();
      } else {
        echo '<div class="alert alert-danger mt-3">Error al guardar pedido: ' . $conn->error . '</div>';
      }
    } else {
      echo '<div class="alert alert-danger mt-3">Error al subir la imagen.</div>';
    }
  }
  ?>
</div>
</body>
</html>
