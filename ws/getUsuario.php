
<?php
require_once "./Conexion.php";
require_once "./Response.php";

header("Content-Type: application/json");

$conexion = new Conexion();
$pdo = $conexion->getPDO();

$id = $_GET['id'] ?? null;

if ($id !== null) {

    $query = $pdo->prepare("SELECT * FROM alumno WHERE id = :id");
    $query->bindParam(":id", $id);
    $query->execute();
    $alumno = $query->fetch(PDO::FETCH_ASSOC);

    if (!$alumno) {
        Response::error("Usuario no encontrado");
    }

    Response::success($alumno, "Usuario obtenido correctamente");

} else {

    $query = $pdo->prepare("SELECT * FROM alumno");
    $query->execute();
    $alumnos = $query->fetchAll(PDO::FETCH_ASSOC);

    Response::success($alumnos, "Usuarios obtenidos correctamente");
}
