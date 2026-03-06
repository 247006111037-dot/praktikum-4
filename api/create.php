<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

include_once '../config/Database.php';
include_once '../models/Mahasiswa.php';
include_once '../includes/helpers.php';

$database = new Database();
$db = $database->getConnection();
$mahasiswa = new Mahasiswa($db);

$raw_data = json_decode(file_get_contents("php://input"), true);
$validation = validate_mahasiswa_input($raw_data);

if (empty($validation['errors'])) {
    $mahasiswa->npm = $validation['data']['npm'];
    $mahasiswa->nama = $validation['data']['nama'];
    $mahasiswa->jurusan = $validation['data']['jurusan'];

    if($mahasiswa->create()) {
        http_response_code(201);
        echo json_encode(array("message" => "Mahasiswa berhasil ditambahkan."));
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Gagal menambahkan mahasiswa."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("errors" => $validation['errors']));
}