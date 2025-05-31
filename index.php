<!-- index.php -->
<?php
include "conexion.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>CRUD Clientes y Pedidos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">

  <?php if (isset($_GET['msg'])): ?>
    <div class="alert alert-info text-center">
      <?= htmlspecialchars($_GET['msg']) ?>
    </div>
  <?php endif; ?>

  <h1 class="mb-4">Clientes</h1>
  <a href="agregar_cliente.php" class="btn btn-primary mb-3">Agregar Cliente</a>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Cédula</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Dirección</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $result = $conn->query("SELECT * FROM clientes");
      while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['cedula']}</td>
                <td>{$row['nombre']}</td>
                <td>{$row['apellido']}</td>
                <td>{$row['direccion']}</td>
                <td>
                  <a href='editar_cliente.php?id={$row['id']}' class='btn btn-sm btn-warning'>Editar</a>
                  <a href='eliminar_cliente.php?id={$row['id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"¿Eliminar cliente?\")'>Eliminar</a>
                </td>
              </tr>";
      }
      ?>
    </tbody>
  </table>

  <h2 class="mt-5 mb-4">Pedidos</h2>
  <a href="agregar_pedido.php" class="btn btn-success mb-3">Agregar Pedido</a>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Producto</th>
        <th>Descripción</th>
        <th>Imagen</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $result = $conn->query("SELECT * FROM pedidos");
      while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['producto']}</td>
                <td>{$row['descripcion']}</td>
                <td><img src='uploads/{$row['imagen']}' width='50'></td>
                <td>
                  <a href='editar_pedido.php?id={$row['id']}' class='btn btn-sm btn-warning'>Editar</a>
                  <a href='eliminar_pedido.php?id={$row['id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"¿Eliminar pedido?\")'>Eliminar</a>
                </td>
              </tr>";
      }
      ?>
    </tbody>
  </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
