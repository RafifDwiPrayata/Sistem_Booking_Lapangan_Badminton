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

// Query untuk mendapatkan data booking
$sql = "SELECT * FROM bookings";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Lapangan Badminton</title>
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

        h2 {
            color: #f0f0f0;
        }

        form {
            max-width: 500px;
            /* Lebar form yang lebih besar */
            margin: 40px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            /* Shadow yang lebih lembut */
            transition: all 0.3s ease;
        }

        form:hover {
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
            /* Efek hover untuk form */
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

        input:focus {
            border-color: #007bff;
            /* Highlight warna saat input aktif */
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.2);
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
            /* Warna tombol saat hover */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            background-color: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #f7f7f7;
            font-weight: 600;
            color: #333;
        }

        td {
            color: #555;
        }

        section {
            margin: 35px;
        }
    </style>
</head>

<body>
    <h1>Booking Lapangan Badminton</h1>

    <form action="booking.php" method="POST">
        <label for="name">Nama Pemesan:</label>
        <input type="text" id="name" name="name" required autofocus>

        <label for="court_number">Nomor Lapangan (1-5):</label>
        <input type="number" id="court_number" name="court_number" min="1" max="5" required>

        <label for="booking_date">Booking Untuk Tanggal:</label>
        <input type="date" id="booking_date" name="booking_date" required>

        <label for="booking_time">Jam Booking:</label>
        <input type="time" id="booking_time" name="booking_time" required>

        <button type="submit">Booking</button>
    </form>

    <section>
        <h2>Daftar Booking</h2>
        <table>
            <tr>
                <th>Nama</th>
                <th>Nomor Lapangan</th>
                <th>Tanggal</th>
                <th>Waktu</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Mengubah format tanggal menjadi Tanggal Bulan Tahun
                    $formatted_date = date("j F Y", strtotime($row["booking_date"]));

                    echo "<tr>
                            <td>" . $row["name"] . "</td>
                            <td>" . $row["court_number"] . "</td>
                            <td>" . $formatted_date . "</td> <!-- Menggunakan tanggal yang diformat -->
                            <td>" . $row["booking_time"] . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Tidak ada booking saat ini.</td></tr>";
            }
            ?>
        </table>
    </section>

    <?php $conn->close(); ?>
</body>

</html>