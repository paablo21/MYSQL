
<?php
require_once "./Conexion.php";
require_once "./Response.php";

header("Content-Type: application/json");

$conexion = new Conexion();
$pdo = $conexion->getPDO();

$id = $_GET['id'] ?? "";

if ($id === "") {
    Response::error("El ID no es válido");
}

$query = $pdo->prepare("SELECT * FROM alumno WHERE id = :id");
$query->bindParam(":id", $id);
$query->execute();

$alumno = $query->fetch(PDO::FETCH_ASSOC);

if (!$alumno) {
    Response::error($id . " no encontrado");
}

$name = $_POST['name'] ?? "";
$apellidos = $_POST['apellidos'] ?? "";
$mail = $_POST['mail'] ?? "";
$password = $_POST['password'] ?? "";
$phone = $_POST['phone'] ?? "";
$sex = $_POST['sex'] ?? "";
$fecha_nacimiento = $_POST['fecha_nacimiento'] ?? "";

$name = $name !== "" ? $name : $alumno['nombre'];
$apellidos = $apellidos !== "" ? $apellidos : $alumno['apellidos'];
$mail = $mail !== "" ? $mail : $alumno['email'];
$password = $password !== ""? $password : $alumno['password'];
$phone = $phone !== "" ? $phone : $alumno['telefono'];
$sex = $sex !== "" ? $sex : $alumno['sexo'];
$fecha_nacimiento = $fecha_nacimiento !== "" ? $fecha_nacimiento : $alumno['fecha_nacimiento'];

$query = $pdo->prepare("UPDATE alumno SET nombre = :name, apellidos = :apellidos, email = :mail, password = :password, telefono = :phone, sexo = :sex, fecha_nacimiento = :fecha_nacimiento WHERE id = :id");

$query->bindParam(":name", $name);
$query->bindParam(":apellidos", $apellidos);
$query->bindParam(":mail", $mail);
$query->bindParam(":password", $password);
$query->bindParam(":phone", $phone);
$query->bindParam(":sex", $sex);
$query->bindParam(":fecha_nacimiento", $fecha_nacimiento);
$query->bindParam(":id", $id);

$query->execute();

$query = $pdo->prepare("SELECT * FROM alumno WHERE id = :id");
$query->bindParam(":id", $id);
$query->execute();

$alumno = $query->fetch(PDO::FETCH_ASSOC);

Response::success($alumno, "El usuario ha sido modificado");
