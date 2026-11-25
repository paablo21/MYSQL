<?php
require_once "./Conexion.php";
require_once "./Response.php";

header("Content-Type: application/json");

$conexion = new Conexion();
$pdo = $conexion->getPDO();

$name = $_POST['name'] ?? "";
$apellidos = $_POST['apellidos'] ?? "";
$mail = $_POST['mail'] ?? "";
$password = $_POST['password'] ?? "";
$phone = $_POST['phone'] ?? "";
$sex = $_POST['sex'] ?? "";
$fecha_nacimiento = $_POST['fecha_nacimiento'] ?? "";

if ($name === "" || $apellidos === "" || $mail === "" || $password === "" || $phone === "" || $sex === "" || $fecha_nacimiento === "") {
    Response::error("Todos los campos son obligatorios");
}

if ($sex !== "m" && $sex !== "f") {
    Response::error("El sexo no es válido");
}

$query = $pdo->prepare("INSERT INTO alumno(nombre, apellidos, email, password, telefono, sexo, fecha_nacimiento) VALUES (:name, :apellidos, :mail, :password, :phone, :sex, :fecha_nacimiento)");

$query->bindParam(":name", $name);
$query->bindParam(":apellidos", $apellidos);
$query->bindParam(":mail", $mail);
$query->bindParam(":password", $password);
$query->bindParam(":phone", $phone);
$query->bindParam(":sex", $sex);
$query->bindParam(":fecha_nacimiento", $fecha_nacimiento);

$query->execute();

$id = $pdo->lastInsertId();

$query = $pdo->prepare("SELECT * FROM alumno WHERE id = :id");
$query->bindParam(":id", $id);
$query->execute();

$alumno = $query->fetch(PDO::FETCH_ASSOC);

Response::success($alumno, "Usuario creado");
