<?php
include "conexion.php";

// Parámetros de paginación
$registros_por_pagina = 5;
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$inicio = ($pagina > 1) ? ($pagina * $registros_por_pagina - $registros_por_pagina) : 0;

// Total de registros de clientes
$total_resultado = $conn->query("SELECT COUNT(*) as total FROM clientes");
$total_filas = $total_resultado->fetch_assoc()['total'];
$total_paginas = ceil($total_filas / $registros_por_pagina);
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
      $result = $conn->query("SELECT * FROM clientes LIMIT $inicio, $registros_por_pagina");
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

  <!-- Paginación -->
  <nav>
    <ul class="pagination">
      <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
        <li class="page-item <?= $i == $pagina ? 'active' : '' ?>">
          <a class="page-link" href="?pagina=<?= $i ?>"><?= $i ?></a>
        </li>
      <?php endfor; ?>
    </ul>
  </nav>

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
