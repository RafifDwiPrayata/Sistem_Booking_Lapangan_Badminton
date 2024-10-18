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

// Mengambil ID booking dari URL
if (isset($_GET['id'])) {
    $booking_id = intval($_GET['id']);
    
    // Query untuk mendapatkan data booking berdasarkan ID
    $sql = "SELECT * FROM bookings WHERE booking_id = $booking_id";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 1) {
        $booking = $result->fetch_assoc();
    } else {
        die("Booking tidak ditemukan.");
    }
} else {
    die("ID booking tidak ditemukan.");
}

// Proses pengeditan booking
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $court_number = $_POST['court_number'];
    $booking_date = $_POST['booking_date'];
    $booking_time = $_POST['booking_time'];

    // Update query
    $sql_update = "UPDATE bookings SET name=?, court_number=?, booking_date=?, booking_time=? WHERE booking_id=?";
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param("sissi", $name, $court_number, $booking_date, $booking_time, $booking_id);

    if ($stmt->execute()) {
        echo "Booking berhasil diperbarui.";
        header("Location: admin.php"); // Redirect ke halaman daftar booking
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Booking</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            background-image: url('background/bg1.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        h1 {
            text-align: center;
            color: #f0f0f0;
            margin-top: 40px;
            font-size: 2em;
        }

        form {
            max-width: 500px;
            margin: 40px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
        }

        input,
        button {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
            box-sizing: border-box;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <h1>Edit Booking</h1>

    <form action="" method="POST">
        <label for="name">Nama Pemesan:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($booking['name']); ?>" required autofocus>

        <label for="court_number">Nomor Lapangan (1-5):</label>
        <input type="number" id="court_number" name="court_number" min="1" max="5" value="<?php echo htmlspecialchars($booking['court_number']); ?>" required>

        <label for="booking_date">Tanggal Booking:</label>
        <input type="date" id="booking_date" name="booking_date" value="<?php echo htmlspecialchars($booking['booking_date']); ?>" required>

        <label for="booking_time">Jam Booking:</label>
        <input type="time" id="booking_time" name="booking_time" value="<?php echo htmlspecialchars($booking['booking_time']); ?>" required>

        <button type="submit">Update Booking</button>
    </form>

    <?php $conn->close(); ?>
</body>

</html>
