<?php
include "conexion.php";
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM pedidos WHERE id=$id");
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Pedido</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h1>Editar Pedido</h1>
  <form method="post" enctype="multipart/form-data">
    <input class="form-control mb-2" type="text" name="producto" value="<?= $row['producto'] ?>" required>
    <textarea class="form-control mb-2" name="descripcion" required><?= $row['descripcion'] ?></textarea>
    <input class="form-control mb-2" type="file" name="imagen">
    <button class="btn btn-success" type="submit" name="actualizar">Actualizar</button>
  </form>
  <a href="index.php" class="btn btn-secondary mt-2">Volver</a>
  <?php
  if (isset($_POST['actualizar'])) {
    $producto = $_POST['producto'];
    $descripcion = $_POST['descripcion'];
    $imagen = $row['imagen'];
    if (!empty($_FILES['imagen']['name'])) {
      $imagen = $_FILES['imagen']['name'];
      move_uploaded_file($_FILES['imagen']['tmp_name'], "uploads/" . $imagen);
    }
    if ($conn->query("UPDATE pedidos SET producto='$producto', descripcion='$descripcion', imagen='$imagen' WHERE id=$id")) {
      header("Location: index.php?msg=Pedido actualizado correctamente");
      exit();
    } else {
      echo '<div class="alert alert-danger mt-3">Error al actualizar pedido: ' . $conn->error . '</div>';
    }
  }
  ?>
</div>
</body>
</html>
