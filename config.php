<?php

// Konfigurasi Database
define('DB_HOST', 'localhost'); // Biasanya 'localhost' jika database di server yang sama
define('DB_PORT', '3307');     // Tambahkan definisi port MySQL Anda di sini
define('DB_USER', 'root');     // Ganti dengan username database Anda
define('DB_PASS', '');         // Ganti dengan password database Anda
define('DB_NAME', 'rental_mobil_db'); // Nama database yang telah kita buat

// Opsi PDO
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Mengaktifkan mode error untuk exceptions
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,     // Mengambil hasil sebagai array asosiatif
    PDO::ATTR_EMULATE_PREPARES   => false,                // Mematikan emulasi prepared statements untuk keamanan
];

// Inisialisasi variabel koneksi
$pdo = null;

try {
    // String koneksi DSN (Data Source Name)
    // PASTIKAN PORT 3307 DITAMBAHKAN DI SINI
    $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    
    // Membuat objek PDO
    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
    
    // echo "Koneksi database berhasil!"; // Anda bisa mengaktifkan ini untuk testing
    
} catch (PDOException $e) {
    // Tangani error koneksi
    die("Koneksi database gagal: " . $e->getMessage());
}

?>