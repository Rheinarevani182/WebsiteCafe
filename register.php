<?php
header("Content-Type: application/json");
include "database.php";

$data = json_decode(file_get_contents("php://input"), true);
$email = trim($data['email'] ?? '');
$password = trim($data['password'] ?? '');

if (!$email || !$password) {
  echo json_encode(["status" => "error", "message" => "Semua field wajib diisi."]);
  exit;
}

// cek apakah email sudah terdaftar
$check = $conn->prepare("SELECT id FROM pelanggan WHERE email = ?");
$check->bind_param("s", $email);
$check->execute();
$result = $check->get_result();

if ($result->num_rows > 0) {
  echo json_encode(["status" => "error", "message" => "Email sudah terdaftar!"]);
  exit;
}

// hash password
$hashed = password_hash($password, PASSWORD_DEFAULT);

// simpan data
$stmt = $conn->prepare("INSERT INTO pelanggan (email, password) VALUES (?, ?)");
$stmt->bind_param("ss", $email, $hashed);

if ($stmt->execute()) {
  echo json_encode(["status" => "success", "message" => "Pendaftaran berhasil!"]);
} else {
  echo json_encode(["status" => "error", "message" => "Gagal menyimpan data."]);
}
?>
