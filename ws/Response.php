<?php

class Response {

    public static function success($data, string $message) {
        echo json_encode([
            "success" => true,
            "message" =>  $message,
            "data" => $data
        ]);
        die;
    }

    public static function error(string $message) {
        echo json_encode([
            "success" => false,
            "message" => $message
        ]);
        die;
    }
}