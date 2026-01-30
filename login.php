<?php
header("Content-Type: application/json");
include "database.php";

$data = json_decode(file_get_contents("php://input"), true);
$email = trim($data['email'] ?? '');
$password = trim($data['password'] ?? '');

$stmt = $conn->prepare("SELECT * FROM pelanggan WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
  if (password_verify($password, $row['password'])) {
    echo json_encode(["status" => "success", "message" => "Login berhasil!"]);
  } else {
    echo json_encode(["status" => "error", "message" => "Password salah!"]);
  }
} else {
  echo json_encode(["status" => "error", "message" => "Email tidak ditemukan!"]);
}
?>
