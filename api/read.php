<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/Database.php';
include_once '../models/Mahasiswa.php';

$database = new Database();
$db = $database->getConnection();
$mahasiswa = new Mahasiswa($db);

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->id)) {
    $query = "SELECT * FROM mahasiswa WHERE id = ? LIMIT 0,1";
    $stmt = $db->prepare($query);
    $stmt->execute([$data->id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        http_response_code(200);
        echo json_encode(["success" => true, "data" => $row]);
    } else {
        http_response_code(404);
        echo json_encode(["success" => false, "message" => "Data tidak ditemukan."]);
    }
    return;
}

$stmt = $mahasiswa->read();
$num = $stmt->rowCount();

if($num > 0) {
    $mahasiswa_arr = array();
    $mahasiswa_arr["records"] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        array_push($mahasiswa_arr["records"], ["id" => $id, "npm" => $npm, "nama" => $nama, "jurusan" => $jurusan]);
    }
    http_response_code(200);
    echo json_encode($mahasiswa_arr);
} else {
    http_response_code(404);
    echo json_encode(["message" => "Data tidak ditemukan."]);
}
?>