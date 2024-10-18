<?php

$hostname = 'localhost';
$username = 'root';
$password = '';

// Membuat koneksi ke MySQL
$db = new mysqli($hostname, $username, $password);

// Cek koneksi
if ($db->connect_error) {
    die("Gagal konek: " . $db->connect_error);
}

// Membuat database 'booking_db'
$sql_buat_db = "CREATE DATABASE booking_db";
$eksekusi_buat_db = $db->query($sql_buat_db);

if ($eksekusi_buat_db) {
    echo 'Database booking_db berhasil dibuat' . '<br>';
} else {
    echo "Gagal membuat database: " . $db->error . '<br>';
}

// Masuk ke database 'booking_db'
$sql_masuk_db = "USE booking_db";
$eksekusi_masuk_db = $db->query($sql_masuk_db);

if ($eksekusi_masuk_db) {
    echo 'Sudah masuk ke database booking_db' . '<br>';
} else {
    echo "Gagal masuk database: " . $db->error . '<br>';
}

// Membuat tabel bookings untuk menyimpan data booking lapangan
$sql_buat_tabel_bookings = "CREATE TABLE bookings (
    booking_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    court_number INT(2) NOT NULL,
    booking_date DATE NOT NULL,
    booking_time TIME NOT NULL
)";
$eksekusi_buat_tabel_bookings = $db->query($sql_buat_tabel_bookings);

if ($eksekusi_buat_tabel_bookings) {
    echo 'Tabel bookings berhasil dibuat' . '<br>';
} else {
    echo "Gagal membuat tabel bookings: " . $db->error . '<br>';
}

// Membuat tabel users untuk menyimpan data pengguna (opsional)
$sql_buat_tabel_users = "CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
)";
$eksekusi_buat_tabel_users = $db->query($sql_buat_tabel_users);

if ($eksekusi_buat_tabel_users) {
    echo 'Tabel users berhasil dibuat' . '<br>';
} else {
    echo "Gagal membuat tabel users: " . $db->error . '<br>';
}

// Menutup koneksi
$db->close();

?>
