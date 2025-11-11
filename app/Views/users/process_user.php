<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "capaian_kinerja";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Koneksi database gagal"]);
    exit;
}

$action = $_POST['action'] ?? '';

if ($action === 'add') {
    $nama = $_POST['nama'] ?? '';
    $email = $_POST['email'] ?? '';
    $pass = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? 'mahasiswa';

    if (empty($nama) || empty($email) || empty($pass)) {
        echo json_encode(["success" => false, "message" => "Data tidak lengkap"]);
        exit;
    }

    $hashed = password_hash($pass, PASSWORD_BCRYPT);
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nama, $email, $hashed, $role);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "User berhasil ditambahkan"]);
    } else {
        echo json_encode(["success" => false, "message" => "Gagal menambah user (email mungkin sudah ada)"]);
    }
    $stmt->close();

} elseif ($action === 'update') {
    $id = $_POST['id'] ?? '';
    $nama = $_POST['nama'] ?? '';
    $email = $_POST['email'] ?? '';
    $pass = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? '';

    if (empty($id) || empty($nama) || empty($email)) {
        echo json_encode(["success" => false, "message" => "Data tidak lengkap"]);
        exit;
    }

    if (!empty($pass)) {
        $hashed = password_hash($pass, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("UPDATE users SET name=?, email=?, password=?, role=? WHERE id=?");
        $stmt->bind_param("ssssi", $nama, $email, $hashed, $role, $id);
    } else {
        $stmt = $conn->prepare("UPDATE users SET name=?, email=?, role=? WHERE id=?");
        $stmt->bind_param("sssi", $nama, $email, $role, $id);
    }

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "User berhasil diperbarui"]);
    } else {
        echo json_encode(["success" => false, "message" => "Gagal memperbarui user"]);
    }
    $stmt->close();

} elseif ($action === 'delete') {
    $id = $_POST['id'] ?? '';
    if (empty($id)) {
        echo json_encode(["success" => false, "message" => "ID user tidak ditemukan"]);
        exit;
    }

    $stmt = $conn->prepare("DELETE FROM users WHERE id=?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "User berhasil dihapus"]);
    } else {
        echo json_encode(["success" => false, "message" => "Gagal menghapus user"]);
    }
    $stmt->close();

} else {
    echo json_encode(["success" => false, "message" => "Aksi tidak valid"]);
}

$conn->close();
