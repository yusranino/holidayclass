<?php

$host = 'localhost'; // Ubah sesuai dengan konfigurasi server Anda

$user = 'root';      // Ubah sesuai dengan user database Anda

$pass = '';          // Ubah sesuai dengan password database Anda

$dbName = 'ternaman_inorobo'; // Nama database

$tableName = 'reg_holiday';          // Nama tabel



// Buat koneksi ke MySQL

$conn = new mysqli($host, $user, $pass);



if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);

}



// Periksa apakah database sudah ada

$dbCheckQuery = "SHOW DATABASES LIKE '$dbName'";

$dbExists = $conn->query($dbCheckQuery);



if ($dbExists->num_rows == 0) {

    // Jika database belum ada, buat database

    $createDbQuery = "CREATE DATABASE $dbName";

    if ($conn->query($createDbQuery) === TRUE) {

        echo "Database '$dbName' created successfully.<br>";

    } else {

        die("Error creating database: " . $conn->error);

    }

} else {

    echo "Database '$dbName' already exists.<br>";

}



// Gunakan database

$conn->select_db($dbName);



// Periksa apakah tabel sudah ada

$tableCheckQuery = "SHOW TABLES LIKE '$tableName'";

$tableExists = $conn->query($tableCheckQuery);



if ($tableExists->num_rows == 0) {

    // Jika tabel belum ada, buat tabel

    $createTableQuery = "

        CREATE TABLE $tableName (

            id INT AUTO_INCREMENT PRIMARY KEY,
            nama_anak VARCHAR(100),
            usia INT,
            kelas VARCHAR(10),
            level VARCHAR(50),
            tanggal_range VARCHAR(50),
            nama_orang_tua VARCHAR(100),
            email VARCHAR(100),
            telepon VARCHAR(20),
            catatan TEXT,
            waktu_daftar TIMESTAMP DEFAULT CURRENT_TIMESTAMP

        )

    ";

    if ($conn->query($createTableQuery) === TRUE) {

        echo "Table '$tableName' created successfully.<br>";

    } else {

        die("Error creating table: " . $conn->error);

    }

} else {

    echo "Table '$tableName' already exists.<br>";

}



$conn->close();

?>

