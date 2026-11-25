<?php

class Conexion extends PDO {

    protected $pdo;

    function __construct() {
        $this->pdo = new PDO("mysql:host=localhost;dbname=colegio;port=3306;charset=utf8;", "root", "root");
    }

    public function getPDO() {
        return $this->pdo;
    }

}