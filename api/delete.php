<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");

include_once '../config/Database.php';
include_once '../models/Mahasiswa.php';

$database = new Database();
$db = $database->getConnection();
$mahasiswa = new Mahasiswa($db);

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->id)) {
    $mahasiswa->id = $data->id;
    if($mahasiswa->delete()) {
        echo json_encode(array("message" => "Data berhasil dihapus."));
    } else {
        echo json_encode(array("message" => "Gagal menghapus data."));
    }
}
?>