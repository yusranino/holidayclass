<?php
// 1. Koneksi ke MySQL
$host = "localhost";
$user = "root";
$pass = "";
$db = "ternaman_inorobo";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

// 2. Ambil data dari form
$namaAnak = $_POST['namaAnak'];
$usia = $_POST['usia'];
$kelas = $_POST['kelas'];
$level = $_POST['level'];
$tanggal_range = $_POST['tanggal_range'];
$namaOrangTua = $_POST['namaOrangTua'];
$email = $_POST['email'];
$telepon = $_POST['telepon'];
$catatan = $_POST['catatan'];

// 3. Simpan ke database
$stmt = $conn->prepare("INSERT INTO reg_holiday 
(nama_anak, usia, kelas, level, tanggal_range, nama_orang_tua, email, telepon, catatan)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sisssssss", $namaAnak, $usia, $kelas, $level, $tanggal_range, $namaOrangTua, $email, $telepon, $catatan);
$stmt->execute();

// 4. Kirim ke Google Spreadsheet
$google_url = "https://script.google.com/macros/s/AKfycbx0HAjuFXK5BQjjL95KXk6VGQBoj3e6DRxhbfH7S8s9Tfqps6DEBpYvs08a_lT-c6Nn/exec"; // ganti dengan URL web app kamu
$data = array(
  "namaAnak" => $namaAnak,
  "usia" => $usia,
  "kelas" => $kelas,
  "level" => $level,
  "tanggal_range" => $tanggal_range,
  "namaOrangTua" => $namaOrangTua,
  "email" => $email,
  "telepon" => $telepon,
  "catatan" => $catatan
);
$options = array(
  'http' => array(
    'method'  => 'POST',
    'header'  => "Content-type: application/json\r\n",
    'content' => json_encode($data)
  )
);
$context  = stream_context_create($options);
$result = file_get_contents($google_url, false, $context);

// 5. Redirect atau beri respon
header("Location: thanks.html");
exit;
?>
