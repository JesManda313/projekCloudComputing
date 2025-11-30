<?php
session_start();
require_once "../db.php";
require_once "../akses_admin.php";

$id = $_POST["id_flight"] ?? 0;

if (!$id) {
    $_SESSION['error'] = "ID flight tidak valid.";
    header("Location: ../../admin/penerbangan.php");
    exit;
}

// Ambil flight_code dulu
$q = $conn->prepare("SELECT flight_code FROM flights WHERE id_flight = ?");
$q->bind_param("i", $id);
$q->execute();
$res = $q->get_result()->fetch_assoc();

if (!$res) {
    $_SESSION['error'] = "Penerbangan tidak ditemukan.";
    header("Location: ../../admin/penerbangan.php");
    exit;
}

$flight_code = $res['flight_code'];


// Lakukan delete
$del = $conn->prepare("DELETE FROM flights WHERE id_flight = ?");
$del->bind_param("i", $id);

if ($del->execute()) {
    $_SESSION['success'] = "Penerbangan $flight_code berhasil dihapus.";
} else {
    $_SESSION['error'] = "Gagal menghapus penerbangan $flight_code.";
}

header("Location: ../../admin/penerbangan.php");
exit;
