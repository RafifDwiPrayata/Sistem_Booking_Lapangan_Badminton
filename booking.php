<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "booking_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menangkap data dari form
$name = $_POST['name'];
$court_number = $_POST['court_number'];
$booking_date = $_POST['booking_date'];
$booking_time = $_POST['booking_time'];

// Query untuk menyimpan data
$sql = "INSERT INTO bookings (name, court_number, booking_date, booking_time) VALUES ('$name', '$court_number', '$booking_date', '$booking_time')";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #007bff;
        }
        .message {
            font-size: 18px;
            text-align: center;
            margin: 20px 0;
        }
        .details {
            font-size: 16px;
            text-align: center;
            margin: 20px 0;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-size: 16px;
            text-decoration: none;
            color: #f4f4f4;
            background-color: #007bff;
            border-radius: 10px;
            padding: 15px;
            transition: background-color 0.3s;
        }
        .back-link:hover {
            background-color: #0056b3;
        }
        .berhasilh2{
            color: #347928;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Booking Confirmation</h1>
    <div class="message">
        <?php
        if ($conn->query($sql) === TRUE) {
            echo "<h2 class='berhasilh2'><strong>Booking berhasil!<strong></h2>";
            echo "<div class='details'>";
            echo "<p><strong>Nama Pemesan:</strong> " . htmlspecialchars($name) . "</p>";
            echo "<p><strong>Nomor Lapangan:</strong> " . htmlspecialchars($court_number) . "</p>";
            echo "<p><strong>Booking Untuk Tanggal:</strong> " . htmlspecialchars($booking_date) . "</p>";
            echo "<p><strong>Jam Booking:</strong> " . htmlspecialchars($booking_time) . "</p>";
            echo "</div>";
            echo "<p>Simpan untuk konfirmasi ke lapangan</p>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        ?>
    </div>
    <a href="index.php" class="back-link">Kembali ke halaman utama</a>
</div>

</body>
</html>

<?php
$conn->close();
?>
