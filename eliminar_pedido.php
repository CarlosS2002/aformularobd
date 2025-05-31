<?php
include "conexion.php";
$id = $_GET['id'];
if ($conn->query("DELETE FROM pedidos WHERE id=$id")) {
  header("Location: index.php?msg=Pedido eliminado correctamente");
} else {
  header("Location: index.php?msg=Error al eliminar pedido");
}
?>