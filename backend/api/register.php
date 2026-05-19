<?php

header("Content-Type: application/json");

include "../config/db.php";

$data = json_decode(file_get_contents("php://input"), true);

$name = $data['name'];
$email = $data['email'];
$password = $data['password'];
$role = $data['role'];
$umkmName = $data['umkmName'];
$umkmSector = $data['umkmSector'];

$sqlUmkm = "INSERT INTO umkm (nama_umkm, sektor)
VALUES ('$umkmName', '$umkmSector')";

if ($conn->query($sqlUmkm) === TRUE) {

    $umkm_id = $conn->insert_id;

    $sqlUser = "INSERT INTO users (name, email, password, role, umkm_id)
    VALUES ('$name', '$email', '$password', '$role', '$umkm_id')";

    if ($conn->query($sqlUser) === TRUE) {

        echo json_encode([
            "success" => true,
            "message" => "Register berhasil"
        ]);

    } else {

        echo json_encode([
            "success" => false,
            "message" => "Gagal simpan user"
        ]);
    }

} else {

    echo json_encode([
        "success" => false,
        "message" => "Gagal simpan UMKM"
    ]);
}

$conn->close();

?>