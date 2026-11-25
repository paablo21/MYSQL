<?php
require_once "./Conexion.php";
require_once "./Response.php";

header("Content-Type: application/json");

$conexion = new Conexion();
$pdo = $conexion->getPDO();

$id = $_GET['id'] ?? null;

$query = $pdo->prepare("SELECT * FROM alumno WHERE id = :id");
$query->bindParam(":id", $id);
$query->execute();

$alumno = $query->fetch(PDO::FETCH_ASSOC);

if (!$alumno) {
    Response::error("Usuario con id ". $id . " no encontrado");
}

$query = $pdo->prepare("DELETE FROM alumno WHERE id = :id");
$query->bindParam(":id", $id);
$query->execute();

Response::success($alumno, "Usuario eliminado");