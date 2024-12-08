<?php 
    include "db.php";
    $nim = $_GET['nim'];
    $stmt = $conn->query("DELETE FROM data_user WHERE nim = '$nim'");
    if ($stmt) {
        echo "<script>alert('Akun berhasil dihapus'); window.location.href = 'tampilan.php';</script>";
    } else {
        echo "<script>alert('Akun gagal dihapus'); window.location.href = 'tampilan.php';</script>";
    }
    $conn->close();
?>