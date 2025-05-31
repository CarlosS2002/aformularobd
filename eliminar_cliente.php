<?php
include "conexion.php";
$id = $_GET['id'];
if ($conn->query("DELETE FROM clientes WHERE id=$id")) {
  header("Location: index.php?msg=Cliente eliminado correctamente");
} else {
  header("Location: index.php?msg=Error al eliminar cliente");
}
?>